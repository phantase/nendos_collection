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

$config['db']['host']   = "db";
$config['db']['user']   = "nendos";
$config['db']['pass']   = "nendospass";
$config['db']['dbname'] = "nendos";

$app = new \Slim\App(["settings" => $config]);
$container = $app->getContainer();

$container['view'] = new \Slim\Views\PhpRenderer("../templates/");

$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$app->get('/boxes', function(Request $request, Response $response) {
    $this->logger->addInfo("Boxes list");
    $mapper = new BoxMapper($this->db);
    $boxes = $mapper->getBoxes();

    $newresponse = $response->withJson($boxes);
    return $newresponse;
});

$app->get('/box/{internalid}', function (Request $request, Response $response, $args) {
    $box_internalid = (int)$args['internalid'];
    $this->logger->addInfo("Box single ".$box_internalid);
    $mapper = new BoxMapper($this->db);
    $box = $mapper->getBoxByInternalid($box_internalid);

    if( is_null($box) ){
        $newresponse = $response->withJson(null,404);
    } else {
        $newresponse = $response->withJson($box);
    }

    return $newresponse;
});

$app->get('/nendoroids', function(Request $request, Response $response) {
    $this->logger->addInfo("Nendoroids list");
    $mapper = new NendoroidMapper($this->db);
    $nendoroids = $mapper->getNendoroids();

    $newresponse = $response->withJson($nendoroids);
    return $newresponse;
});

$app->get('/nendoroid/{internalid}', function (Request $request, Response $response, $args) {
    $nendoroid_internalid = (int)$args['internalid'];
    $this->logger->addInfo("Nendoroid single ".$nendoroid_internalid);
    $mapper = new NendoroidMapper($this->db);
    $nendoroid = $mapper->getNendoroidByInternalid($nendoroid_internalid);

    if( is_null($nendoroid) ){
        $newresponse = $response->withJson(null,404);
    } else {
        $newresponse = $response->withJson($nendoroid);
    }

    return $newresponse;
});

$app->run();
