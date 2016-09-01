<?php

include_once('mvc/models/bodyparts.php');
if( isset($_GET['order']) && isset($_GET['direction']) ){
  $selected_order = $_GET['order'];
  $selected_direction = $_GET['direction'];
} else {
  $selected_order = "creation";
  $selected_direction = "desc";
}

$bodyparts = get_allBodyParts($selected_order,$selected_direction);

$page_title = "Body parts";

include_once('mvc/views/pages/skeleton.php');
