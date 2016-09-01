<?php

include_once('mvc/models/faces.php');
if( isset($_GET['order']) && isset($_GET['direction']) ){
  $selected_order = $_GET['order'];
  $selected_direction = $_GET['direction'];
} else {
  $selected_order = "creation";
  $selected_direction = "desc";
}

$faces = get_allFaces($selected_order,$selected_direction);

$page_title = "Faces";

include_once('mvc/views/pages/skeleton.php');
