<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Favorite an element for a specific user
$app->patch('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}/{internalid:[0-9]+}/favorite', function(Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    $element = $args['element'];
    $internalid = (int)$args['internalid'];
    $this->applogger->addInfo("PATCH /auth/$element/$internalid/favorite", array('user'=>$request->getAttribute("token")->user));
    try {
        $mapper = MapperFactory::getMapper($this->db,$element);
        $mapper->favoriteForUser($internalid, $userid);

        $newresponse = $response->withStatus(200);

    } catch (Exception $e){
        $this->applogger->addError("PATCH /auth/$element/$internalid/favorite", array('user'=>$request->getAttribute("token")->user,'exception'=>$e));
        $newresponse = $response->withStatus(400);
    }
    return $newresponse;
});

// UNFavorite an element for a specific user
$app->patch('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}/{internalid:[0-9]+}/unfavorite', function(Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    $element = $args['element'];
    $internalid = (int)$args['internalid'];
    $this->applogger->addInfo("PATCH /auth/$element/$internalid/unvaforite", array('user'=>$request->getAttribute("token")->user));
    try {
        $mapper = MapperFactory::getMapper($this->db,$element);
        $mapper->unfavoriteForUser($internalid, $userid);

        $newresponse = $response->withStatus(200);

    } catch (Exception $e){
        $this->applogger->addError("PATCH /auth/$element/$internalid/unfavorite", array('user'=>$request->getAttribute("token")->user,'exception'=>$e));
        $newresponse = $response->withStatus(400);
    }
    return $newresponse;
});
