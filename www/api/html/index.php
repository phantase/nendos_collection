<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Arbitrary set
date_default_timezone_set('Europe/Paris');

require '../vendor/autoload.php';
spl_autoload_register(function ($classname) {
    require ("../classes/" . $classname . ".php");
});

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['host']    = "db";
$config['db']['user']    = "nendos";
$config['db']['pass']    = "nendospass";
$config['db']['dbname']  = "nendos";
$config['db']['charset'] = "utf8";

$config['jwt']['secret'] = "thesecretisthatthereisnospoon";

$app = new \Slim\App(["settings" => $config]);

require '../config/dependencies.php';
// require '../config/handlers.php';
require '../config/middleware.php';
require '../config/database.php';
require '../config/cors.php';

require '../routes/get.php';
require '../routes/account.php';

$app->run();
