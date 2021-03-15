<?php
require_once '../vendor/autoload.php';

use Core\Connection;

// Create connection to DB
new Connection();

// Add routes
require_once __DIR__ . "/../routes/web.php";

