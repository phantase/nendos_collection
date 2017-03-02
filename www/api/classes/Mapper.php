<?php

abstract class Mapper {

  protected $db;

  public function __construct($db) {
    $this->db = $db;
  }

  protected $tablename;
  protected $collectiontablename;
  protected $collectioncolumn;

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

  public function collectForUser($elementid, $userid) {
    $sql = "SELECT quantity
            FROM ".$this->collectiontablename."
            WHERE userid = :userid AND ".$this->collectioncolumn." = :elementid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["elementid" => $elementid, "userid" => $userid]);

    if( $result = $stmt->fetch() ) {
      $quantity = $result['quantity'] + 1;
      $sql = "UPDATE ".$this->collectiontablename."
              SET quantity = :quantity
              WHERE userid = :userid
              AND ".$this->collectioncolumn." = :elementid";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute(["elementid" => $elementid, "userid" => $userid, "quantity" => $quantity]);
    } else {
      $quantity = 1;
      $sql = "INSERT INTO ".$this->collectiontablename."(userid,".$this->collectioncolumn.")
              VALUES(:userid,:elementid)";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute(["elementid" => $elementid, "userid" => $userid]);
    }

    return $quantity;
  }

}
