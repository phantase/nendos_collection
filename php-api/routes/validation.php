<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Validate an element for a specific user
$app->patch('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands}/{internalid:[0-9]+}/validate', function(Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    if( $request->getAttribute("token")->user->validator === "1" || $request->getAttribute("token")->user->administrator === "1" ){
        $element = $args['element'];
        $internalid = (int)$args['internalid'];
        $this->applogger->addInfo("User $userid validates $element $internalid");
        try {
            $mapper = MapperFactory::getMapper($this->db,$element);
            $quantity = $mapper->validateByUser($internalid, $userid);

            $newresponse = $response->withJson($quantity);

        } catch (Exception $e){
            $this->applogger->addInfo($e);
            $newresponse = $response->withStatus(400);
        }
    } else {
        $this->applogger->addInfo("User $userid tries to validate something without the right to do it");
        $newresponse = $response->withStatus(403);
    }
    return $newresponse;
});

// UNValidate an element for a specific user
$app->patch('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands}/{internalid:[0-9]+}/unvalidate', function(Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    if( $request->getAttribute("token")->user->validator === "1" || $request->getAttribute("token")->user->administrator === "1" ){
        $element = $args['element'];
        $internalid = (int)$args['internalid'];
        $this->applogger->addInfo("User $userid unvalidates $element $internalid");
        try {
            $mapper = MapperFactory::getMapper($this->db,$element);
            $quantity = $mapper->unvalidateByUser($internalid, $userid);

            $newresponse = $response->withJson($quantity);

        } catch (Exception $e){
            $this->applogger->addInfo($e);
            $newresponse = $response->withStatus(400);
        }
    } else {
        $this->applogger->addInfo("User $userid tries to unvalidate something without the right to do it");
        $newresponse = $response->withStatus(403);
    }
    return $newresponse;
});
