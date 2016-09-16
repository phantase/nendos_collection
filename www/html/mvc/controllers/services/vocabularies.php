<?php

header('Content-Type: application/json');

$vocabularies = array();

if( !isset($_GET['element']) ){
  die(json_encode(array("result"=>"faillure","reason"=>"No element provided")));
}
$element = $_GET['element'];

switch ($element) {
  case 'box':
    // SERIES
    $resultInfo = getBoxesVocabulary('series');
    if( $resultInfo[0] != "00000") {
      die(json_encode(array("result"=>"faillure","reason"=>$resultInfo[2])));
    }
    $vocabularies['series'] = $resultInfo[4];
    // MANUFACTURER
    $resultInfo = getBoxesVocabulary('manufacturer');
    if( $resultInfo[0] != "00000") {
      die(json_encode(array("result"=>"faillure","reason"=>$resultInfo[2])));
    }
    $vocabularies['manufacturer'] = $resultInfo[4];
    // CATEGORY
    $resultInfo = getBoxesVocabulary('category');
    if( $resultInfo[0] != "00000") {
      die(json_encode(array("result"=>"faillure","reason"=>$resultInfo[2])));
    }
    $vocabularies['category'] = $resultInfo[4];
    // SCULPTOR
    $resultInfo = getBoxesVocabulary('sculptor');
    if( $resultInfo[0] != "00000") {
      die(json_encode(array("result"=>"faillure","reason"=>$resultInfo[2])));
    }
    $vocabularies['sculptor'] = $resultInfo[4];
    // COOPERATION
    $resultInfo = getBoxesVocabulary('cooperation');
    if( $resultInfo[0] != "00000") {
      die(json_encode(array("result"=>"faillure","reason"=>$resultInfo[2])));
    }
    $vocabularies['cooperation'] = $resultInfo[4];
    break;
  case 'face':
    // EYES_COLOR
    $resultInfo = getFacesVocabulary('eyes_color');
    if( $resultInfo[0] != "00000") {
      die(json_encode(array("result"=>"faillure","reason"=>$resultInfo[2])));
    }
    $vocabularies['eyes_color'] = $resultInfo[4];
    // SKIN_COLOR
    $resultInfo = getFacesVocabulary('skin_color');
    if( $resultInfo[0] != "00000") {
      die(json_encode(array("result"=>"faillure","reason"=>$resultInfo[2])));
    }
    $vocabularies['skin_color'] = $resultInfo[4];
    break;
  case 'hair':
    // MAIN_COLOR
    $resultInfo = getHairsVocabulary('main_color');
    if( $resultInfo[0] != "00000") {
      die(json_encode(array("result"=>"faillure","reason"=>$resultInfo[2])));
    }
    $vocabularies['main_color'] = $resultInfo[4];
    // OTHER_COLOR
    $resultInfo = getHairsVocabulary('other_color');
    if( $resultInfo[0] != "00000") {
      die(json_encode(array("result"=>"faillure","reason"=>$resultInfo[2])));
    }
    $vocabularies['other_color'] = $resultInfo[4];
    // HAIRCUT
    $resultInfo = getHairsVocabulary('haircut');
    if( $resultInfo[0] != "00000") {
      die(json_encode(array("result"=>"faillure","reason"=>$resultInfo[2])));
    }
    $vocabularies['haircut'] = $resultInfo[4];
    break;
  case 'hand':
    // POSTURE
    $resultInfo = getHandsVocabulary('posture');
    if( $resultInfo[0] != "00000") {
      die(json_encode(array("result"=>"faillure","reason"=>$resultInfo[2])));
    }
    $vocabularies['posture'] = $resultInfo[4];
    // SKIN_COLOR
    $resultInfo = getHandsVocabulary('skin_color');
    if( $resultInfo[0] != "00000") {
      die(json_encode(array("result"=>"faillure","reason"=>$resultInfo[2])));
    }
    $vocabularies['skin_color'] = $resultInfo[4];
    break;
  case 'accessory':
    // MAIN_COLOR
    $resultInfo = getAccessoriesVocabulary('main_color');
    if( $resultInfo[0] != "00000") {
      die(json_encode(array("result"=>"faillure","reason"=>$resultInfo[2])));
    }
    $vocabularies['main_color'] = $resultInfo[4];
    // OTHER_COLOR
    $resultInfo = getAccessoriesVocabulary('other_color');
    if( $resultInfo[0] != "00000") {
      die(json_encode(array("result"=>"faillure","reason"=>$resultInfo[2])));
    }
    $vocabularies['other_color'] = $resultInfo[4];
    // HAIRCUT
    $resultInfo = getAccessoriesVocabulary('type');
    if( $resultInfo[0] != "00000") {
      die(json_encode(array("result"=>"faillure","reason"=>$resultInfo[2])));
    }
    $vocabularies['type'] = $resultInfo[4];
    break;
  case 'bodypart':
    // MAIN_COLOR
    $resultInfo = getBodypartsVocabulary('main_color');
    if( $resultInfo[0] != "00000") {
      die(json_encode(array("result"=>"faillure","reason"=>$resultInfo[2])));
    }
    $vocabularies['main_color'] = $resultInfo[4];
    // OTHER_COLOR
    $resultInfo = getBodypartsVocabulary('other_color');
    if( $resultInfo[0] != "00000") {
      die(json_encode(array("result"=>"faillure","reason"=>$resultInfo[2])));
    }
    $vocabularies['other_color'] = $resultInfo[4];
    // HAIRCUT
    $resultInfo = getBodypartsVocabulary('part');
    if( $resultInfo[0] != "00000") {
      die(json_encode(array("result"=>"faillure","reason"=>$resultInfo[2])));
    }
    $vocabularies['part'] = $resultInfo[4];
    break;
  default:
    die(json_encode(array("result"=>"faillure","reason"=>"Element is not supported")));
    break;
}

echo json_encode(array("result"=>"success","vocabularies"=>$vocabularies));
