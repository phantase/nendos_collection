<?php
/** Count all the users available in the DB */
function count_allUsers()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM users AS u");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Get all the users available in the DB */
function get_allUsers($order="signupdate",$direction="desc")
{
  $orders = array("username","usermail",
                  "administrator","validator","editor",
                  "signupdate","lastviewdate");
  $key = array_search($order, $orders);
  $order = $orders[$key];
  $directions = array("asc","desc");
  $key = array_search($direction, $directions);
  $direction = $directions[$key];

  global $bdd;

  $req = $bdd->prepare("SELECT u.internalid, u.username, u.usermail,
                              u.administrator, u.validator, u.editor,
                              u.signupdate, u.lastviewdate
                        FROM users AS u
                        ORDER BY $order $direction;");
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Get a single user from its userid */
function get_singleUser($userid)
{
  global $bdd;

  $req = $bdd->prepare("SELECT u.internalid, u.usermail, u.username,
                              u.administrator, u.validator, u.editor,
                              u.signupdate, u.lastviewdate
                        FROM users AS u
                        WHERE u.internalid = :userid");
  $req->bindParam(':userid',$userid);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetch();
  }

  return $resultInfo;
}
/** Check and Get a single user */
function checkAndGet_singleUser($username,$encpass)
{
  global $bdd;

  $req = $bdd->prepare("SELECT u.internalid, u.usermail, u.username,
                              u.administrator, u.validator, u.editor,
                              u.signupdate, u.lastviewdate
                        FROM users AS u
                        WHERE u.username = :username
                        AND u.encpass = :encpass");
  $req->bindParam(':username',$username);
  $req->bindParam(':encpass',$encpass);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetch();
  }

  return $resultInfo;
}
/** Add a single user (or at least try to) */
function add_singleUser($usermail,$username,$encpass)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO users(usermail, username, encpass)
                                  VALUES(:usermail,:username,:encpass)");
  $req->bindParam(':usermail',$usermail);
  $req->bindParam(':username',$username);
  $req->bindParam(':encpass',$encpass);
  $req->execute();


  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $bdd->lastInsertId();
  }

  return $resultInfo;
}

function edit_singleUser($userid,$field,$value)
{
  global $bdd;

  $allowedField = array("administrator"  ,"validator" ,"editor" );
  $fieldsType   = array("boolean"        ,"boolean"   ,"boolean" );
  $keyfield = array_search($field,$allowedField);
  $field = $allowedField[$keyfield];

  if( $fieldsType[$keyfield] == "boolean" ){
    if( $value == "true" ){
      $value = 1;
    } else {
      $value = 0;
    }
  }

  $req = $bdd->prepare("UPDATE users SET $field = :value WHERE internalid = :userid");
  $req->bindParam(':userid',$userid);
  $req->bindParam(':value',$value);
  $req->execute();

  $resultArray = $req->errorInfo();
  if($resultArray[0] == 0 ){
    $resultArray[4] = $bdd->lastInsertId();
  }

  return $resultArray;

}
