<?php

class AccessoryMapper extends Mapper
{
  protected $tablename = "accessories";

  public function get($userid=null) {
    $sql = "SELECT a.internalid, a.boxid, a.nendoroidid, a.type, a.main_color, a.other_color, a.description,
                  a.creatorid, uc.username AS creatorname, a.creationdate,
                  a.editorid, ue.username AS editorname, a.editiondate,
                  a.validatorid, uv.username AS validatorname, a.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM accessories a
            LEFT JOIN users uc ON a.creatorid = uc.internalid
            LEFT JOIN users ue ON a.editorid = ue.internalid
            LEFT JOIN users uv ON a.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT accessoryid, additiondate, quantity
                  FROM users_accessories_collection
                  WHERE userid = :userid
                  ) AS ucol ON a.internalid = ucol.accessoryid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new AccessoryEntity($row);
    }
    return $results;
  }

  public function getByInternalid($accessory_internalid, $userid=null) {
    $sql = "SELECT a.internalid, a.boxid, a.nendoroidid, a.type, a.main_color, a.other_color, a.description,
                  a.creatorid, uc.username AS creatorname, a.creationdate,
                  a.editorid, ue.username AS editorname, a.editiondate,
                  a.validatorid, uv.username AS validatorname, a.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM accessories a
            LEFT JOIN users uc ON a.creatorid = uc.internalid
            LEFT JOIN users ue ON a.editorid = ue.internalid
            LEFT JOIN users uv ON a.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT accessoryid, additiondate, quantity
                  FROM users_accessories_collection
                  WHERE userid = :userid
                  ) AS ucol ON a.internalid = ucol.accessoryid
            WHERE a.internalid = :accessory_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["accessory_internalid" => $accessory_internalid, "userid" => $userid]);

    if($row = $stmt->fetch()) {
      return new AccessoryEntity($row);
    }
  }

  public function getByBoxid($boxid, $userid=null) {
    $sql = "SELECT a.internalid, a.boxid, a.nendoroidid, a.type, a.main_color, a.other_color, a.description,
                  a.creatorid, uc.username AS creatorname, a.creationdate,
                  a.editorid, ue.username AS editorname, a.editiondate,
                  a.validatorid, uv.username AS validatorname, a.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM accessories a
            LEFT JOIN users uc ON a.creatorid = uc.internalid
            LEFT JOIN users ue ON a.editorid = ue.internalid
            LEFT JOIN users uv ON a.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT accessoryid, additiondate, quantity
                  FROM users_accessories_collection
                  WHERE userid = :userid
                  ) AS ucol ON a.internalid = ucol.accessoryid
            WHERE a.boxid = :boxid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["boxid" => $boxid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new AccessoryEntity($row);
    }
    return $results;
  }

  public function getByNendoroidid($nendoroidid, $userid=null) {
    $sql = "SELECT a.internalid, a.boxid, a.nendoroidid, a.type, a.main_color, a.other_color, a.description,
                  a.creatorid, uc.username AS creatorname, a.creationdate,
                  a.editorid, ue.username AS editorname, a.editiondate,
                  a.validatorid, uv.username AS validatorname, a.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM accessories a
            LEFT JOIN users uc ON a.creatorid = uc.internalid
            LEFT JOIN users ue ON a.editorid = ue.internalid
            LEFT JOIN users uv ON a.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT accessoryid, additiondate, quantity
                  FROM users_accessories_collection
                  WHERE userid = :userid
                  ) AS ucol ON a.internalid = ucol.accessoryid
            WHERE a.nendoroidid = :nendoroidid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["nendoroidid" => $nendoroidid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new AccessoryEntity($row);
    }
    return $results;
  }

  public function getByAccessoryid($accessoryid, $userid=null) {
    $sql = "SELECT a.internalid, a.boxid, a.nendoroidid, a.type, a.main_color, a.other_color, a.description,
                  a.creatorid, uc.username AS creatorname, a.creationdate,
                  a.editorid, ue.username AS editorname, a.editiondate,
                  a.validatorid, uv.username AS validatorname, a.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM accessories a
            LEFT JOIN users uc ON a.creatorid = uc.internalid
            LEFT JOIN users ue ON a.editorid = ue.internalid
            LEFT JOIN users uv ON a.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT accessoryid, additiondate, quantity
                  FROM users_accessories_collection
                  WHERE userid = :userid
                  ) AS ucol ON a.internalid = ucol.accessoryid
            WHERE a.internalid = :accessoryid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["accessoryid" => $accessoryid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new AccessoryEntity($row);
    }
    return $results;
  }

  public function getByPhotoid($photoid, $userid=null) {
    $sql = "SELECT a.internalid, a.boxid, a.nendoroidid, a.type, a.main_color, a.other_color, a.description,
                  a.creatorid, uc.username AS creatorname, a.creationdate,
                  a.editorid, ue.username AS editorname, a.editiondate,
                  a.validatorid, uv.username AS validatorname, a.validationdate,
                  pa.xmin, pa.xmax, pa.ymin, pa.ymax, pa.internalid AS photoannotationid,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM accessories a
            LEFT JOIN users uc ON a.creatorid = uc.internalid
            LEFT JOIN users ue ON a.editorid = ue.internalid
            LEFT JOIN users uv ON a.validatorid = uv.internalid
            LEFT JOIN photos_accessories pa ON a.internalid = pa.accessoryid
            LEFT JOIN (
                  SELECT accessoryid, additiondate, quantity
                  FROM users_accessories_collection
                  WHERE userid = :userid
                  ) AS ucol ON a.internalid = ucol.accessoryid
            WHERE pa.photoid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new AccessoryEntity($row);
    }
    return $results;
  }

}
