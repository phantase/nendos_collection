<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Add a tag to an element
$app->post('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}/{internalid:[0-9]+}/tag', function(Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    $element = $args['element'];
    $internalid = (int)$args['internalid'];
    $data = $request->getParsedBody();
    $this->applogger->addInfo("POST /auth/$element/$internalid/tag", array('user'=>$request->getAttribute("token")->user));

    $tag = array_key_exists('tag', $data) ? filter_var($data['tag'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;

    if (is_null($tag)) {
        $this->applogger->addDebug("POST /auth/$element/$internalid/tag - no tag", array('user'=>$request->getAttribute("token")->user));
        $newresponse = $response->withStatus(400);
    } else {

        try {
            $mapper = MapperFactory::getMapper($this->db,$element);
            $mapper->tag($internalid, $tag, $userid);

            $newresponse = $response->withStatus(200);

        } catch (Exception $e){
            $this->applogger->addError("POST /auth/$element/$internalid/tag", array('user'=>$request->getAttribute("token")->user,'exception'=>$e));
            $newresponse = $response->withStatus(400);
        }

    }
    return $newresponse;
});

// Delete (or at least decrease the grade of) a tag of an element
$app->delete('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}/{internalid:[0-9]+}/tag', function(Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    $element = $args['element'];
    $internalid = (int)$args['internalid'];
    $data = $request->getParsedBody();
    $this->applogger->addInfo("DELETE /auth/$element/$internalid/tag", array('user'=>$request->getAttribute("token")->user));

    $tag = array_key_exists('tag', $data) ? filter_var($data['tag'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;

    if (is_null($tag)) {
        $this->applogger->addDebug("DELETE /auth/$element/$internalid/tag - no tag", array('user'=>$request->getAttribute("token")->user));
        $newresponse = $response->withStatus(400);
    } else {

        try {
            $mapper = MapperFactory::getMapper($this->db,$element);
            $grade = $mapper->untag($internalid, $tag, $userid);

            $newresponse = $response->withStatus(200);

        } catch (Exception $e){
            $this->applogger->addError("DELETE /auth/$element/$internalid/tag", array('user'=>$request->getAttribute("token")->user,'exception'=>$e));
            $newresponse = $response->withStatus(400);
        }

    }
    return $newresponse;
});

// Get all tags for an element type
$app->get('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}/tags', function(Request $request, Response $response, $args) {
    $element = $args['element'];
    $this->applogger->addInfo("GET /auth/$element/tags", array('user'=>$request->getAttribute("token")->user));

    try {
        $mapper = MapperFactory::getMapper($this->db,$element);
        $tags = $mapper->getTags();

        $newresponse = $response->withJson($tags);

    } catch (Exception $e){
        $this->applogger->addError("POST /auth/$element/tags", array('user'=>$request->getAttribute("token")->user,'exception'=>$e));
        $newresponse = $response->withStatus(500);
    }
    return $newresponse;
});
