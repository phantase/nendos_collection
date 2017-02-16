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

// To enable CORS
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://localhost:8080')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});
// End To enable CORS

// General count (count all object in DB)
$app->get('/count', function(Request $request, Response $response) {
    $this->logger->addInfo("Count");

    $mapper = new CountMapper($this->db);
    $counts = $mapper->get();

    $newresponse = $response->withJson($counts);

    return $newresponse;
});

//  Retrieve all objects of type {element}
$app->get('/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}', function(Request $request, Response $response, $args) {
    $param_element = $args['element'];
    $this->logger->addInfo($param_element." list");
    try {
        $mapper = MapperFactory::getMapper($this->db,$param_element);
        $elements = $mapper->get();

        $newresponse = $response->withJson($elements);

    } catch (Exception $e){
        $newresponse = $response->withJson(null,400);
    }
    return $newresponse;
});

// Retrieve the count of all objects of type {element}
$app->get('/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}/count', function(Request $request, Response $response, $args) {
    $element = $args['element'];
    $this->logger->addInfo($element." count");
    try {
        $mapper = MapperFactory::getMapper($this->db,$element);
        $count = $mapper->count();
        $count['count'] *= 1;

        $newresponse = $response->withJson($count);

    } catch (Exception $e){
        $newresponse = $response->withJson(null,400);
    }
    return $newresponse;
});

// Retrieve a single {element} using its {internalid}
$app->get('/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}/{internalid:[0-9]+}', function (Request $request, Response $response, $args) {
    $param_element = $args['element'];
    $internalid = (int)$args['internalid'];
    $this->logger->addInfo($param_element." single ".$internalid);
    try {
        $mapper = MapperFactory::getMapper($this->db,$param_element);
        $element = $mapper->getByInternalid($internalid);

        if( is_null($element) ){
            $newresponse = $response->withJson(null,404);
        } else {
            $newresponse = $response->withJson($element);
        }

    } catch (Exception $e){
        $newresponse = $response->withJson(null,400);
    }
    return $newresponse;
});

// Retrieve all object of type {element} from a {elementfrom} using the {id}
$app->get('/{elementfrom:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}/{id:[0-9]+}/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}', function (Request $request, Response $response, $args) {
    $param_elementfrom = $args['elementfrom'];
    $param_element = $args['element'];
    $param_id = (int)$args['id'];
    $this->logger->addInfo($param_element." list in ".$param_elementfrom." ".$param_id);
    try {
        $mapper = MapperFactory::getMapper($this->db,$param_element);
        switch($param_elementfrom){
            case "box":
            case "boxes":
                $element = $mapper->getByBoxid($param_id);
                break;
            case "nendoroid":
            case "nendoroids":
                $element = $mapper->getByNendoroidid($param_id);
                break;
            case "accessory":
            case "accessories":
                $element = $mapper->getByAccessoryid($param_id);
                break;
            case "bodypart":
            case "bodyparts":
                $element = $mapper->getByBodypartid($param_id);
                break;
            case "face":
            case "faces":
                $element = $mapper->getByFaceid($param_id);
                break;
            case "hair":
            case "hairs":
                $element = $mapper->getByHairid($param_id);
                break;
            case "hand":
            case "hands":
                $element = $mapper->getByHandid($param_id);
                break;
            case "photo":
            case "photos":
                $element = $mapper->getByPhotoid($param_id);
                break;
            default:
                throw new Exception("Error Processing Request", 1);
        }

        if( is_null($element) ){
            $newresponse = $response->withJson(null,404);
        } else {
            $newresponse = $response->withJson($element);
        }

    } catch (Exception $e){
        $newresponse = $response->withJson(null,400);
    }
    return $newresponse;
});

$app->run();
