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

$app->get('/count', function(Request $request, Response $response) {
    $this->logger->addInfo("Count");

    $mapper = new CountMapper($this->db);
    $counts = $mapper->get();

    $newresponse = $response->withJson($counts);

    return $newresponse;
});

$app->get('/{element}', function(Request $request, Response $response, $args) {
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

$app->get('/{element}/count', function(Request $request, Response $response, $args) {
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

$app->get('/{element}/{internalid}', function (Request $request, Response $response, $args) {
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

$app->run();
