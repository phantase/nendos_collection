<?php

class BoxMapper extends Mapper
{
  protected $tablename = "boxes";
  protected $collectiontablename = "users_boxes_collection";
  protected $collectioncolumn = "boxid";

  public function get($userid=null) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT boxid, additiondate, quantity
                  FROM users_boxes_collection
                  WHERE userid = :userid
                  ) AS ucol ON b.internalid = ucol.boxid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

  public function getByInternalid($box_internalid, $userid=null) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT boxid, additiondate, quantity
                  FROM users_boxes_collection
                  WHERE userid = :userid
                  ) AS ucol ON b.internalid = ucol.boxid
            WHERE b.internalid = :box_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["box_internalid" => $box_internalid, "userid" => $userid]);

    if($row = $stmt->fetch()) {
      return new BoxEntity($row);
    }
  }

  public function getByBoxid($boxid, $userid=null) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT boxid, additiondate, quantity
                  FROM users_boxes_collection
                  WHERE userid = :userid
                  ) AS ucol ON b.internalid = ucol.boxid
            WHERE b.internalid = :boxid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["boxid" => $boxid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

  public function getByNendoroidid($nendoroidid, $userid=null) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            LEFT JOIN nendoroids n ON b.internalid = n.boxid
            LEFT JOIN (
                  SELECT boxid, additiondate, quantity
                  FROM users_boxes_collection
                  WHERE userid = :userid
                  ) AS ucol ON b.internalid = ucol.boxid
            WHERE n.internalid = :nendoroidid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["nendoroidid" => $nendoroidid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

  public function getByAccessoryid($accessoryid, $userid=null) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            LEFT JOIN accessories a ON b.internalid = a.boxid
            LEFT JOIN (
                  SELECT boxid, additiondate, quantity
                  FROM users_boxes_collection
                  WHERE userid = :userid
                  ) AS ucol ON b.internalid = ucol.boxid
            WHERE a.internalid = :accessoryid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["accessoryid" => $accessoryid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

  public function getByBodypartid($bodypartid, $userid=null) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            LEFT JOIN bodyparts bp ON b.internalid = bp.boxid
            LEFT JOIN (
                  SELECT boxid, additiondate, quantity
                  FROM users_boxes_collection
                  WHERE userid = :userid
                  ) AS ucol ON b.internalid = ucol.boxid
            WHERE bp.internalid = :bodypartid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["bodypartid" => $bodypartid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

  public function getByFaceid($faceid, $userid=null) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            LEFT JOIN faces f ON b.internalid = f.boxid
            LEFT JOIN (
                  SELECT boxid, additiondate, quantity
                  FROM users_boxes_collection
                  WHERE userid = :userid
                  ) AS ucol ON b.internalid = ucol.boxid
            WHERE f.internalid = :faceid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["faceid" => $faceid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

  public function getByHairid($hairid, $userid=null) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            LEFT JOIN hairs h ON b.internalid = h.boxid
            LEFT JOIN (
                  SELECT boxid, additiondate, quantity
                  FROM users_boxes_collection
                  WHERE userid = :userid
                  ) AS ucol ON b.internalid = ucol.boxid
            WHERE h.internalid = :hairid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["hairid" => $hairid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

  public function getByHandid($handid, $userid=null) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            LEFT JOIN hands h ON b.internalid = h.boxid
            LEFT JOIN (
                  SELECT boxid, additiondate, quantity
                  FROM users_boxes_collection
                  WHERE userid = :userid
                  ) AS ucol ON b.internalid = ucol.boxid
            WHERE h.internalid = :handid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["handid" => $handid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

  public function getByPhotoid($photoid, $userid=null) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity,
                  pb.xmin, pb.xmax, pb.ymin, pb.ymax, pb.internalid AS photoannotationid
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            LEFT JOIN photos_boxes pb ON b.internalid = pb.boxid
            LEFT JOIN (
                  SELECT boxid, additiondate, quantity
                  FROM users_boxes_collection
                  WHERE userid = :userid
                  ) AS ucol ON b.internalid = ucol.boxid
            WHERE pb.photoid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

  public function addHistory($userid, $elementid, $action, $detail="", $photoid=null) {
    $mapper = new HistoryMapper($this->db);
    $mapper->addElementHistory($userid, $elementid, null,
                               null, null,
                               null, null, null,
                               $photoid, $action, $detail);
    return null;
  }
}
