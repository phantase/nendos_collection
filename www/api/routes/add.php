<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Collect an element for a specific user
$app->post('/auth/{element:box|boxes|nendoroid|nendoroids|accessory|accessories|bodypart|bodyparts|face|faces|hair|hairs|hand|hands}/new', function(Request $request, Response $response, $args) {
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
                    $boxid = filter_var($data['boxid'], FILTER_SANITIZE_NUMBER_INT);
                    $accessory_data['boxid'] = $boxid === "" ? null : $boxid;
                    $nendoroidid = filter_var($data['nendoroidid'], FILTER_SANITIZE_NUMBER_INT);
                    $accessory_data['nendoroidid'] = $nendoroidid === "" ? null : $nendoroidid;
                    $accessory_data['type'] = filter_var($data['type'], FILTER_SANITIZE_STRING);
                    $accessory_data['main_color'] = filter_var($data['main_color'], FILTER_SANITIZE_STRING);
                    $accessory_data['other_color'] = filter_var($data['other_color'], FILTER_SANITIZE_STRING);
                    $accessory_data['description'] = filter_var($data['description'], FILTER_SANITIZE_STRING);
                    $accessory = new AccessoryEntity($accessory_data);

                    $accessory_mapper = new AccessoryMapper($this->db);
                    $newelement = $accessory_mapper->save($accessory, $userid);
                    break;
                case "bodypart":
                case "bodyparts":
                    $bodypart_data = [];
                    $boxid = filter_var($data['boxid'], FILTER_SANITIZE_NUMBER_INT);
                    $bodypart_data['boxid'] = $boxid === "" ? null : $boxid;
                    $nendoroidid = filter_var($data['nendoroidid'], FILTER_SANITIZE_NUMBER_INT);
                    $bodypart_data['nendoroidid'] = $nendoroidid === "" ? null : $nendoroidid;
                    $bodypart_data['part'] = filter_var($data['part'], FILTER_SANITIZE_STRING);
                    $bodypart_data['main_color'] = filter_var($data['main_color'], FILTER_SANITIZE_STRING);
                    $bodypart_data['other_color'] = filter_var($data['other_color'], FILTER_SANITIZE_STRING);
                    $bodypart_data['description'] = filter_var($data['description'], FILTER_SANITIZE_STRING);
                    $bodypart = new BodypartEntity($bodypart_data);

                    $bodypart_mapper = new BodypartMapper($this->db);
                    $newelement = $bodypart_mapper->save($bodypart, $userid);
                    break;
                case "face":
                case "faces":
                    $face_data = [];
                    $boxid = filter_var($data['boxid'], FILTER_SANITIZE_NUMBER_INT);
                    $face_data['boxid'] = $boxid === "" ? null : $boxid;
                    $nendoroidid = filter_var($data['nendoroidid'], FILTER_SANITIZE_NUMBER_INT);
                    $face_data['nendoroidid'] = $nendoroidid === "" ? null : $nendoroidid;
                    $face_data['eyes'] = filter_var($data['eyes'], FILTER_SANITIZE_STRING);
                    $face_data['eyes_color'] = filter_var($data['eyes_color'], FILTER_SANITIZE_STRING);
                    $face_data['mouth'] = filter_var($data['mouth'], FILTER_SANITIZE_STRING);
                    $face_data['skin_color'] = filter_var($data['skin_color'], FILTER_SANITIZE_STRING);
                    $face_data['sex'] = filter_var($data['sex'], FILTER_SANITIZE_STRING);
                    $face = new FaceEntity($face_data);

                    $face_mapper = new FaceMapper($this->db);
                    $newelement = $face_mapper->save($face, $userid);
                    break;
                case "hair":
                case "hairs":
                    $hair_data = [];
                    $boxid = filter_var($data['boxid'], FILTER_SANITIZE_NUMBER_INT);
                    $hair_data['boxid'] = $boxid === "" ? null : $boxid;
                    $nendoroidid = filter_var($data['nendoroidid'], FILTER_SANITIZE_NUMBER_INT);
                    $hair_data['nendoroidid'] = $nendoroidid === "" ? null : $nendoroidid;
                    $hair_data['main_color'] = filter_var($data['main_color'], FILTER_SANITIZE_STRING);
                    $hair_data['other_color'] = filter_var($data['other_color'], FILTER_SANITIZE_STRING);
                    $hair_data['haircut'] = filter_var($data['haircut'], FILTER_SANITIZE_STRING);
                    $hair_data['description'] = filter_var($data['description'], FILTER_SANITIZE_STRING);
                    $hair_data['frontback'] = filter_var($data['frontback'], FILTER_SANITIZE_STRING);
                    $hair = new HairEntity($hair_data);

                    $hair_mapper = new HairMapper($this->db);
                    $newelement = $hair_mapper->save($hair, $userid);
                    break;
                case "hand":
                case "hands":
                    $hand_data = [];
                    $boxid = filter_var($data['boxid'], FILTER_SANITIZE_NUMBER_INT);
                    $hand_data['boxid'] = $boxid === "" ? null : $boxid;
                    $nendoroidid = filter_var($data['nendoroidid'], FILTER_SANITIZE_NUMBER_INT);
                    $hand_data['nendoroidid'] = $nendoroidid === "" ? null : $nendoroidid;
                    $hand_data['skin_color'] = filter_var($data['skin_color'], FILTER_SANITIZE_STRING);
                    $hand_data['leftright'] = filter_var($data['leftright'], FILTER_SANITIZE_STRING);
                    $hand_data['posture'] = filter_var($data['posture'], FILTER_SANITIZE_STRING);
                    $hand_data['description'] = filter_var($data['description'], FILTER_SANITIZE_STRING);
                    $hand = new HandEntity($hand_data);

                    $hand_mapper = new HandMapper($this->db);
                    $newelement = $hand_mapper->save($hand, $userid);
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
