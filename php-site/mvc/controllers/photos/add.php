<?php

if( ! isLogged() ){
  raiseError("You must be logged in to add a photo.");
}

$page_title = "Add a photo";

include_once('mvc/views/pages/skeleton.php');
