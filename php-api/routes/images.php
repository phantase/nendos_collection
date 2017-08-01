<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Retrieve the unknown image
$app->get('/images/unknown', function (Request $request, Response $response, $args) {
    $image = file_get_contents("images/nendos/unknown.png");
    $response->write($image);
    return $response->withHeader('Content-Type', 'image/png');
});

// Retrieve the image of a single {element} using its {internalid}
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
            $image = file_get_contents("images/nendos/unknown.png");
            $response->write($image);
            return $response->withHeader('Content-Type', 'image/png')->withStatus(404);
        }
    } catch (Exception $e){
        return $response->withStatus(400);
    }
});

// Post the image of a single {element} using its {internalid}
$app->post('/auth/images/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands|photo|photos}/{internalid:[0-9]+}', function (Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    $param_element = $args['element'];
    $internalid = (int)$args['internalid'];
    $files = $request->getUploadedFiles();
    if( $request->getAttribute("token")->user->editor === "1" || $request->getAttribute("token")->user->administrator === "1" ){
        $this->applogger->addInfo("POST images/$param_element/$internalid");

        try {

            if (!$files['pic']) {
                throw new Exception("Error, no image provided", 1);
            }

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
                default:
                    throw new Exception("Error Processing Request", 1);
            }

            $destination_folder = "images/nendos/$element/";

            if (!file_exists($destination_folder)) {
                mkdir($destination_folder, 0777, true);
            }

            $filename_full = $destination_folder.$internalid."_full.jpg";
            $filename_thumb = $destination_folder.$internalid."_thumb.jpg";

            $maxside = 500;

            $file = $files['pic'];
            $file->moveTo($filename_full);

            list($width, $height) = getimagesize($filename_full);
            /** Version with same proportion as original **/
            if ($width > $height) {
                $newwidth = $maxside;
                $newheight = $height * $maxside / $width;
            } else {
                $newheight = $maxside;
                $newwidth = $width * $maxside / $height;
            }
            /** Version with squared thumb **/
            // $newwidth = $maxside;
            // $newheight = $maxside;

            $image_dest = imagecreatetruecolor($newwidth, $newheight);
            $image_orig = imagecreatefromjpeg($filename_full);
            imagecopyresampled($image_dest, $image_orig, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            imagejpeg($image_dest, $filename_thumb, 90);

            $mapper = MapperFactory::getMapper($this->db,$param_element);
            $mapper->addPicture($internalid, $userid);

            return $response->withStatus(201);

        } catch (Exception $e){
            $this->applogger->addInfo($e->getMessage());
            return $response->withStatus(400);
        }
    } else {
        $this->applogger->addInfo("POST images/$param_element/$internalid Forbidden, not allowed to");
        return $response->withStatus(403);
    }


});

// Post the image of a user using its {internalid}
$app->post('/auth/images/{element:user|users}/{internalid:[0-9]+}', function (Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    $param_element = $args['element'];
    $internalid = (int)$args['internalid'];
    $files = $request->getUploadedFiles();
    $this->applogger->addInfo("Userid: $userid Internalid: $internalid");
    if( $userid == $internalid ){
        $this->applogger->addInfo("POST images/$param_element/$internalid");

        try {

            if (!$files['pic']) {
                throw new Exception("Error, no image provided", 1);
            }

            switch($param_element){
                case "user":
                case "users":
                    $element = "users";
                    break;
                default:
                    throw new Exception("Error Processing Request", 1);
            }

            $destination_folder = "images/nendos/$element/";

            if (!file_exists($destination_folder)) {
                mkdir($destination_folder, 0777, true);
            }

            $filename_full = $destination_folder.$internalid."_full.jpg";
            $filename_thumb = $destination_folder.$internalid."_thumb.jpg";

            $maxside = 500;

            $file = $files['pic'];
            $file->moveTo($filename_full);

            list($width, $height) = getimagesize($filename_full);
            /** Version with same proportion as original **/
            if ($width > $height) {
                $newwidth = $maxside;
                $newheight = $height * $maxside / $width;
            } else {
                $newheight = $maxside;
                $newwidth = $width * $maxside / $height;
            }
            /** Version with squared thumb **/
            // $newwidth = $maxside;
            // $newheight = $maxside;

            $image_dest = imagecreatetruecolor($newwidth, $newheight);
            $image_orig = imagecreatefromjpeg($filename_full);
            imagecopyresampled($image_dest, $image_orig, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            imagejpeg($image_dest, $filename_thumb, 90);

            $mapper = MapperFactory::getMapper($this->db,$param_element);
            $mapper->addPicture($internalid, $userid);

            return $response->withStatus(201);

        } catch (Exception $e){
            $this->applogger->addInfo($e->getMessage());
            return $response->withStatus(400);
        }
    } else {
        $this->applogger->addInfo("POST images/$param_element/$internalid Forbidden, not allowed to");
        return $response->withStatus(403);
    }


});
