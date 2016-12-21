<?php

// Database connection
try
{
    $bdd = new PDO('mysql:host=db;dbname=nendos;charset=utf8', 'nendos', 'nendospass');
}
catch(Exception $e)
{
    die('Error : '.$e->getMessage());
}

include_once('mvc/models/accessories.php');
include_once('mvc/models/bodyparts.php');
include_once('mvc/models/boxes.php');
include_once('mvc/models/faces.php');
include_once('mvc/models/hairs.php');
include_once('mvc/models/hands.php');
include_once('mvc/models/nendoroids.php');
include_once('mvc/models/history.php');
include_once('mvc/models/users.php');
include_once('mvc/models/photos.php');

include_once('mvc/models/edit.php');
include_once('mvc/models/validate.php');

include_once('mvc/models/collection.php');

?>
