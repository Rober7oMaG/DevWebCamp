<?php

namespace Models;

class Speaker extends ActiveRecord {
    protected static $table = 'speakers';
    protected static $db_columns = ['id', 'name', 'last_name', 'city', 'country', 'image', 'tags', 'social'];
    
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->last_name = $args['last_name'] ?? '';
        $this->city = $args['city'] ?? '';
        $this->country = $args['country'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->tags = $args['tags'] ?? '';
        $this->social = $args['social'] ?? '';
    }

    public function validate() : array {
        if (!$this->name) {
            self::$alerts['error'][] = "Name field is obligatory.";
        }

        if(!$this->last_name) {
            self::$alerts['error'][] = "Last name field is obligatory.";
        }

        if(!$this->city) {
            self::$alerts['error'][] = "City field is obligatory.";
        }

        if(!$this->country) {
            self::$alerts['error'][] = "Country field is obligatory.";
        }

        if(!$this->image) {
            self::$alerts['error'][] = "Image is obligatory.";
        }

        if(!$this->tags) {
            self::$alerts['error'][] = "Tags are obligatory.";
        }
    
        return self::$alerts;
    }
}