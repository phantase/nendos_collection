<?php

class HandMapper extends Mapper
{
  protected $tablename = "hands";

  public function get($userid=null) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.skin_color, h.leftright, h.posture, h.description,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM hands h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT handid, additiondate, quantity
                  FROM users_hands_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.handid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HandEntity($row);
    }
    return $results;
  }

  public function getByInternalid($hand_internalid, $userid=null) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.skin_color, h.leftright, h.posture, h.description,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM hands h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT handid, additiondate, quantity
                  FROM users_hands_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.handid
            WHERE h.internalid = :hand_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["hand_internalid" => $hand_internalid, "userid" => $userid]);

    if($row = $stmt->fetch()) {
      return new HandEntity($row);
    }
  }

  public function getByBoxid($boxid, $userid=null) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.skin_color, h.leftright, h.posture, h.description,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM hands h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT handid, additiondate, quantity
                  FROM users_hands_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.handid
            WHERE h.boxid = :boxid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["boxid" => $boxid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HandEntity($row);
    }
    return $results;
  }

  public function getByNendoroidid($nendoroidid, $userid=null) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.skin_color, h.leftright, h.posture, h.description,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM hands h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT handid, additiondate, quantity
                  FROM users_hands_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.handid
            WHERE h.nendoroidid = :nendoroidid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["nendoroidid" => $nendoroidid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HandEntity($row);
    }
    return $results;
  }

  public function getByHandid($handid, $userid=null) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.skin_color, h.leftright, h.posture, h.description,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM hands h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT handid, additiondate, quantity
                  FROM users_hands_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.handid
            WHERE h.internalid = :handid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["handid" => $handid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HandEntity($row);
    }
    return $results;
  }

  public function getByPhotoid($photoid, $userid=null) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.skin_color, h.leftright, h.posture, h.description,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate,
                  ph.xmin, ph.xmax, ph.ymin, ph.ymax, ph.internalid AS photoannotationid,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM hands h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN photos_hands ph ON h.internalid = ph.handid
            LEFT JOIN (
                  SELECT handid, additiondate, quantity
                  FROM users_hands_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.handid
            WHERE ph.photoid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HandEntity($row);
    }
    return $results;
  }
}
