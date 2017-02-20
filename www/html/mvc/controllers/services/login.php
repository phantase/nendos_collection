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
$password = htmlentities($_POST['password']);

$encpass = encrypt($usermail.$password.$A_SALT);

include_once('mvc/models/users.php');

$resultInfo = checkAndGet_singleUser($usermail,$encpass);

if( $resultInfo[0] == "00000" ){
  $user = $resultInfo[4];

  if( $user ) {

    $_SESSION['userid'] = $user['internalid'];
    $_SESSION['usermail'] = $user['usermail'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['password'] = $password;
    $_SESSION['administrator'] = $user['administrator'];
    $_SESSION['validator'] = $user['validator'];
    $_SESSION['editor'] = $user['editor'];

    echo json_encode(array('result'=>'success','userid'=>$user['internalid'],'username'=>$user['username']));

  } else {
    echo json_encode(array('result'=>'failure','errorInfo'=>'No matching usermail/password in the Database...'));
  }
} else {
  echo json_encode(array('result'=>'failure','errorInfo'=>$resultInfo[2]));
}
