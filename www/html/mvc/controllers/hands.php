<?php

include_once('mvc/models/get_hands.php');
$hands = get_allHands();

$page_title = "Hands";

include_once('mvc/views/pages/skeleton.php');
