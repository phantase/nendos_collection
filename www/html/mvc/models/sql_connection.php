<?php

// Database connection
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=nendos;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    die('Error : '.$e->getMessage());
}

?>
