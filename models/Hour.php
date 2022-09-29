<?php

namespace Models;

class Hour extends ActiveRecord {
    protected static $table = 'hours';
    protected static $db_columns = ['id', 'hour'];

    public $id;
    public $hour;
}