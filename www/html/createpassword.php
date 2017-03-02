<?php

function encrypt($string){
  return base64_encode(base64_encode(base64_encode($string)));
}
function decrypt($string){
  return base64_decode(base64_decode(base64_decode($string)));
}

$A_SALT = "Sel de Guérande";

$usermail = htmlentities($_GET['usermail']);
$password = htmlentities($_GET['password']);

$encpass = encrypt($usermail.$password.$A_SALT);

echo $encpass;
