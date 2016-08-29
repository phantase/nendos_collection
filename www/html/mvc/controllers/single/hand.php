<?php

if( isset($_GET['handinternalid']) ){
  $handinternalid = $_GET['handinternalid'];

  include_once('mvc/models/hands.php');
  $hand = get_singleHand($handinternalid);
  if($hand['nendoroid_id']){
    $hand['nendoroid_url'] = urlize($hand['nendoroid_name']);
  }

  $page_title = "Hand";

  include_once('mvc/views/pages/skeleton.php');

} else {

}
