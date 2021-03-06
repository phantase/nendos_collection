<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// General count (count all object in DB)
$app->get('/auth/count', function(Request $request, Response $response) {
    $userid = $request->getAttribute("token")->user->internalid;
    $this->applogger->addInfo("GET /auth/count", array('user'=>$request->getAttribute("token")->user));

    $mapper = new CountMapper($this->db);
    $counts = $mapper->getForUser($userid);

    $newresponse = $response->withJson($counts);

    return $newresponse;
});

//  Retrieve all objects of type {element}
$app->get('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos|photoaccessories|photobodyparts|photoboxes|photofaces|photohairs|photohands|photonendoroids|user|users|news}', function(Request $request, Response $response, $args) {
    $user = $request->getAttribute("token")->user;
    $userid = $user->internalid;
    $onlyvalidated = !($user->editor || $user->validator || $user->administrator);

    $param_element = $args['element'];
    $this->applogger->addInfo("GET /auth/$param_element", array('user'=>$request->getAttribute("token")->user));

    try {
        $mapper = MapperFactory::getMapper($this->db,$param_element);
        $elements = $mapper->get($userid, $onlyvalidated);

        $newresponse = $response->withJson($elements);

    } catch (Exception $e){
        $newresponse = $response->withStatus(400);
    }
    return $newresponse;
});

// Retrieve the count of all objects of type {element}
$app->get('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}/count', function(Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    $element = $args['element'];
    $this->applogger->addInfo("GET /auth/$element/count", array('user'=>$request->getAttribute("token")->user));
    try {
        $mapper = MapperFactory::getMapper($this->db,$element);
        $count = $mapper->countForUser($userid);
        $count['count'] *= 1;

        $newresponse = $response->withJson($count);

    } catch (Exception $e){
        $newresponse = $response->withStatus(400);
    }
    return $newresponse;
});

// Retrieve a single {element} using its {internalid}
$app->get('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}/{internalid:[0-9]+}', function (Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    $param_element = $args['element'];
    $internalid = (int)$args['internalid'];
    $this->applogger->addInfo("GET /auth/$param_element/$internalid", array('user'=>$request->getAttribute("token")->user));
    try {
        $mapper = MapperFactory::getMapper($this->db,$param_element);
        $element = $mapper->getByInternalid($internalid, $userid);

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
$app->get('/auth/{elementfrom:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}/{id:[0-9]+}/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}', function (Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    $param_elementfrom = $args['elementfrom'];
    $param_element = $args['element'];
    $param_id = (int)$args['id'];
    $this->applogger->addInfo("GET /auth/$param_elementfrom/$param_id/$param_element", array('user'=>$request->getAttribute("token")->user));
    try {
        $mapper = MapperFactory::getMapper($this->db,$param_element);
        switch($param_elementfrom){
            case "box":
            case "boxes":
                $element = $mapper->getByBoxid($param_id, $userid);
                break;
            case "nendoroid":
            case "nendoroids":
                $element = $mapper->getByNendoroidid($param_id, $userid);
                break;
            case "accessory":
            case "accessories":
                $element = $mapper->getByAccessoryid($param_id, $userid);
                break;
            case "bodypart":
            case "bodyparts":
                $element = $mapper->getByBodypartid($param_id, $userid);
                break;
            case "face":
            case "faces":
                $element = $mapper->getByFaceid($param_id, $userid);
                break;
            case "hair":
            case "hairs":
                $element = $mapper->getByHairid($param_id, $userid);
                break;
            case "hand":
            case "hands":
                $element = $mapper->getByHandid($param_id, $userid);
                break;
            case "photo":
            case "photos":
                $element = $mapper->getByPhotoid($param_id, $userid);
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
$app->get('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos|photoaccessories|photobodyparts|photoboxes|photofaces|photohairs|photohands|photonendoroids}/{internalid:[0-9]+}/history', function(Request $request, Response $response, $args) {
    $param_element = $args['element'];
    $param_internalid = $args['internalid'];
    $this->applogger->addInfo("GET /auth/$param_element/history", array('user'=>$request->getAttribute("token")->user));
    try {
        $mapper = MapperFactory::getMapper($this->db,$param_element);
        $elements = $mapper->getHistory($param_internalid);

        $newresponse = $response->withJson($elements);

    } catch (Exception $e){
        $newresponse = $response->withStatus(400);
    }
    return $newresponse;
});
