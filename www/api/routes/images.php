<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Retrieve a single {element} using its {internalid}
$app->get('/images/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos|user|users}/{internalid:[0-9]+}[/{size:full|thumb}]', function (Request $request, Response $response, $args) {
    $param_element = $args['element'];
    $internalid = (int)$args['internalid'];
    $param_size = isset($args['size'])?$args['size']:'full';
    $this->applogger->addInfo("GET images/$param_element/$internalid/$param_size");

    try {

        switch($param_element){
            case "box":
            case "boxes":
                $element = "boxes";
                break;
            case "nendoroid":
            case "nendoroids":
                $element = "nendoroids";
                break;
            case "accessory":
            case "accessories":
                $element = "accessories";
                break;
            case "bodypart":
            case "bodyparts":
                $element = "bodyparts";
                break;
            case "face":
            case "faces":
                $element = "faces";
                break;
            case "hair":
            case "hairs":
                $element = "hairs";
                break;
            case "hand":
            case "hands":
                $element = "hands";
                break;
            case "photo":
            case "photos":
                $element = "photos";
                break;
            case "user":
            case "users":
                $element = "users";
                break;
            default:
                throw new Exception("Error Processing Request", 1);
        }

        $filename = "images/nendos/$element/$internalid"."_$param_size.jpg";

        if (file_exists($filename)) {
            $image = file_get_contents($filename);
            $response->write($image);
            return $response->withHeader('Content-Type', 'image/jpg');
        } else {
            return $response->withStatus(404);
        }
    } catch (Exception $e){
        return $response->withStatus(400);
    }
});
