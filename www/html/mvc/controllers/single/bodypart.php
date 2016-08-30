<?php

if( isset($_GET['bodypartinternalid']) ){
  $bodypartinternalid = $_GET['bodypartinternalid'];

  include_once('mvc/models/bodyparts.php');
  $bodypart = get_singleBodypart($bodypartinternalid);
  if($bodypart['nendoroid_id']){
    $bodypart['nendoroid_url'] = urlize($bodypart['nendoroid_name']);
  }
  $metadata = array('creator'=>$bodypart['creator'],
                    'creator_name'=>$bodypart['creator_name'],
                    'creation'=>$bodypart['creation'],
                    'creation_diff'=>((new DateTime($bodypart['now']))->diff(new DateTime($bodypart['creation']))),
                    'editor'=>$bodypart['editor'],
                    'editor_name'=>$bodypart['editor_name'],
                    'edition'=>$bodypart['edition'],
                    'edition_diff'=>((new DateTime($bodypart['now']))->diff(new DateTime($bodypart['edition']))));

  $page_title = "Bodypart";

  include_once('mvc/views/pages/skeleton.php');

} else {

}
