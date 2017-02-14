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
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'] . ";charset=" . $db['charset'],
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

$app->get('/accessories', function(Request $request, Response $response) {
    $this->logger->addInfo("Accessories list");
    $mapper = new AccessoryMapper($this->db);
    $accessories = $mapper->getAccessories();

    $newresponse = $response->withJson($accessories);
    return $newresponse;
});

$app->get('/accessory/{internalid}', function (Request $request, Response $response, $args) {
    $accessory_internalid = (int)$args['internalid'];
    $this->logger->addInfo("Accessory single ".$accessory_internalid);
    $mapper = new AccessoryMapper($this->db);
    $accessory = $mapper->getAccessoryByInternalid($accessory_internalid);

    if( is_null($accessory) ){
        $newresponse = $response->withJson(null,404);
    } else {
        $newresponse = $response->withJson($accessory);
    }

    return $newresponse;
});

$app->get('/bodyparts', function(Request $request, Response $response) {
    $this->logger->addInfo("Bodyparts list");
    $mapper = new BodypartMapper($this->db);
    $bodyparts = $mapper->getBodyparts();

    $newresponse = $response->withJson($bodyparts);
    return $newresponse;
});

$app->get('/bodypart/{internalid}', function (Request $request, Response $response, $args) {
    $bodypart_internalid = (int)$args['internalid'];
    $this->logger->addInfo("Bodypart single ".$bodypart_internalid);
    $mapper = new BodypartMapper($this->db);
    $bodypart = $mapper->getBodypartByInternalid($bodypart_internalid);

    if( is_null($bodypart) ){
        $newresponse = $response->withJson(null,404);
    } else {
        $newresponse = $response->withJson($bodypart);
    }

    return $newresponse;
});

$app->get('/faces', function(Request $request, Response $response) {
    $this->logger->addInfo("Faces list");
    $mapper = new FaceMapper($this->db);
    $faces = $mapper->getFaces();

    $newresponse = $response->withJson($faces);
    return $newresponse;
});

$app->get('/face/{internalid}', function (Request $request, Response $response, $args) {
    $face_internalid = (int)$args['internalid'];
    $this->logger->addInfo("Face single ".$face_internalid);
    $mapper = new FaceMapper($this->db);
    $face = $mapper->getFaceByInternalid($face_internalid);

    if( is_null($face) ){
        $newresponse = $response->withJson(null,404);
    } else {
        $newresponse = $response->withJson($face);
    }

    return $newresponse;
});

$app->get('/hairs', function(Request $request, Response $response) {
    $this->logger->addInfo("Hairs list");
    $mapper = new HairMapper($this->db);
    $hairs = $mapper->getHairs();

    $newresponse = $response->withJson($hairs);
    return $newresponse;
});

$app->get('/hair/{internalid}', function (Request $request, Response $response, $args) {
    $hair_internalid = (int)$args['internalid'];
    $this->logger->addInfo("Hair single ".$hair_internalid);
    $mapper = new HairMapper($this->db);
    $hair = $mapper->getHairByInternalid($hair_internalid);

    if( is_null($hair) ){
        $newresponse = $response->withJson(null,404);
    } else {
        $newresponse = $response->withJson($hair);
    }

    return $newresponse;
});

$app->run();
