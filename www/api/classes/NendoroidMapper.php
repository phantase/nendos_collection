<?php

class NendoroidMapper extends Mapper
{
  protected $tablename = "nendoroids";
  protected $collectiontablename = "users_nendoroids_collection";
  protected $collectioncolumn = "nendoroidid";

  public function get($userid=null) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT nendoroidid, additiondate, quantity
                  FROM users_nendoroids_collection
                  WHERE userid = :userid
                  ) AS ucol ON n.internalid = ucol.nendoroidid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

  public function getByInternalid($nendoroid_internalid, $userid=null) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT nendoroidid, additiondate, quantity
                  FROM users_nendoroids_collection
                  WHERE userid = :userid
                  ) AS ucol ON n.internalid = ucol.nendoroidid
            WHERE n.internalid = :nendoroid_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["nendoroid_internalid" => $nendoroid_internalid, "userid" => $userid]);

    if($row = $stmt->fetch()) {
      return new NendoroidEntity($row);
    }
  }

  public function getByBoxid($boxid, $userid=null) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT nendoroidid, additiondate, quantity
                  FROM users_nendoroids_collection
                  WHERE userid = :userid
                  ) AS ucol ON n.internalid = ucol.nendoroidid
            WHERE n.boxid = :boxid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["boxid" => $boxid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

  public function getByNendoroidid($nendoroidid, $userid=null) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT nendoroidid, additiondate, quantity
                  FROM users_nendoroids_collection
                  WHERE userid = :userid
                  ) AS ucol ON n.internalid = ucol.nendoroidid
            WHERE n.internalid = :nendoroidid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["nendoroidid" => $nendoroidid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

  public function getByAccessoryid($accessoryid, $userid=null) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN accessories a ON n.internalid = a.nendoroidid
            LEFT JOIN (
                  SELECT nendoroidid, additiondate, quantity
                  FROM users_nendoroids_collection
                  WHERE userid = :userid
                  ) AS ucol ON n.internalid = ucol.nendoroidid
            WHERE a.internalid = :accessoryid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["accessoryid" => $accessoryid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

  public function getByBodypartid($bodypartid, $userid=null) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN bodyparts bp ON n.internalid = bp.nendoroidid
            LEFT JOIN (
                  SELECT nendoroidid, additiondate, quantity
                  FROM users_nendoroids_collection
                  WHERE userid = :userid
                  ) AS ucol ON n.internalid = ucol.nendoroidid
            WHERE bp.internalid = :bodypartid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["bodypartid" => $bodypartid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

  public function getByFaceid($faceid, $userid=null) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN faces f ON n.internalid = f.nendoroidid
            LEFT JOIN (
                  SELECT nendoroidid, additiondate, quantity
                  FROM users_nendoroids_collection
                  WHERE userid = :userid
                  ) AS ucol ON n.internalid = ucol.nendoroidid
            WHERE f.internalid = :faceid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["faceid" => $faceid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

  public function getByHairid($hairid, $userid=null) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN hairs h ON n.internalid = h.nendoroidid
            LEFT JOIN (
                  SELECT nendoroidid, additiondate, quantity
                  FROM users_nendoroids_collection
                  WHERE userid = :userid
                  ) AS ucol ON n.internalid = ucol.nendoroidid
            WHERE h.internalid = :hairid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["hairid" => $hairid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

  public function getByHandid($handid, $userid=null) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN hands h ON n.internalid = h.nendoroidid
            LEFT JOIN (
                  SELECT nendoroidid, additiondate, quantity
                  FROM users_nendoroids_collection
                  WHERE userid = :userid
                  ) AS ucol ON n.internalid = ucol.nendoroidid
            WHERE h.internalid = :handid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["handid" => $handid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

  public function getByPhotoid($photoid, $userid=null) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate,
                  pn.xmin, pn.xmax, pn.ymin, pn.ymax, pn.internalid AS photoannotationid,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN photos_nendoroids pn ON n.internalid = pn.nendoroidid
            LEFT JOIN (
                  SELECT nendoroidid, additiondate, quantity
                  FROM users_nendoroids_collection
                  WHERE userid = :userid
                  ) AS ucol ON n.internalid = ucol.nendoroidid
            WHERE pn.photoid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

}
