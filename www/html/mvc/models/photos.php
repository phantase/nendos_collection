<?php
/** Count all photos in the DB */
function count_allPhotos()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) AS count
                        FROM photos AS p");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
/** Add a photo to the DB */
function add_singlePhoto($userid,$title)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO photos(userid,title,uploaded,updated)
                        VALUES(:userid,:title,NOW(),NOW()");
  $req->bindParam(':userid',$userid);
  $req->bindParam(':title',$title);
  $req->execute();

  $resultInfo = $req->errorInfo();

  if( $resultInfo[0]=="00000" ){
    $resultInfo[4] = $bdd->lastInsertId();
  }

  return $resultInfo;
}
