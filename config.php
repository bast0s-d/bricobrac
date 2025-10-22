<?php
require_once 'src/DBConnection.php';
require_once 'vendor/autoload.php';
session_start();


define('RACINE_PROJET', __DIR__ . DIRECTORY_SEPARATOR);

define('DB_HOST', 'localhost');
define('DB_NAME', 'bricobrac_db');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_CHARSET', 'utf8mb4');