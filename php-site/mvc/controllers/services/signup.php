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

if( !$usermail = filter_var(htmlentities($_POST['usermail']), FILTER_VALIDATE_EMAIL) ) {
  die(json_encode(array('result'=>'faillure','errorInfo'=>'This is not a valid email...')));
}
$username = htmlentities($_POST['username']);
$password = htmlentities($_POST['password']);

$encpass = encrypt($username.$password.$A_SALT);

include_once('mvc/models/users.php');

$resultInfo = add_singleUser($usermail,$username,$encpass);

if( $resultInfo[0] == "00000" ){

  $_SESSION['userid'] = $resultInfo[4];
  $_SESSION['username'] = $username;
  $_SESSION['password'] = $password;
  $_SESSION['administrator'] = 0;
  $_SESSION['validator'] = 0;
  $_SESSION['editor'] = 0;

  echo json_encode(array('result'=>'success','userid'=>$resultInfo[4],'username'=>$username));
} else {
  echo json_encode(array('result'=>'failure','errorInfo'=>$resultInfo[2]));
}
