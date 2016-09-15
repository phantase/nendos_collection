<?php

header('Content-Type: application/json');

if( session_destroy() ){
  echo json_encode(array('result'=>'success'));
} else {
  echo json_encode(array('result'=>'faillure'));
}
