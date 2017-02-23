<?php

class HairMapper extends Mapper
{
  protected $tablename = "hairs";

  public function get($userid=null) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.main_color, h.other_color, h.haircut, h.description, h.frontback,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM hairs h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT hairid, additiondate, quantity
                  FROM users_hairs_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.hairid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HairEntity($row);
    }
    return $results;
  }

  public function getByInternalid($hair_internalid, $userid=null) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.main_color, h.other_color, h.haircut, h.description, h.frontback,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM hairs h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT hairid, additiondate, quantity
                  FROM users_hairs_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.hairid
            WHERE h.internalid = :hair_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["hair_internalid" => $hair_internalid, "userid" => $userid]);

    if($row = $stmt->fetch()) {
      return new HairEntity($row);
    }
  }

  public function getByBoxid($boxid, $userid=null) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.main_color, h.other_color, h.haircut, h.description, h.frontback,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM hairs h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT hairid, additiondate, quantity
                  FROM users_hairs_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.hairid
            WHERE h.boxid = :boxid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["boxid" => $boxid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HairEntity($row);
    }
    return $results;
  }

  public function getByNendoroidid($nendoroidid, $userid=null) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.main_color, h.other_color, h.haircut, h.description, h.frontback,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM hairs h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT hairid, additiondate, quantity
                  FROM users_hairs_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.hairid
            WHERE h.nendoroidid = :nendoroidid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["nendoroidid" => $nendoroidid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HairEntity($row);
    }
    return $results;
  }

  public function getByHairid($hairid, $userid=null) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.main_color, h.other_color, h.haircut, h.description, h.frontback,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM hairs h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT hairid, additiondate, quantity
                  FROM users_hairs_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.hairid
            WHERE h.internalid = :hairid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["hairid" => $hairid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HairEntity($row);
    }
    return $results;
  }

  public function getByPhotoid($photoid, $userid=null) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.main_color, h.other_color, h.haircut, h.description, h.frontback,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate,
                  ph.xmin, ph.xmax, ph.ymin, ph.ymax, ph.internalid AS photoannotationid,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM hairs h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN photos_hairs ph ON h.internalid = ph.hairid
            LEFT JOIN (
                  SELECT hairid, additiondate, quantity
                  FROM users_hairs_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.hairid
            WHERE ph.photoid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HairEntity($row);
    }
    return $results;
  }
}
