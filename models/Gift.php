<?php

namespace Models;

class Gift extends ActiveRecord {
    protected static $table = 'gifts';
    protected static $db_columns = ['id', 'name'];

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
    }
}