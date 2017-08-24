<?php

abstract class Mapper {

  protected $db;

  public function __construct($db) {
    $this->db = $db;
  }

  protected $tablename;
  protected $collectiontablename;
  protected $favoritestablename;
  protected $tagstablename;
  protected $othertablecolumn;

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
            WHERE userid = :userid AND ".$this->othertablecolumn." = :elementid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["elementid" => $elementid, "userid" => $userid]);

    if( $result = $stmt->fetch() ) {
      $quantity = $result['quantity'] + 1;
      $sql = "UPDATE ".$this->collectiontablename."
              SET quantity = :quantity
              WHERE userid = :userid
              AND ".$this->othertablecolumn." = :elementid";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute(["elementid" => $elementid, "userid" => $userid, "quantity" => $quantity]);
    } else {
      $quantity = 1;
      $sql = "INSERT INTO ".$this->collectiontablename."(userid,".$this->othertablecolumn.")
              VALUES(:userid,:elementid)";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute(["elementid" => $elementid, "userid" => $userid]);
    }

    return $quantity;
  }
  public function uncollectForUser($elementid, $userid) {
    $sql = "SELECT quantity
            FROM ".$this->collectiontablename."
            WHERE userid = :userid AND ".$this->othertablecolumn." = :elementid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["elementid" => $elementid, "userid" => $userid]);

    if( $result = $stmt->fetch() ) {
      $quantity = $result['quantity'];
      if($quantity > 1) {
        $quantity --;
        $sql = "UPDATE ".$this->collectiontablename."
                SET quantity = :quantity
                WHERE userid = :userid
                AND ".$this->othertablecolumn." = :elementid";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["elementid" => $elementid, "userid" => $userid, "quantity" => $quantity]);
      } else {
        $quantity = 0;
        $sql = "DELETE FROM ".$this->collectiontablename."
                WHERE userid = :userid AND ".$this->othertablecolumn." = :elementid";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["elementid" => $elementid, "userid" => $userid]);
      }
    }

    return $quantity;
  }

  public function validateByUser($elementid, $userid) {
    $sql = "UPDATE ".$this->tablename."
            SET validatorid = :userid, validationdate = NOW()
            WHERE internalid = :elementid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["elementid" => $elementid, "userid" => $userid]);

    $resultArray = $stmt->errorInfo();
    if($resultArray[0] == 0 ){
      $this->addHistory($userid,$elementid,"Validation");
    }

    return $result;
  }
  public function unvalidateByUser($elementid, $userid) {
    $sql = "UPDATE ".$this->tablename."
            SET validatorid = NULL, validationdate = NULL
            WHERE internalid = :elementid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["elementid" => $elementid]);

    $resultArray = $stmt->errorInfo();
    if($resultArray[0] == 0 ){
      $this->addHistory($userid,$elementid,"Unvalidation");
    }

    return $result;
  }

  public function favoriteForUser($elementid, $userid) {
    $sql = "INSERT INTO ".$this->favoritestablename."(userid,".$this->othertablecolumn.")
            VALUES(:userid,:elementid)";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["elementid" => $elementid, "userid" => $userid]);
  }
  public function unfavoriteForUser($elementid, $userid) {
    $sql = "DELETE FROM ".$this->favoritestablename."
            WHERE userid = :userid AND ".$this->othertablecolumn." = :elementid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["elementid" => $elementid, "userid" => $userid]);
  }

  public function addHistory($userid, $elementid, $action) {
    return null;
  }

  public function tag($elementid, $tag, $userid) {
    $sql = "SELECT grade
            FROM ".$this->tagstablename."
            WHERE ".$this->othertablecolumn." = :elementid AND tag = :tag";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["elementid" => $elementid, "tag" => $tag]);

    if( $result = $stmt->fetch() ) {
      $grade = $result['grade'] + 1;
      $sql = "UPDATE ".$this->tagstablename."
              SET grade = :grade
              WHERE ".$this->othertablecolumn." = :elementid
              AND tag = :tag";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute(["elementid" => $elementid, "tag" => $tag, "grade" => $grade]);
    } else {
      $grade = 1;
      $sql = "INSERT INTO ".$this->tagstablename."(userid,".$this->othertablecolumn.",tag)
              VALUES(:userid,:elementid,:tag)";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute(["elementid" => $elementid, "userid" => $userid, "tag" => $tag]);
    }

    return $grade;
  }

  public function untag($elementid, $tag, $userid) {
    $sql = "SELECT grade
            FROM ".$this->tagstablename."
            WHERE ".$this->othertablecolumn." = :elementid AND tag = :tag";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["elementid" => $elementid, "tag" => $tag]);

    if( $result = $stmt->fetch() ) {
      $grade = $result['grade'];
      if($grade > 1) {
        $grade --;
        $sql = "UPDATE ".$this->tagstablename."
                SET grade = :grade
                WHERE tag = :tag
                AND ".$this->othertablecolumn." = :elementid";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["elementid" => $elementid, "tag" => $tag, "grade" => $grade]);
      } else {
        $grade = 0;
        $sql = "DELETE FROM ".$this->tagstablename."
                WHERE tag = :tag AND ".$this->othertablecolumn." = :elementid";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["elementid" => $elementid, "tag" => $tag]);
      }
    }

    return $grade;
  }

}
