<?php

class BodypartMapper extends Mapper
{
  protected $tablename = "bodyparts";
  protected $collectiontablename = "users_bodyparts_collection";
  protected $collectioncolumn = "bodypartid";

  public function get($userid=null, $validated=true) {
    $sql = "SELECT bp.internalid, bp.boxid, bp.nendoroidid, bp.part, bp.main_color, bp.other_color, bp.description,
                  bp.creatorid, uc.username AS creatorname, bp.creationdate,
                  bp.editorid, ue.username AS editorname, bp.editiondate,
                  bp.validatorid, uv.username AS validatorname, bp.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM bodyparts bp
            LEFT JOIN users uc ON bp.creatorid = uc.internalid
            LEFT JOIN users ue ON bp.editorid = ue.internalid
            LEFT JOIN users uv ON bp.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT bodypartid, additiondate, quantity
                  FROM users_bodyparts_collection
                  WHERE userid = :userid
                  ) AS ucol ON bp.internalid = ucol.bodypartid";
    if ($validated) {
      $sql .= " WHERE bp.validatorid IS NOT NULL";
    }
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BodypartEntity($row);
    }
    return $results;
  }

  public function getByInternalid($bodypart_internalid, $userid=null) {
    $sql = "SELECT bp.internalid, bp.boxid, bp.nendoroidid, bp.part, bp.main_color, bp.other_color, bp.description,
                  bp.creatorid, uc.username AS creatorname, bp.creationdate,
                  bp.editorid, ue.username AS editorname, bp.editiondate,
                  bp.validatorid, uv.username AS validatorname, bp.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM bodyparts bp
            LEFT JOIN users uc ON bp.creatorid = uc.internalid
            LEFT JOIN users ue ON bp.editorid = ue.internalid
            LEFT JOIN users uv ON bp.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT bodypartid, additiondate, quantity
                  FROM users_bodyparts_collection
                  WHERE userid = :userid
                  ) AS ucol ON bp.internalid = ucol.bodypartid
            WHERE bp.internalid = :bodypart_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["bodypart_internalid" => $bodypart_internalid, "userid" => $userid]);

    if($row = $stmt->fetch()) {
      return new BodypartEntity($row);
    }
  }

  public function getByBoxid($boxid, $userid=null) {
    $sql = "SELECT bp.internalid, bp.boxid, bp.nendoroidid, bp.part, bp.main_color, bp.other_color, bp.description,
                  bp.creatorid, uc.username AS creatorname, bp.creationdate,
                  bp.editorid, ue.username AS editorname, bp.editiondate,
                  bp.validatorid, uv.username AS validatorname, bp.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM bodyparts bp
            LEFT JOIN users uc ON bp.creatorid = uc.internalid
            LEFT JOIN users ue ON bp.editorid = ue.internalid
            LEFT JOIN users uv ON bp.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT bodypartid, additiondate, quantity
                  FROM users_bodyparts_collection
                  WHERE userid = :userid
                  ) AS ucol ON bp.internalid = ucol.bodypartid
            WHERE bp.boxid = :boxid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["boxid" => $boxid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BodypartEntity($row);
    }
    return $results;
  }

  public function getByNendoroidid($nendoroidid, $userid=null) {
    $sql = "SELECT bp.internalid, bp.boxid, bp.nendoroidid, bp.part, bp.main_color, bp.other_color, bp.description,
                  bp.creatorid, uc.username AS creatorname, bp.creationdate,
                  bp.editorid, ue.username AS editorname, bp.editiondate,
                  bp.validatorid, uv.username AS validatorname, bp.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM bodyparts bp
            LEFT JOIN users uc ON bp.creatorid = uc.internalid
            LEFT JOIN users ue ON bp.editorid = ue.internalid
            LEFT JOIN users uv ON bp.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT bodypartid, additiondate, quantity
                  FROM users_bodyparts_collection
                  WHERE userid = :userid
                  ) AS ucol ON bp.internalid = ucol.bodypartid
            WHERE bp.nendoroidid = :nendoroidid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["nendoroidid" => $nendoroidid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BodypartEntity($row);
    }
    return $results;
  }

  public function getByBodypartid($bodypartid, $userid=null) {
    $sql = "SELECT bp.internalid, bp.boxid, bp.nendoroidid, bp.part, bp.main_color, bp.other_color, bp.description,
                  bp.creatorid, uc.username AS creatorname, bp.creationdate,
                  bp.editorid, ue.username AS editorname, bp.editiondate,
                  bp.validatorid, uv.username AS validatorname, bp.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM bodyparts bp
            LEFT JOIN users uc ON bp.creatorid = uc.internalid
            LEFT JOIN users ue ON bp.editorid = ue.internalid
            LEFT JOIN users uv ON bp.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT bodypartid, additiondate, quantity
                  FROM users_bodyparts_collection
                  WHERE userid = :userid
                  ) AS ucol ON bp.internalid = ucol.bodypartid
            WHERE bp.internalid = :bodypartid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["bodypartid" => $bodypartid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BodypartEntity($row);
    }
    return $results;
  }

  public function getByPhotoid($photoid, $userid=null) {
    $sql = "SELECT bp.internalid, bp.boxid, bp.nendoroidid, bp.part, bp.main_color, bp.other_color, bp.description,
                  bp.creatorid, uc.username AS creatorname, bp.creationdate,
                  bp.editorid, ue.username AS editorname, bp.editiondate,
                  bp.validatorid, uv.username AS validatorname, bp.validationdate,
                  pb.xmin, pb.xmax, pb.ymin, pb.ymax, pb.internalid AS photoannotationid,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM bodyparts bp
            LEFT JOIN users uc ON bp.creatorid = uc.internalid
            LEFT JOIN users ue ON bp.editorid = ue.internalid
            LEFT JOIN users uv ON bp.validatorid = uv.internalid
            LEFT JOIN photos_bodyparts pb ON bp.internalid = pb.bodypartid
            LEFT JOIN (
                  SELECT bodypartid, additiondate, quantity
                  FROM users_bodyparts_collection
                  WHERE userid = :userid
                  ) AS ucol ON bp.internalid = ucol.bodypartid
            WHERE pb.photoid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BodypartEntity($row);
    }
    return $results;
  }

  public function addHistory($userid, $elementid, $action, $detail="", $photoid=null) {
    $element = $this->getByInternalid($elementid);

    $mapper = new HistoryMapper($this->db);
    $mapper->addElementHistory($userid, $element->getBoxId(), $element->getNendoroidId(),
                               null, $elementid,
                               null, null, null,
                               $photoid, $action, $detail);
    return null;
  }

  public function getHistory($elementid) {
    $mapper = new HistoryMapper($this->db);
    return $mapper->getByElementid($elementid, "bodypartid");
  }

  public function create(BodypartEntity $bodypart, $userid) {
    $sql = "INSERT INTO bodyparts
              (boxid, nendoroidid, part, main_color, other_color, description, creatorid, creationdate, editorid, editiondate) VALUES
              (:boxid, :nendoroidid, :part, :main_color, :other_color, :description, :userid, NOW(), :userid, NOW())";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "boxid" => $bodypart->getBoxId(),
        "nendoroidid" => $bodypart->getNendoroidId(),
        "part" => $bodypart->getPart(),
        "main_color" => $bodypart->getMainColor(),
        "other_color" => $bodypart->getOtherColor(),
        "description" => $bodypart->getDescription(),
        "userid" => $userid
      ]);
    if(!$result) {
      throw new Exception("Could not save bodypart");
    }
    $bodypartid = $this->db->lastInsertId();
    $this->addHistory($userid,$bodypartid,"Creation");
    return $this->getByInternalid($bodypartid);
  }

  public function update(BodypartEntity $bodypart, $userid) {
    $sql = "UPDATE bodyparts SET
              boxid = :boxid,
              nendoroidid = :nendoroidid,
              part = :part,
              main_color = :main_color,
              other_color = :other_color,
              description = :description,
              editorid = :userid,
              editiondate = NOW(),
              validatorid = null,
              validationdate = null
            WHERE internalid = :internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "internalid" => $bodypart->getInternalId(),
        "boxid" => $bodypart->getBoxId(),
        "nendoroidid" => $bodypart->getNendoroidId(),
        "part" => $bodypart->getPart(),
        "main_color" => $bodypart->getMainColor(),
        "other_color" => $bodypart->getOtherColor(),
        "description" => $bodypart->getDescription(),
        "userid" => $userid
      ]);
    if(!$result) {
      throw new Exception("Could not update bodypart");
    }
    $this->addHistory($userid,$bodypart->getInternalId(),"Update");
    return $this->getByInternalid($bodypart->getInternalId());
  }
}