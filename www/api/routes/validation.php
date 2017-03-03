<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Collect an element for a specific user
$app->patch('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands}/{internalid:[0-9]+}/validate', function(Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    $element = $args['element'];
    $internalid = (int)$args['internalid'];
    $this->applogger->addInfo("User $userid validates $element $internalid");
    try {
        $mapper = MapperFactory::getMapper($this->db,$element);
        $quantity = $mapper->validateByUser($internalid, $userid);

        $newresponse = $response->withJson($quantity);

    } catch (Exception $e){
        $this->applogger->addInfo($e);
        $newresponse = $response->withJson(null,400);
    }
    return $newresponse;
});

// UNCollect an element for a specific user
$app->patch('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands}/{internalid:[0-9]+}/unvalidate', function(Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    $element = $args['element'];
    $internalid = (int)$args['internalid'];
    $this->applogger->addInfo("User $userid unvalidates $element $internalid");
    try {
        $mapper = MapperFactory::getMapper($this->db,$element);
        $quantity = $mapper->unvalidateByUser($internalid, $userid);

        $newresponse = $response->withJson($quantity);

    } catch (Exception $e){
        $this->applogger->addInfo($e);
        $newresponse = $response->withJson(null,400);
    }
    return $newresponse;
});
