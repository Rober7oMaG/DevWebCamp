<?php

namespace Models;

class Day extends ActiveRecord {
    protected static $table = 'days';
    protected static $db_columns = ['id', 'name'];

    public $id;
    public $name;
}