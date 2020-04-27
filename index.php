<?php

use App\config\Router;

require '../Projet_4/config/DBID.php';
require '../Projet_4/vendor/autoload.php';
session_start();
$router = new Router();
$router->run();