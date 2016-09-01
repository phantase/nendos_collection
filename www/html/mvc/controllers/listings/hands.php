<?php

include_once('mvc/models/hands.php');
if( isset($_GET['order']) && isset($_GET['direction']) ){
  $selected_order = $_GET['order'];
  $selected_direction = $_GET['direction'];
} else {
  $selected_order = "creation";
  $selected_direction = "desc";
}

$hands = get_allHands($selected_order,$selected_direction);

$page_title = "Hands";

include_once('mvc/views/pages/skeleton.php');
