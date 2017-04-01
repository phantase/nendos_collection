<?php

  if( isLogged() ) {
    raiseError("You're already logged in, why do you want to create a new account ? Or maybe you want to <a id=\"logout_submit\">Log out</a>.");
  }

  $page_title = "Sign up";

  include_once('mvc/views/pages/skeleton.php');
