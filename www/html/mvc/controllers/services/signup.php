<?php

header('Content-Type: application/json');

/* Simple encryption and decryption for password */
function encrypt($string){
  return base64_encode(base64_encode(base64_encode($string)));
}
function decrypt($string){
  return base64_decode(base64_decode(base64_decode($string)));
}

$A_SALT = "Sel de Guérande";

$usermail = htmlentities($_POST['usermail']);
$username = htmlentities($_POST['username']);
$password = htmlentities($_POST['password']);

$encpass = encrypt($username.$password.$A_SALT);

include_once('mvc/models/users.php');

$resultInfo = add_singleUser($usermail,$username,$encpass);

if( $resultInfo[0] == "00000" ){

  $_SESSION['userid'] = $resultInfo[4];
  $_SESSION['username'] = $username;
  $_SESSION['password'] = $password;

  echo 1;
} else {
  echo 0;
}
