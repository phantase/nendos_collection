<?php

include_once('mvc/models/accessories.php');
if( isset($_GET['order']) && isset($_GET['direction']) ){
  $selected_order = $_GET['order'];
  $selected_direction = $_GET['direction'];
} else {
  $selected_order = "creation";
  $selected_direction = "desc";
}

$accessories = get_allAccessories($selected_order,$selected_direction);

$page_title = "Accessories";

include_once('mvc/views/pages/skeleton.php');
