<?php

use App\config\Router;

require 'config/DBID.php';
require 'vendor/autoload.php';
session_start();
$router = new Router();
$router->run();