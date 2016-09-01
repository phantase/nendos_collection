<?php

include_once('mvc/models/boxes.php');
if( isset($_GET['order']) && isset($_GET['direction']) ){
  $selected_order = $_GET['order'];
  $selected_direction = $_GET['direction'];
} else {
  $selected_order = "db_creationdate";
  $selected_direction = "desc";
}

$boxes = get_allBoxes($selected_order,$selected_direction);
foreach ($boxes as $key => $box) {
  $boxes[$key]['box_url'] = urlize($box['box_name']);
}

$page_title = "Boxes";

include_once('mvc/views/pages/skeleton.php');
