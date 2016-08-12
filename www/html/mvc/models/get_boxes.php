<?php

function count_nendoroidBoxes()
{
  global $bdd;

  $req = $bdd->prepare("SELECT count(*) As count FROM boxes AS a");
  $req->execute();
  $count = $req->fetch();

  return $count['count'];
}
