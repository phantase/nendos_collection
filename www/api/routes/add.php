<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Collect an element for a specific user
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
                    $accessory_data['type']         = array_key_exists('type',          $data) ? filter_var($data['type'],          FILTER_SANITIZE_STRING) : null;
                    $accessory_data['main_color']   = array_key_exists('main_color',    $data) ? filter_var($data['main_color'],    FILTER_SANITIZE_STRING) : null;
                    $accessory_data['other_color']  = array_key_exists('other_color',   $data) ? filter_var($data['other_color'],   FILTER_SANITIZE_STRING) : null;
                    $accessory_data['description']  = array_key_exists('description',   $data) ? filter_var($data['description'],   FILTER_SANITIZE_STRING) : null;
                    $accessory = new AccessoryEntity($accessory_data);

                    $accessory_mapper = new AccessoryMapper($this->db);
                    $newelement = $accessory_mapper->save($accessory, $userid);
                    break;
                case "bodypart":
                case "bodyparts":
                    $bodypart_data = [];
                    $bodypart_data['boxid']         = array_key_exists('boxid',         $data) ? filter_var($data['boxid'],         FILTER_SANITIZE_NUMBER_INT) : null;
                    $bodypart_data['nendoroidid']   = array_key_exists('nendoroidid',   $data) ? filter_var($data['nendoroidid'],   FILTER_SANITIZE_NUMBER_INT) : null;
                    $bodypart_data['part']          = array_key_exists('part',          $data) ? filter_var($data['part'],          FILTER_SANITIZE_STRING) : null;
                    $bodypart_data['main_color']    = array_key_exists('main_color',    $data) ? filter_var($data['main_color'],    FILTER_SANITIZE_STRING) : null;
                    $bodypart_data['other_color']   = array_key_exists('other_color',   $data) ? filter_var($data['other_color'],   FILTER_SANITIZE_STRING) : null;
                    $bodypart_data['description']   = array_key_exists('description',   $data) ? filter_var($data['description'],   FILTER_SANITIZE_STRING) : null;
                    $bodypart = new BodypartEntity($bodypart_data);

                    $bodypart_mapper = new BodypartMapper($this->db);
                    $newelement = $bodypart_mapper->save($bodypart, $userid);
                    break;
                case "face":
                case "faces":
                    $face_data = [];
                    $face_data['boxid']         = array_key_exists('boxid',         $data) ? filter_var($data['boxid'],         FILTER_SANITIZE_NUMBER_INT) : null;
                    $face_data['nendoroidid']   = array_key_exists('nendoroidid',   $data) ? filter_var($data['nendoroidid'],   FILTER_SANITIZE_NUMBER_INT) : null;
                    $face_data['eyes']          = array_key_exists('eyes',          $data) ? filter_var($data['eyes'],          FILTER_SANITIZE_STRING) : null;
                    $face_data['eyes_color']    = array_key_exists('eyes_color',    $data) ? filter_var($data['eyes_color'],    FILTER_SANITIZE_STRING) : null;
                    $face_data['mouth']         = array_key_exists('mouth',         $data) ? filter_var($data['mouth'],         FILTER_SANITIZE_STRING) : null;
                    $face_data['skin_color']    = array_key_exists('skin_color',    $data) ? filter_var($data['skin_color'],    FILTER_SANITIZE_STRING) : null;
                    $face_data['sex']           = array_key_exists('sex',           $data) ? filter_var($data['sex'],           FILTER_SANITIZE_STRING) : null;
                    $face = new FaceEntity($face_data);

                    $face_mapper = new FaceMapper($this->db);
                    $newelement = $face_mapper->save($face, $userid);
                    break;
                case "hair":
                case "hairs":
                    $hair_data = [];
                    $hair_data['boxid']         = array_key_exists('boxid',         $data) ? filter_var($data['boxid'],         FILTER_SANITIZE_NUMBER_INT) : null;
                    $hair_data['nendoroidid']   = array_key_exists('nendoroidid',   $data) ? filter_var($data['nendoroidid'],   FILTER_SANITIZE_NUMBER_INT) : null;
                    $hair_data['main_color']    = array_key_exists('main_color',    $data) ? filter_var($data['main_color'],    FILTER_SANITIZE_STRING) : null;
                    $hair_data['other_color']   = array_key_exists('other_color',   $data) ? filter_var($data['other_color'],   FILTER_SANITIZE_STRING) : null;
                    $hair_data['haircut']       = array_key_exists('haircut',       $data) ? filter_var($data['haircut'],       FILTER_SANITIZE_STRING) : null;
                    $hair_data['description']   = array_key_exists('description',   $data) ? filter_var($data['description'],   FILTER_SANITIZE_STRING) : null;
                    $hair_data['frontback']     = array_key_exists('frontback',     $data) ? filter_var($data['frontback'],     FILTER_SANITIZE_STRING) : null;
                    $hair = new HairEntity($hair_data);

                    $hair_mapper = new HairMapper($this->db);
                    $newelement = $hair_mapper->save($hair, $userid);
                    break;
                case "hand":
                case "hands":
                    $hand_data = [];
                    $hand_data['boxid']         = array_key_exists('boxid',         $data) ? filter_var($data['boxid'],         FILTER_SANITIZE_NUMBER_INT) : null;
                    $hand_data['nendoroidid']   = array_key_exists('nendoroidid',   $data) ? filter_var($data['nendoroidid'],   FILTER_SANITIZE_NUMBER_INT) : null;
                    $hand_data['skin_color']    = array_key_exists('skin_color',    $data) ? filter_var($data['skin_color'],    FILTER_SANITIZE_STRING) : null;
                    $hand_data['leftright']     = array_key_exists('leftright',     $data) ? filter_var($data['leftright'],     FILTER_SANITIZE_STRING) : null;
                    $hand_data['posture']       = array_key_exists('posture',       $data) ? filter_var($data['posture'],       FILTER_SANITIZE_STRING) : null;
                    $hand_data['description']   = array_key_exists('description',   $data) ? filter_var($data['description'],   FILTER_SANITIZE_STRING) : null;
                    $hand = new HandEntity($hand_data);

                    $hand_mapper = new HandMapper($this->db);
                    $newelement = $hand_mapper->save($hand, $userid);
                    break;
                case "nendoroid":
                case "nendoroids":
                    $nendoroid_data = [];
                    $nendoroid_data['boxid']            = array_key_exists('boxid',             $data) ? filter_var($data['boxid'],             FILTER_SANITIZE_NUMBER_INT) : null;
                    $nendoroid_data['name']             = array_key_exists('name',              $data) ? filter_var($data['name'],              FILTER_SANITIZE_STRING) : null;
                    $nendoroid_data['version']          = array_key_exists('version',           $data) ? filter_var($data['version'],           FILTER_SANITIZE_STRING) : null;
                    $nendoroid_data['sex']              = array_key_exists('sex',               $data) ? filter_var($data['sex'],               FILTER_SANITIZE_STRING) : null;
                    $nendoroid_data['dominant_color']   = array_key_exists('dominant_color',    $data) ? filter_var($data['dominant_color'],    FILTER_SANITIZE_STRING) : null;
                    $nendoroid = new NendoroidEntity($nendoroid_data);

                    $nendoroid_mapper = new NendoroidMapper($this->db);
                    $newelement = $nendoroid_mapper->save($nendoroid, $userid);
                    break;
                case "box":
                case "boxes":
                    $box_data = [];
                    $box_data['number']         = array_key_exists('number',            $data) ? filter_var($data['number'],            FILTER_SANITIZE_STRING) : null;
                    $box_data['name']           = array_key_exists('name',              $data) ? filter_var($data['name'],              FILTER_SANITIZE_STRING) : null;
                    $box_data['series']         = array_key_exists('series',            $data) ? filter_var($data['series'],            FILTER_SANITIZE_STRING) : null;
                    $box_data['manufacturer']   = array_key_exists('manufacturer',      $data) ? filter_var($data['manufacturer'],      FILTER_SANITIZE_STRING) : null;
                    $box_data['category']       = array_key_exists('category',          $data) ? filter_var($data['category'],          FILTER_SANITIZE_STRING) : null;
                    $box_data['price']          = array_key_exists('price',             $data) ? filter_var($data['price'],             FILTER_SANITIZE_STRING) : null;
                    $box_data['releasedate']    = array_key_exists('releasedate',       $data) ? filter_var($data['releasedate'],       FILTER_SANITIZE_STRING) : null;
                    $box_data['specifications'] = array_key_exists('specifications',    $data) ? filter_var($data['specifications'],    FILTER_SANITIZE_STRING) : null;
                    $box_data['sculptor']       = array_key_exists('sculptor',          $data) ? filter_var($data['sculptor'],          FILTER_SANITIZE_STRING) : null;
                    $box_data['cooperation']    = array_key_exists('cooperation',       $data) ? filter_var($data['cooperation'],       FILTER_SANITIZE_STRING) : null;
                    $box_data['officialurl']    = array_key_exists('officialurl',       $data) ? filter_var($data['officialurl'],       FILTER_SANITIZE_URL) : null;
                    $box = new BoxEntity($box_data);

                    $box_mapper = new BoxMapper($this->db);
                    $newelement = $box_mapper->save($box, $userid);
                    break;
            }

            if( is_null($newelement) ){
                $newresponse = $response->withJson(null,500);
            } else {
                $newresponse = $response->withJson($newelement,201);
            }

        } catch (Exception $e){
            $this->applogger->addInfo($e);
            $newresponse = $response->withJson(null,400);
        }
    } else {
        $this->applogger->addInfo("User $userid tries to create a new $element without right to do it");
        $newresponse = $response->withJson(null, 403);
    }
    return $newresponse;
});
