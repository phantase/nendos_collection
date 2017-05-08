<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Add an element
$app->post('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands}', function(Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    if( $request->getAttribute("token")->user->administrator || $request->getAttribute("token")->user->editor ) {
        $element = $args['element'];
        $data = $request->getParsedBody();
        $this->applogger->addInfo("User $userid adds a new $element");

        $newelement = null;

        try {
            switch ($element) {
                case "accessory":
                case "accessories":
                    $accessory_data = [];
                    $accessory_data['boxid']        = array_key_exists('boxid',         $data) ? filter_var($data['boxid'],         FILTER_SANITIZE_NUMBER_INT) : null;
                    $accessory_data['nendoroidid']  = array_key_exists('nendoroidid',   $data) ? filter_var($data['nendoroidid'],   FILTER_SANITIZE_NUMBER_INT) : null;
                    $accessory_data['type']         = array_key_exists('type',          $data) ? filter_var($data['type'],          FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $accessory_data['main_color']   = array_key_exists('main_color',    $data) ? filter_var($data['main_color'],    FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $accessory_data['other_color']  = array_key_exists('other_color',   $data) ? filter_var($data['other_color'],   FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $accessory_data['description']  = array_key_exists('description',   $data) ? filter_var($data['description'],   FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $accessory = new AccessoryEntity($accessory_data);

                    $accessory_mapper = new AccessoryMapper($this->db);
                    $newelement = $accessory_mapper->create($accessory, $userid);
                    break;
                case "bodypart":
                case "bodyparts":
                    $bodypart_data = [];
                    $bodypart_data['boxid']         = array_key_exists('boxid',         $data) ? filter_var($data['boxid'],         FILTER_SANITIZE_NUMBER_INT) : null;
                    $bodypart_data['nendoroidid']   = array_key_exists('nendoroidid',   $data) ? filter_var($data['nendoroidid'],   FILTER_SANITIZE_NUMBER_INT) : null;
                    $bodypart_data['part']          = array_key_exists('part',          $data) ? filter_var($data['part'],          FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $bodypart_data['main_color']    = array_key_exists('main_color',    $data) ? filter_var($data['main_color'],    FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $bodypart_data['other_color']   = array_key_exists('other_color',   $data) ? filter_var($data['other_color'],   FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $bodypart_data['description']   = array_key_exists('description',   $data) ? filter_var($data['description'],   FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $bodypart = new BodypartEntity($bodypart_data);

                    $bodypart_mapper = new BodypartMapper($this->db);
                    $newelement = $bodypart_mapper->create($bodypart, $userid);
                    break;
                case "face":
                case "faces":
                    $face_data = [];
                    $face_data['boxid']         = array_key_exists('boxid',         $data) ? filter_var($data['boxid'],         FILTER_SANITIZE_NUMBER_INT) : null;
                    $face_data['nendoroidid']   = array_key_exists('nendoroidid',   $data) ? filter_var($data['nendoroidid'],   FILTER_SANITIZE_NUMBER_INT) : null;
                    $face_data['eyes']          = array_key_exists('eyes',          $data) ? filter_var($data['eyes'],          FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $face_data['eyes_color']    = array_key_exists('eyes_color',    $data) ? filter_var($data['eyes_color'],    FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $face_data['mouth']         = array_key_exists('mouth',         $data) ? filter_var($data['mouth'],         FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $face_data['skin_color']    = array_key_exists('skin_color',    $data) ? filter_var($data['skin_color'],    FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $face_data['sex']           = array_key_exists('sex',           $data) ? filter_var($data['sex'],           FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $face = new FaceEntity($face_data);

                    $face_mapper = new FaceMapper($this->db);
                    $newelement = $face_mapper->create($face, $userid);
                    break;
                case "hair":
                case "hairs":
                    $hair_data = [];
                    $hair_data['boxid']         = array_key_exists('boxid',         $data) ? filter_var($data['boxid'],         FILTER_SANITIZE_NUMBER_INT) : null;
                    $hair_data['nendoroidid']   = array_key_exists('nendoroidid',   $data) ? filter_var($data['nendoroidid'],   FILTER_SANITIZE_NUMBER_INT) : null;
                    $hair_data['main_color']    = array_key_exists('main_color',    $data) ? filter_var($data['main_color'],    FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $hair_data['other_color']   = array_key_exists('other_color',   $data) ? filter_var($data['other_color'],   FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $hair_data['haircut']       = array_key_exists('haircut',       $data) ? filter_var($data['haircut'],       FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $hair_data['description']   = array_key_exists('description',   $data) ? filter_var($data['description'],   FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $hair_data['frontback']     = array_key_exists('frontback',     $data) ? filter_var($data['frontback'],     FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $hair = new HairEntity($hair_data);

                    $hair_mapper = new HairMapper($this->db);
                    $newelement = $hair_mapper->create($hair, $userid);
                    break;
                case "hand":
                case "hands":
                    $hand_data = [];
                    $hand_data['boxid']         = array_key_exists('boxid',         $data) ? filter_var($data['boxid'],         FILTER_SANITIZE_NUMBER_INT) : null;
                    $hand_data['nendoroidid']   = array_key_exists('nendoroidid',   $data) ? filter_var($data['nendoroidid'],   FILTER_SANITIZE_NUMBER_INT) : null;
                    $hand_data['skin_color']    = array_key_exists('skin_color',    $data) ? filter_var($data['skin_color'],    FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $hand_data['leftright']     = array_key_exists('leftright',     $data) ? filter_var($data['leftright'],     FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $hand_data['posture']       = array_key_exists('posture',       $data) ? filter_var($data['posture'],       FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $hand_data['description']   = array_key_exists('description',   $data) ? filter_var($data['description'],   FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $hand = new HandEntity($hand_data);

                    $hand_mapper = new HandMapper($this->db);
                    $newelement = $hand_mapper->create($hand, $userid);
                    break;
                case "nendoroid":
                case "nendoroids":
                    $nendoroid_data = [];
                    $nendoroid_data['boxid']            = array_key_exists('boxid',             $data) ? filter_var($data['boxid'],             FILTER_SANITIZE_NUMBER_INT) : null;
                    $nendoroid_data['name']             = array_key_exists('name',              $data) ? filter_var($data['name'],              FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $nendoroid_data['version']          = array_key_exists('version',           $data) ? filter_var($data['version'],           FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $nendoroid_data['sex']              = array_key_exists('sex',               $data) ? filter_var($data['sex'],               FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $nendoroid_data['dominant_color']   = array_key_exists('dominant_color',    $data) ? filter_var($data['dominant_color'],    FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $nendoroid = new NendoroidEntity($nendoroid_data);

                    $nendoroid_mapper = new NendoroidMapper($this->db);
                    $newelement = $nendoroid_mapper->create($nendoroid, $userid);
                    break;
                case "box":
                case "boxes":
                    $box_data = [];
                    $box_data['number']         = array_key_exists('number',            $data) ? filter_var($data['number'],            FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $box_data['name']           = array_key_exists('name',              $data) ? filter_var($data['name'],              FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $box_data['series']         = array_key_exists('series',            $data) ? filter_var($data['series'],            FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $box_data['manufacturer']   = array_key_exists('manufacturer',      $data) ? filter_var($data['manufacturer'],      FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $box_data['category']       = array_key_exists('category',          $data) ? filter_var($data['category'],          FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $box_data['price']          = array_key_exists('price',             $data) ? filter_var($data['price'],             FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $box_data['releasedate']    = array_key_exists('releasedate',       $data) ? filter_var($data['releasedate'],       FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $box_data['specifications'] = array_key_exists('specifications',    $data) ? filter_var($data['specifications'],    FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $box_data['sculptor']       = array_key_exists('sculptor',          $data) ? filter_var($data['sculptor'],          FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $box_data['cooperation']    = array_key_exists('cooperation',       $data) ? filter_var($data['cooperation'],       FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
                    $box_data['officialurl']    = array_key_exists('officialurl',       $data) ? filter_var($data['officialurl'],       FILTER_SANITIZE_URL) : null;
                    $box = new BoxEntity($box_data);

                    $box_mapper = new BoxMapper($this->db);
                    $newelement = $box_mapper->create($box, $userid);
                    break;
            }

            if( is_null($newelement) ){
                $newresponse = $response->withStatus(500);
            } else {
                $newresponse = $response->withJson($newelement,201);
            }

        } catch (Exception $e){
            $this->applogger->addInfo($e);
            $newresponse = $response->withStatus(400);
        }
    } else {
        $this->applogger->addInfo("User $userid tries to create a new $element without right to do it");
        $newresponse = $response->withJson(null, 403);
    }
    return $newresponse;
});

// Add a photo
$app->post('/auth/{element:photo|photos}', function(Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;

    $data = $request->getParsedBody();
    $files = $request->getUploadedFiles();

    $this->applogger->addInfo("User $userid adds a new photo");

    $newelement = null;

    try {

        if (!$files['pic']) {
            throw new Exception("No file in request");
        }

        $maxside = 500;

        $file = $files['pic'];
        list($width, $height) = getimagesize($file->file);
        if ($width > $height) {
            $newwidth = $maxside;
            $newheight = $height * $maxside / $width;
        } else {
            $newheight = $maxside;
            $newwidth = $width * $maxside / $height;
        }

        $photo_data = [];
        $photo_data['userid']       = $userid;
        $photo_data['title']        = array_key_exists('title',             $data) ? filter_var($data['title'],             FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
        $photo_data['width']        = $width;
        $photo_data['height']       = $height;
        $photo = new PhotoEntity($photo_data);

        $photo_mapper = new PhotoMapper($this->db);
        $newelement = $photo_mapper->create($photo, $userid);

        if( is_null($newelement) ){
            $newresponse = $response->withStatus(500);
        } else {
            $destination_folder = "images/nendos/photos/";
            if (!file_exists($destination_folder)) {
                mkdir($destination_folder, 0777, true);
            }

            $internalid = $newelement->getInternalid();

            $filename_full = $destination_folder.$internalid."_full.jpg";
            $filename_thumb = $destination_folder.$internalid."_thumb.jpg";

            $file->moveTo($filename_full);
            $image_dest = imagecreatetruecolor($newwidth, $newheight);
            $image_orig = imagecreatefromjpeg($filename_full);
            imagecopyresampled($image_dest, $image_orig, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            imagejpeg($image_dest, $filename_thumb, 90);

            $newresponse = $response->withJson($newelement,201);
        }

    } catch (Exception $e){
        $this->applogger->addInfo($e);
        $newresponse = $response->withStatus(400);
    }

    return $newresponse;
});

// Add a part to a photo
$app->post('/auth/photo/{internalid:[0-9]+}/{element:box|nendoroid|accessory|bodypart|face|hair|hand}', function(Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    $photoid = (int)$args['internalid'];
    $param_element = $args['element'];
    $data = $request->getParsedBody();

    $this->applogger->addInfo("User $userid tags  photo $photoid with $param_element");

    $photoelement_data = [];
    $photoelement_data['photoid'] = $photoid;
    $photoelement_data['elementid'] = array_key_exists('elementid', $data) ? filter_var($data['elementid'], FILTER_SANITIZE_NUMBER_INT) : null;
    $photoelement_data['userid'] = $userid;
    $photoelement_data['xmin'] = array_key_exists('xmin', $data) ? filter_var($data['xmin'], FILTER_SANITIZE_NUMBER_INT) : null;
    $photoelement_data['xmax'] = array_key_exists('xmax', $data) ? filter_var($data['xmax'], FILTER_SANITIZE_NUMBER_INT) : null;
    $photoelement_data['ymin'] = array_key_exists('ymin', $data) ? filter_var($data['ymin'], FILTER_SANITIZE_NUMBER_INT) : null;
    $photoelement_data['ymax'] = array_key_exists('ymax', $data) ? filter_var($data['ymax'], FILTER_SANITIZE_NUMBER_INT) : null;
    $photoelement = new PhotoElementEntity($photoelement_data);

    try {
        $mapper = MapperFactory::getMapper($this->db,"photo".$param_element);
        $newelement = $mapper->create($photoelement, $userid);

        if( is_null($newelement) ){
            $newresponse = $response->withJson(null,500);
        } else {
            $newresponse = $response->withJson($newelement,201);
        }
    } catch (Exception $e){
        $this->applogger->addInfo($e);
        $newresponse = $response->withStatus(400);
    }

    return $newresponse;
});

// Add a news
$app->post('/auth/news', function(Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    if( $request->getAttribute("token")->user->administrator ) {
        $data = $request->getParsedBody();
        $this->applogger->addInfo("User $userid adds a new news");

        $newelement = null;

        try {
            $news_data = [];
            $news_data['title']         = array_key_exists('title',     $data) ? filter_var($data['title'],     FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
            $news_data['summary']       = array_key_exists('summary',   $data) ? filter_var($data['summary'],   FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
            $news_data['content']       = array_key_exists('content',   $data) ? filter_var($data['content'],   FILTER_UNSAFE_RAW) : null;
            $news_data['type']          = array_key_exists('type',      $data) ? filter_var($data['type'],      FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES) : null;
            $news = new NewsEntity($news_data);

            $news_mapper = new NewsMapper($this->db);
            $newelement = $news_mapper->create($news, $userid);

            if( is_null($newelement) ){
                $newresponse = $response->withStatus(500);
            } else {
                $newresponse = $response->withJson($newelement,201);
            }

        } catch (Exception $e){
            $this->applogger->addInfo($e);
            $newresponse = $response->withStatus(400);
        }
    } else {
        $this->applogger->addInfo("User $userid tries to create a new news without right to do it");
        $newresponse = $response->withJson(null, 403);
    }
    return $newresponse;
});
