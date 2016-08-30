<?php

if( isset($_GET['accessoryinternalid']) ){
  $accessoryinternalid = $_GET['accessoryinternalid'];

  include_once('mvc/models/accessories.php');
  $accessory = get_singleAccessory($accessoryinternalid);
  if($accessory['nendoroid_id']){
    $accessory['nendoroid_url'] = urlize($accessory['nendoroid_name']);
  }
  $metadata = array('creator'=>$accessory['creator'],
                    'creator_name'=>$accessory['creator_name'],
                    'creation'=>$accessory['creation'],
                    'creation_diff'=>((new DateTime($accessory['now']))->diff(new DateTime($accessory['creation']))),
                    'editor'=>$accessory['editor'],
                    'editor_name'=>$accessory['editor_name'],
                    'edition'=>$accessory['edition'],
                    'edition_diff'=>((new DateTime($accessory['now']))->diff(new DateTime($accessory['edition']))));

  $page_title = "Accessory";

  include_once('mvc/views/pages/skeleton.php');

} else {

}
