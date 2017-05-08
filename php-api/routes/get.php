<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// General count (count all object in DB)
$app->get('/count', function(Request $request, Response $response) {
    $this->applogger->addInfo("Count");

    $mapper = new CountMapper($this->db);
    $counts = $mapper->get();

    $newresponse = $response->withJson($counts);

    return $newresponse;
});

//  Retrieve all objects of type {element}
$app->get('/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos|photoaccessories|photobodyparts|photoboxes|photofaces|photohairs|photohands|photonendoroids|user|users|news}', function(Request $request, Response $response, $args) {
    $param_element = $args['element'];
    $this->applogger->addInfo("$param_element list");
    try {
        $mapper = MapperFactory::getMapper($this->db,$param_element);
        $elements = $mapper->get();

        $newresponse = $response->withJson($elements);

    } catch (Exception $e){
        $newresponse = $response->withStatus(400);
    }
    return $newresponse;
});

// Retrieve the count of all objects of type {element}
$app->get('/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}/count', function(Request $request, Response $response, $args) {
    $element = $args['element'];
    $this->applogger->addInfo("$element count");
    try {
        $mapper = MapperFactory::getMapper($this->db,$element);
        $count = $mapper->count();
        $count['count'] *= 1;

        $newresponse = $response->withJson($count);

    } catch (Exception $e){
        $newresponse = $response->withStatus(400);
    }
    return $newresponse;
});

// Retrieve a single {element} using its {internalid}
$app->get('/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}/{internalid:[0-9]+}', function (Request $request, Response $response, $args) {
    $param_element = $args['element'];
    $internalid = (int)$args['internalid'];
    $this->applogger->addInfo("$param_element $internalid single");
    try {
        $mapper = MapperFactory::getMapper($this->db,$param_element);
        $element = $mapper->getByInternalid($internalid);

        if( is_null($element) ){
            $newresponse = $response->withStatus(404);
        } else {
            $newresponse = $response->withJson($element);
        }

    } catch (Exception $e){
        $newresponse = $response->withStatus(400);
    }
    return $newresponse;
});

// Retrieve all object of type {element} from a {elementfrom} using the {id}
$app->get('/{elementfrom:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}/{id:[0-9]+}/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}', function (Request $request, Response $response, $args) {
    $param_elementfrom = $args['elementfrom'];
    $param_element = $args['element'];
    $param_id = (int)$args['id'];
    $this->applogger->addInfo("$param_element list in $param_elementfrom $param_id");
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
            $newresponse = $response->withStatus(404);
        } else {
            $newresponse = $response->withJson($element);
        }

    } catch (Exception $e){
        $newresponse = $response->withStatus(400);
    }
    return $newresponse;
});

//  Retrieve history of an {element}
$app->get('/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos|photoaccessories|photobodyparts|photoboxes|photofaces|photohairs|photohands|photonendoroids}/{internalid:[0-9]+}/history', function(Request $request, Response $response, $args) {
    $param_element = $args['element'];
    $param_internalid = $args['internalid'];
    $this->applogger->addInfo("$param_element history");
    try {
        $mapper = MapperFactory::getMapper($this->db,$param_element);
        $elements = $mapper->getHistory($param_internalid);

        $newresponse = $response->withJson($elements);

    } catch (Exception $e){
        $newresponse = $response->withStatus(400);
    }
    return $newresponse;
});

