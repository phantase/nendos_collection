<?php

if( isset($_GET['hairinternalid']) ){
  $hairinternalid = $_GET['hairinternalid'];

  include_once('mvc/models/hairs.php');
  $hair = get_singleHair($hairinternalid);
  if($hair['nendoroid_id']){
    $hair['nendoroid_url'] = urlize($hair['nendoroid_name']);
  }
  $metadata = array('creator'=>$hair['creator'],
                    'creator_name'=>$hair['creator_name'],
                    'creation'=>$hair['creation'],
                    'creation_diff'=>((new DateTime($hair['now']))->diff(new DateTime($hair['creation']))),
                    'editor'=>$hair['editor'],
                    'editor_name'=>$hair['editor_name'],
                    'edition'=>$hair['edition'],
                    'edition_diff'=>((new DateTime($hair['now']))->diff(new DateTime($hair['edition']))));

  $page_title = "Hair";

  include_once('mvc/views/pages/skeleton.php');

} else {

}
