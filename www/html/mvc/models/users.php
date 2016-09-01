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
  $users = $req->fetchAll(PDO::FETCH_ASSOC);

  return $users;
}
/** Check and Get a single user */
function checkAndGet_singleUser($username,$encpass)
{
  global $bdd;

  $req = $bdd->prepare("SELECT u.internalid, u.username
                        FROM users AS u
                        WHERE u.username = :username
                        AND u.encpass = :encpass");
  $req->bindParam(':username',$username);
  $req->bindParam(':encpass',$encpass);
  $req->execute();
  $user = $req->fetch();

  return $user;
}
