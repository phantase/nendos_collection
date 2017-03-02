<?php

class BodypartMapper extends Mapper
{
  protected $tablename = "bodyparts";
  protected $collectiontablename = "users_bodyparts_collection";
  protected $collectioncolumn = "bodypartid";

  public function get($userid=null) {
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

}
