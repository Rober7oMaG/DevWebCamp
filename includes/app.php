<?php 

use Dotenv\Dotenv;
use Models\ActiveRecord;

require __DIR__ . '/../vendor/autoload.php';

// Add Dotenv
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'functions.php';
require 'database.php';

// Conect to database
ActiveRecord::setDB($db);