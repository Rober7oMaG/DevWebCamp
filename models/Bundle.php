<?php

namespace Models;

class Bundle extends ActiveRecord {
    protected static $table = 'bundles';
    protected static $db_columns = ['id', 'name'];

    public $id;
    public $name;
}