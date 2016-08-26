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

?>
