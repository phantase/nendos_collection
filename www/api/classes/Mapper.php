<?php

abstract class Mapper {

  protected $db;

  public function __construct($db) {
    $this->db = $db;
  }

  protected $tablename;

  public function count() {
    $sql = "SELECT count(*) AS count FROM ".$this->tablename;
    $stmt = $this->db->query($sql);
    return $stmt->fetch();
  }

  public function countForUser($userid) {
    $sql = "SELECT count(*) AS count FROM users_".$this->tablename."_collection WHERE userid = :userid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["userid" => $userid]);
    return $stmt->fetch();
  }

  public function getByAccessoryid($accessoryid) {
    return null;
  }
  public function getByBodypartid($bodypartid) {
    return null;
  }
  public function getByFaceid($faceid) {
    return null;
  }
  public function getByHairid($hairid) {
    return null;
  }
  public function getByHandid($handid) {
    return null;
  }
  public function getByPhotoid($photoid) {
    return null;
  }

}
