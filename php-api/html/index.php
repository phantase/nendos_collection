<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Arbitrary set
date_default_timezone_set('Europe/Paris');

require '../vendor/autoload.php';
spl_autoload_register(function ($classname) {
    require ("../classes/" . $classname . ".php");
});

require '../configuration.php';

$app = new \Slim\App(["settings" => $config]);

require '../config/dependencies.php';
// require '../config/handlers.php';
require '../config/middleware.php';
require '../config/database.php';
require '../config/cors.php';

require '../routes/get.php';
require '../routes/account.php';
require '../routes/get_auth.php';
require '../routes/collection.php';
require '../routes/validation.php';
require '../routes/favorites.php';
require '../routes/add.php';
require '../routes/edit.php';
require '../routes/images.php';

$app->run();
