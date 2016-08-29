<?php

if( isset($_GET['hairinternalid']) ){
  $hairinternalid = $_GET['hairinternalid'];

  include_once('mvc/models/hairs.php');
  $hair = get_singleHair($hairinternalid);
  if($hair['nendoroid_id']){
    $hair['nendoroid_url'] = urlize($hair['nendoroid_name']);
  }

  $page_title = "Hair";

  include_once('mvc/views/pages/skeleton.php');

} else {

}
