<?php

if( isset($_GET['order']) && isset($_GET['direction']) ){
  $selected_order = $_GET['order'];
  $selected_direction = $_GET['direction'];
} else {
  $selected_order = "db_creationdate";
  $selected_direction = "desc";
}

$resultInfo = get_allNendoroids($selected_order,$selected_direction,$_SESSION['userid']);
if($resultInfo[0]=="00000"){
  $nendoroids = $resultInfo[4];
  foreach ($nendoroids as $key => $nendoroid) {
    $nendoroids[$key]['nendoroid_url'] = urlize($nendoroid['nendoroid_name']);
    if( $nendoroid['coll_additiondate'] ) {
      $nendoroids[$key]['coll_additionsince'] = ((new DateTime($nendoroid['now']))->diff(new DateTime($nendoroid['coll_additiondate'])));
    }
  }

  $page_title = "Nendoroids";
} else {
  raiseError($resultInfo[2]);
}

include_once('mvc/views/pages/skeleton.php');
