<?php

  if( isLogged() ) {
    raiseError("You're already logged in, why do you want to log in again ? Or maybe you want to <a id=\"logout_submit\">Log out</a>.");
  }

  $page_title = "Login";

  include_once('mvc/views/pages/skeleton.php');
