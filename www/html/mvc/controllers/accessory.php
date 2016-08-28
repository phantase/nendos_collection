<?php

if( isset($_GET['accessoryinternalid']) ){
  $accessoryinternalid = $_GET['accessoryinternalid'];

  include_once('mvc/models/accessories.php');
  $accessory = get_singleAccessory($accessoryinternalid);
  if($accessory['nendoroid_id']){
    $accessory['nendoroid_url'] = urlize($accessory['nendoroid_name']);
  }

  $page_title = "Accessory";

  include_once('mvc/views/pages/skeleton.php');

} else {

}
