<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Collect an element for a specific user
$app->patch('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}/{internalid:[0-9]+}/favorite', function(Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    $element = $args['element'];
    $internalid = (int)$args['internalid'];
    $this->applogger->addInfo("User $userid favorites $element $internalid");
    try {
        $mapper = MapperFactory::getMapper($this->db,$element);
        $mapper->favoriteForUser($internalid, $userid);

        $newresponse = $response->withStatus(200);

    } catch (Exception $e){
        $this->applogger->addInfo($e);
        $newresponse = $response->withStatus(400);
    }
    return $newresponse;
});

// UNCollect an element for a specific user
$app->patch('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}/{internalid:[0-9]+}/unfavorite', function(Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    $element = $args['element'];
    $internalid = (int)$args['internalid'];
    $this->applogger->addInfo("User $userid unfavorites $element $internalid");
    try {
        $mapper = MapperFactory::getMapper($this->db,$element);
        $mapper->unfavoriteForUser($internalid, $userid);

        $newresponse = $response->withStatus(200);

    } catch (Exception $e){
        $this->applogger->addInfo($e);
        $newresponse = $response->withStatus(400);
    }
    return $newresponse;
});
