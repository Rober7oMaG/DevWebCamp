<?php

namespace Models;

class ActiveRecord {
    // Database
    protected static $db;
    protected static $table = '';
    protected static $db_columns = [];

    // Alerts and Messages
    protected static $alerts = [];
    
    // Define connection to DB - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlert($type, $message) {
        static::$alerts[$type][] = $message;
    }

    // Validation
    public static function getAlerts() {
        return static::$alerts;
    }

    public function validate() {
        static::$alerts = [];
        return static::$alerts;
    }

    // SQL Queary to create object in memory (Active Record)
    public static function querySQL($query) {
        // Query database
        $result = self::$db->query($query);

        // Iterate results
        $objects = [];
        while ($record = $result->fetch_assoc()) {
            $objects[] = static::createObject($record);
        }

        // Free memory
        $result->free();

        // Return results
        return $objects;
    }

    // Create object in memory that is similar to the one in database
    protected static function createObject($record) {
        $object = new static;

        foreach ($record as $key => $value) {
            if (property_exists($object, $key)) {
                $object->$key = $value;
            }
        }

        return $object;
    }

    // Identify and link database attributes
    public function setData() {
        $data = [];
        foreach (static::$db_columns as $column) {
            if ($column === 'id') {
                continue;
            }
            $data[$column] = $this->$column;
        }

        return $data;
    }

    public function sanitizeData() {
        $data = $this->setData();
        $sanitized = [];

        foreach ($data as $key => $value) {
            $sanitized[$key] = self::$db->escape_string($value);
        }

        return $sanitized;
    }

    // Synchronize database with object in memory
    public function synchronizeObject($args = []) {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // Registers - CRUD
    public function save() {
        $result = '';
        if(!is_null($this->id)) {
            // actualizar
            $result = $this->update();
        } else {
            // Creando un nuevo registro
            $result = $this->create();
        }
        return $result;
    }

    public static function all() {
        $query_all = "SELECT * FROM " . static::$table;
        $query_all_result = self::querySQL($query_all);

        return $query_all_result;
    }

    public static function find($column, $value) {
        $query_find = "SELECT * FROM " . static::$table . " WHERE ${column} = '${value}';";
        $query_find_result = self::querySQL($query_find);

        return array_shift($query_find_result);
    }

    public static function sort($column, $order) {
        $query = "SELECT * FROM " . static::$table . " ORDER BY ${column} ${order};";
        $query_result = self::querySQL($query);

        return $query_result;
    }

    public static function sortLimit($column, $order, $limit) {
        $query = "SELECT * FROM " . static::$table . " ORDER BY ${column} ${order} LIMIT ${limit};";
        $query_result = self::querySQL($query);

        return $query_result;
    }

    public static function whereArray($array = []) {
        $query = "SELECT * FROM " . static::$table . " WHERE ";
        foreach ($array as $key => $value) {
            if ($key == array_key_last($array)) {
                $query .= "${key} = '${value}' ";
            }
            else {
                $query .= "${key} = '${value}' AND ";
            }
        }

        $query_result = self::querySQL($query);

        return $query_result;
    }

    // Query when object methods are not enough
    public static function sql($query) {
        $result = self::querySQL($query);

        return $result;
    }

    // Get the desired amount of results
    public static function get($limit) {
        $query = "SELECT * FROM " . static::$table . " ORDER BY id DESC LIMIT ${limit}";
        $result = self::querySQL($query);

        return $result;
    }

    public static function paginate($per_page, $offset) {
        $query = "SELECT * FROM " . static::$table . " LIMIT ${per_page} OFFSET ${offset}";
        $result = self::querySQL($query);

        return $result;
    }

     // Get the amount of results
     public static function count($column = '', $value = '') {
        $query = "SELECT COUNT(*) FROM " . static::$table;
        if ($column) {
            $query .= " WHERE ${column} = ${value}";
        }
        $query_result = self::$db->query($query);
        $total = $query_result->fetch_array();

        return array_shift($total);
    }

    public static function countArray($array = []) {
        $query = "SELECT COUNT(*) FROM " . static::$table . " WHERE ";

        foreach ($array as $key => $value) {
            if ($key == array_key_last($array)) {
                $query .= "${key} = '${value}' ";
            }
            else {
                $query .= "${key} = '${value}' AND ";
            }
        }

        $query_result = self::$db->query($query);
        $total = $query_result->fetch_array();

        return array_shift($total);
    }

    // Create new entry
    public function create() {
        // Sanitize data
        $data = $this->sanitizeData();

        // Insert on database
        $query_insert = "INSERT INTO " . static::$table . " (";
        $query_insert .= join(', ', array_keys($data));
        $query_insert .= ") VALUES ('";
        $query_insert .= join("', '", array_values($data));
        $query_insert .= "');";
        
        $query_insert_result = self::$db->query($query_insert);

        return [
           'result' =>  $query_insert_result,
           'id' => self::$db->insert_id
        ];
    }

    public function update() {
        // Sanitize data
        $data = $this->sanitizeData();
        $values = [];

        foreach ($data as $key => $value) {
            $values[] = "{$key}='{$value}'";
        }

        $query_update = "UPDATE " . static::$table . " SET ";
        $query_update .= join(', ', $values);
        $query_update .= " WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1;";
        
        $query_update_result = self::$db->query($query_update);

        return $query_update_result;
    }

    // Delete database row
    public function delete() {
        $query_delete = "DELETE FROM " . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1;";
        $query_delete_result = self::$db->query($query_delete);

        return $query_delete_result;
    }
}