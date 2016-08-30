<?php

if( isset($_GET['handinternalid']) ){
  $handinternalid = $_GET['handinternalid'];

  include_once('mvc/models/hands.php');
  $hand = get_singleHand($handinternalid);
  if($hand['nendoroid_id']){
    $hand['nendoroid_url'] = urlize($hand['nendoroid_name']);
  }
  $metadata = array('creator'=>$hand['creator'],
                    'creator_name'=>$hand['creator_name'],
                    'creation'=>$hand['creation'],
                    'creation_diff'=>((new DateTime($hand['now']))->diff(new DateTime($hand['creation']))),
                    'editor'=>$hand['editor'],
                    'editor_name'=>$hand['editor_name'],
                    'edition'=>$hand['edition'],
                    'edition_diff'=>((new DateTime($hand['now']))->diff(new DateTime($hand['edition']))));

  $page_title = "Hand";

  include_once('mvc/views/pages/skeleton.php');

} else {

}
