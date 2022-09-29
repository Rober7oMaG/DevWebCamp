<?php

namespace Models;

class EventSchedule extends ActiveRecord {
    protected static $table = 'events';
    protected static $db_columns = ['id', 'category_id', 'day_id', 'hour_id'];

    public $id;
    public $category_id;
    public $day_id;
    public $hour_id;
}