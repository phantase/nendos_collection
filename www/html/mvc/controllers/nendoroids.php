<?php

include_once('mvc/models/nendoroids.php');
$nendoroids = get_allNendoroids();
foreach ($nendoroids as $key => $nendoroid) {
  $nendoroids[$key]['url'] = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nendoroid['name'])));
}

$page_title = "Nendoroids";

include_once('mvc/views/pages/skeleton.php');
