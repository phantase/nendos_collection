<?php

include_once('mvc/models/boxes.php');
if( isset($_GET['order']) && isset($_GET['direction']) ){
  $selected_order = $_GET['order'];
  $selected_direction = $_GET['direction'];
} else {
  $selected_order = "creation";
  $selected_direction = "desc";
}

$boxes = get_allBoxes($selected_order,$selected_direction);

$page_title = "Boxes";

include_once('mvc/views/pages/skeleton.php');
