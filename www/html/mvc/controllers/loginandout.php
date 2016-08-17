<?php

/* Simple encryption and decryption for password */
function encrypt($string){
  return base64_encode(base64_encode(base64_encode($string)));
}
function decrypt($string){
  return base64_decode(base64_decode(base64_decode($string)));
}

$A_SALT = "Sel de Guérande";

if( isset($_POST['action']) && $_POST['action'] == 'login' ){
  $username = htmlentities($_POST['username']);
  $password = htmlentities($_POST['password']);

  $encpass = encrypt($username.$password.$A_SALT);

  include_once('mvc/models/get_users.php');

  $user = checkAndGet_singleUser($username,$encpass);

  if( $user ){
    $_SESSION['userid'] = $user['internalid'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['password'] = $password;
    echo 1;
  } else {
    echo 0;
  }


} else if( isset($_POST['action']) && $_POST['action'] == 'logout' ){
  if( session_destroy() ){
    echo 1;
  } else {
    echo 0;
  }
}
