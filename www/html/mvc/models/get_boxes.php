<?php

function count_allBoxes()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM boxes AS a");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
