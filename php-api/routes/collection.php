<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Collect an element for a specific user
$app->patch('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands}/{internalid:[0-9]+}/collect', function(Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    $element = $args['element'];
    $internalid = (int)$args['internalid'];
    $this->applogger->addInfo("User $userid collects $element $internalid");
    try {
        $mapper = MapperFactory::getMapper($this->db,$element);
        $quantity = $mapper->collectForUser($internalid, $userid);

        $newresponse = $response->withJson($quantity);

    } catch (Exception $e){
        $this->applogger->addInfo($e);
        $newresponse = $response->withJson(null,400);
    }
    return $newresponse;
});

// UNCollect an element for a specific user
$app->patch('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands}/{internalid:[0-9]+}/uncollect', function(Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    $element = $args['element'];
    $internalid = (int)$args['internalid'];
    $this->applogger->addInfo("User $userid uncollects $element $internalid");
    try {
        $mapper = MapperFactory::getMapper($this->db,$element);
        $quantity = $mapper->uncollectForUser($internalid, $userid);

        $newresponse = $response->withJson($quantity);

    } catch (Exception $e){
        $this->applogger->addInfo($e);
        $newresponse = $response->withJson(null,400);
    }
    return $newresponse;
});
