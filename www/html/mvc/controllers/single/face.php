<?php

if( isset($_GET['faceinternalid']) ){
  $faceinternalid = $_GET['faceinternalid'];

  include_once('mvc/models/faces.php');
  $face = get_singleFace($faceinternalid);
  if($face['nendoroid_id']){
    $face['nendoroid_url'] = urlize($face['nendoroid_name']);
  }
  $metadata = array('creator'=>$face['creator'],
                    'creator_name'=>$face['creator_name'],
                    'creation'=>$face['creation'],
                    'creation_diff'=>((new DateTime($face['now']))->diff(new DateTime($face['creation']))),
                    'editor'=>$face['editor'],
                    'editor_name'=>$face['editor_name'],
                    'edition'=>$face['edition'],
                    'edition_diff'=>((new DateTime($face['now']))->diff(new DateTime($face['edition']))));

  $page_title = "Face";

  include_once('mvc/views/pages/skeleton.php');

} else {

}
