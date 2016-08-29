<?php

include_once('mvc/models/hands.php');
$hands = get_allHands();

$page_title = "Hands";

include_once('mvc/views/pages/skeleton.php');
