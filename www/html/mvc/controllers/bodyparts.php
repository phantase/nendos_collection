<?php

include_once('mvc/models/get_bodyparts.php');
$bodyparts = get_allBodyParts();

$page_title = "Body parts";

include_once('mvc/views/pages/skeleton.php');
