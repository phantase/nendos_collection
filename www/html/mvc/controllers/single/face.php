<?php

if( isset($_GET['faceinternalid']) ){
  $faceinternalid = $_GET['faceinternalid'];

  include_once('mvc/models/faces.php');
  $face = get_singleFace($faceinternalid);
  if($face['nendoroid_id']){
    $face['nendoroid_url'] = urlize($face['nendoroid_name']);
  }

  $page_title = "Face";

  include_once('mvc/views/pages/skeleton.php');

} else {

}
