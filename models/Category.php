<?php

namespace Models;

class Category extends ActiveRecord {
    protected static $table = 'categories';
    protected static $db_columns = ['id', 'name'];

    public $id;
    public $name;
}