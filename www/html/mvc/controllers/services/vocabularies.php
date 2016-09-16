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
  default:
    die(json_encode(array("result"=>"faillure","reason"=>"Element is not supported")));
    break;
}

echo json_encode(array("result"=>"success","vocabularies"=>$vocabularies));
