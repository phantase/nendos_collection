<?php

include_once('mvc/models/get_boxes.php');
$boxes = get_allBoxes();

$page_title = "Boxes";

include_once('mvc/views/pages/skeleton.php');
