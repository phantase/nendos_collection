<?php

include_once('mvc/models/get_accessories.php');
$accessories = get_allAccessories();

$page_title = "Accessories";

include_once('mvc/views/pages/skeleton.php');
