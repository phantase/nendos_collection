<?php

if( isset($_GET['bodypartinternalid']) ){
  $bodypartinternalid = $_GET['bodypartinternalid'];

  include_once('mvc/models/bodyparts.php');
  $bodypart = get_singleBodypart($bodypartinternalid);
  if($bodypart['nendoroid_id']){
    $bodypart['nendoroid_url'] = urlize($bodypart['nendoroid_name']);
  }

  $page_title = "Bodypart";

  include_once('mvc/views/pages/skeleton.php');

} else {

}
