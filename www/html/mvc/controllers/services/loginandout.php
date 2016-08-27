<?php

/* Simple encryption and decryption for password */
function encrypt($string){
  return base64_encode(base64_encode(base64_encode($string)));
}
function decrypt($string){
  return base64_decode(base64_decode(base64_decode($string)));
}

$A_SALT = "Sel de Guérande";

if( isset($_POST['action']) ){
  $action = $_POST['action'];

  switch($action){
    case 'login':
      $username = htmlentities($_POST['username']);
      $password = htmlentities($_POST['password']);

      $encpass = encrypt($username.$password.$A_SALT);

      include_once('mvc/models/users.php');

      $user = checkAndGet_singleUser($username,$encpass);

      if( $user ){
        $_SESSION['userid'] = $user['internalid'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['password'] = $password;
        echo 1;
      } else {
        echo 0;
      }
      break;
    case 'logout':
      if( session_destroy() ){
        echo 1;
      } else {
        echo 0;
      }
      break;
  }
} else {
  echo 0;
}
