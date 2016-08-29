<?php

include_once('mvc/models/hairs.php');
$hairs = get_allHairs();

$page_title = "Hairs";

include_once('mvc/views/pages/skeleton.php');
