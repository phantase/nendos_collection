<?php

include_once('mvc/models/get_nendoroids.php');
$nendoroids = get_allNendoroids();
foreach ($nendoroids as $key => $nendoroid) {
  $nendoroids[$key]['url'] = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $nendoroid['name'])));
}

include_once('mvc/views/pages/skeleton.php');
