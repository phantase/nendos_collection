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
function get_allUsers()
{
  global $bdd;

  $req = $bdd->prepare("SELECT u.internalid, u.username
                        FROM users AS u");
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $req->fetchAll(PDO::FETCH_ASSOC);
  }

  return $resultInfo;
}
/** Check and Get a single user */
function checkAndGet_singleUser($username,$encpass)
{
  global $bdd;

  $req = $bdd->prepare("SELECT u.internalid, u.usermail, u.username
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
