<?php

header('Content-Type: application/json');

if( ! isset($_GET['term']) ){
 raiseError("No term searched");
}

$resultInfo = search_allBoxes($_GET['term']);
if( $resultInfo[0]=="00000" ){
  $boxes = $resultInfo[4];
} else {
  raiseError($resultInfo[2]);
}

echo json_encode($boxes);
