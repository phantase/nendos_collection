<?php

class FaceMapper extends Mapper
{
  protected $tablename = "faces";
  protected $collectiontablename = "users_faces_collection";
  protected $collectioncolumn = "faceid";

  public function get($userid=null) {
    $sql = "SELECT f.internalid, f.boxid, f.nendoroidid, f.eyes, f.eyes_color, f.mouth, f.skin_color, f.sex,
                  f.creatorid, uc.username AS creatorname, f.creationdate,
                  f.editorid, ue.username AS editorname, f.editiondate,
                  f.validatorid, uv.username AS validatorname, f.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM faces f
            LEFT JOIN users uc ON f.creatorid = uc.internalid
            LEFT JOIN users ue ON f.editorid = ue.internalid
            LEFT JOIN users uv ON f.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT faceid, additiondate, quantity
                  FROM users_faces_collection
                  WHERE userid = :userid
                  ) AS ucol ON f.internalid = ucol.faceid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new FaceEntity($row);
    }
    return $results;
  }

  public function getByInternalid($face_internalid, $userid=null) {
    $sql = "SELECT f.internalid, f.boxid, f.nendoroidid, f.eyes, f.eyes_color, f.mouth, f.skin_color, f.sex,
                  f.creatorid, uc.username AS creatorname, f.creationdate,
                  f.editorid, ue.username AS editorname, f.editiondate,
                  f.validatorid, uv.username AS validatorname, f.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM faces f
            LEFT JOIN users uc ON f.creatorid = uc.internalid
            LEFT JOIN users ue ON f.editorid = ue.internalid
            LEFT JOIN users uv ON f.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT faceid, additiondate, quantity
                  FROM users_faces_collection
                  WHERE userid = :userid
                  ) AS ucol ON f.internalid = ucol.faceid
            WHERE f.internalid = :face_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["face_internalid" => $face_internalid, "userid" => $userid]);

    if($row = $stmt->fetch()) {
      return new FaceEntity($row);
    }
  }

  public function getByBoxid($boxid, $userid=null) {
    $sql = "SELECT f.internalid, f.boxid, f.nendoroidid, f.eyes, f.eyes_color, f.mouth, f.skin_color, f.sex,
                  f.creatorid, uc.username AS creatorname, f.creationdate,
                  f.editorid, ue.username AS editorname, f.editiondate,
                  f.validatorid, uv.username AS validatorname, f.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM faces f
            LEFT JOIN users uc ON f.creatorid = uc.internalid
            LEFT JOIN users ue ON f.editorid = ue.internalid
            LEFT JOIN users uv ON f.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT faceid, additiondate, quantity
                  FROM users_faces_collection
                  WHERE userid = :userid
                  ) AS ucol ON f.internalid = ucol.faceid
            WHERE f.boxid = :boxid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["boxid" => $boxid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new FaceEntity($row);
    }
    return $results;
  }

  public function getByNendoroidid($nendoroidid, $userid=null) {
    $sql = "SELECT f.internalid, f.boxid, f.nendoroidid, f.eyes, f.eyes_color, f.mouth, f.skin_color, f.sex,
                  f.creatorid, uc.username AS creatorname, f.creationdate,
                  f.editorid, ue.username AS editorname, f.editiondate,
                  f.validatorid, uv.username AS validatorname, f.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM faces f
            LEFT JOIN users uc ON f.creatorid = uc.internalid
            LEFT JOIN users ue ON f.editorid = ue.internalid
            LEFT JOIN users uv ON f.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT faceid, additiondate, quantity
                  FROM users_faces_collection
                  WHERE userid = :userid
                  ) AS ucol ON f.internalid = ucol.faceid
            WHERE f.nendoroidid = :nendoroidid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["nendoroidid" => $nendoroidid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new FaceEntity($row);
    }
    return $results;
  }

  public function getByFaceid($faceid, $userid=null) {
    $sql = "SELECT f.internalid, f.boxid, f.nendoroidid, f.eyes, f.eyes_color, f.mouth, f.skin_color, f.sex,
                  f.creatorid, uc.username AS creatorname, f.creationdate,
                  f.editorid, ue.username AS editorname, f.editiondate,
                  f.validatorid, uv.username AS validatorname, f.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM faces f
            LEFT JOIN users uc ON f.creatorid = uc.internalid
            LEFT JOIN users ue ON f.editorid = ue.internalid
            LEFT JOIN users uv ON f.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT faceid, additiondate, quantity
                  FROM users_faces_collection
                  WHERE userid = :userid
                  ) AS ucol ON f.internalid = ucol.faceid
            WHERE f.internalid = :faceid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["faceid" => $faceid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new FaceEntity($row);
    }
    return $results;
  }

  public function getByPhotoid($photoid, $userid=null) {
    $sql = "SELECT f.internalid, f.boxid, f.nendoroidid, f.eyes, f.eyes_color, f.mouth, f.skin_color, f.sex,
                  f.creatorid, uc.username AS creatorname, f.creationdate,
                  f.editorid, ue.username AS editorname, f.editiondate,
                  f.validatorid, uv.username AS validatorname, f.validationdate,
                  pf.xmin, pf.xmax, pf.ymin, pf.ymax, pf.internalid AS photoannotationid,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM faces f
            LEFT JOIN users uc ON f.creatorid = uc.internalid
            LEFT JOIN users ue ON f.editorid = ue.internalid
            LEFT JOIN users uv ON f.validatorid = uv.internalid
            LEFT JOIN photos_faces pf ON f.internalid = pf.faceid
            LEFT JOIN (
                  SELECT faceid, additiondate, quantity
                  FROM users_faces_collection
                  WHERE userid = :userid
                  ) AS ucol ON f.internalid = ucol.faceid
            WHERE pf.photoid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new FaceEntity($row);
    }
    return $results;
  }
}
