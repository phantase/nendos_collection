<?php

class BodypartMapper extends Mapper
{
  protected $tablename = "bodyparts";
  protected $collectiontablename = "users_bodyparts_collection";
  protected $favoritestablename = "users_bodyparts_favorites";
  protected $othertablecolumn = "bodypartid";

  public function get($userid=null, $validated=true) {
    $sql = "SELECT bp.internalid, bp.boxid, bp.nendoroidid, bp.part, bp.main_color, bp.other_color, bp.description,
                  bp.creatorid, uc.username AS creatorname, bp.creationdate,
                  bp.editorid, ue.username AS editorname, bp.editiondate,
                  bp.validatorid, uv.username AS validatorname, bp.validationdate, bp.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM bodyparts bp
            LEFT JOIN users uc ON bp.creatorid = uc.internalid
            LEFT JOIN users ue ON bp.editorid = ue.internalid
            LEFT JOIN users uv ON bp.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT bodypartid, additiondate, quantity
                  FROM users_bodyparts_collection
                  WHERE userid = :userid
                  ) AS ucol ON bp.internalid = ucol.bodypartid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, bodypartid
                  FROM users_bodyparts_favorites
                  GROUP BY bodypartid
                  ) AS faved ON bp.internalid = faved.bodypartid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, bodypartid
                  FROM users_bodyparts_favorites
                  WHERE userid = :userid
                  GROUP BY bodypartid
                  ) AS userfav ON bp.internalid = userfav.bodypartid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, bodypartid
                  FROM tags_bodyparts AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY bodypartid
                  ) AS tags ON bp.internalid = tags.bodypartid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, bodypartid
                  FROM users_bodyparts_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY bodypartid
                  ) AS favusers ON bp.internalid = favusers.bodypartid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, bodypartid
                  FROM users_bodyparts_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY bodypartid
                  ) AS colusers ON bp.internalid = colusers.bodypartid";
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
                  bp.validatorid, uv.username AS validatorname, bp.validationdate, bp.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM bodyparts bp
            LEFT JOIN users uc ON bp.creatorid = uc.internalid
            LEFT JOIN users ue ON bp.editorid = ue.internalid
            LEFT JOIN users uv ON bp.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT bodypartid, additiondate, quantity
                  FROM users_bodyparts_collection
                  WHERE userid = :userid
                  ) AS ucol ON bp.internalid = ucol.bodypartid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, bodypartid
                  FROM users_bodyparts_favorites
                  GROUP BY bodypartid
                  ) AS faved ON bp.internalid = faved.bodypartid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, bodypartid
                  FROM users_bodyparts_favorites
                  WHERE userid = :userid
                  GROUP BY bodypartid
                  ) AS userfav ON bp.internalid = userfav.bodypartid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, bodypartid
                  FROM tags_bodyparts AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY bodypartid
                  ) AS tags ON bp.internalid = tags.bodypartid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, bodypartid
                  FROM users_bodyparts_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY bodypartid
                  ) AS favusers ON bp.internalid = favusers.bodypartid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, bodypartid
                  FROM users_bodyparts_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY bodypartid
                  ) AS colusers ON bp.internalid = colusers.bodypartid
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
                  bp.validatorid, uv.username AS validatorname, bp.validationdate, bp.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM bodyparts bp
            LEFT JOIN users uc ON bp.creatorid = uc.internalid
            LEFT JOIN users ue ON bp.editorid = ue.internalid
            LEFT JOIN users uv ON bp.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT bodypartid, additiondate, quantity
                  FROM users_bodyparts_collection
                  WHERE userid = :userid
                  ) AS ucol ON bp.internalid = ucol.bodypartid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, bodypartid
                  FROM users_bodyparts_favorites
                  GROUP BY bodypartid
                  ) AS faved ON bp.internalid = faved.bodypartid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, bodypartid
                  FROM users_bodyparts_favorites
                  WHERE userid = :userid
                  GROUP BY bodypartid
                  ) AS userfav ON bp.internalid = userfav.bodypartid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, bodypartid
                  FROM tags_bodyparts AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY bodypartid
                  ) AS tags ON bp.internalid = tags.bodypartid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, bodypartid
                  FROM users_bodyparts_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY bodypartid
                  ) AS favusers ON bp.internalid = favusers.bodypartid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, bodypartid
                  FROM users_bodyparts_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY bodypartid
                  ) AS colusers ON bp.internalid = colusers.bodypartid
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
                  bp.validatorid, uv.username AS validatorname, bp.validationdate, bp.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM bodyparts bp
            LEFT JOIN users uc ON bp.creatorid = uc.internalid
            LEFT JOIN users ue ON bp.editorid = ue.internalid
            LEFT JOIN users uv ON bp.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT bodypartid, additiondate, quantity
                  FROM users_bodyparts_collection
                  WHERE userid = :userid
                  ) AS ucol ON bp.internalid = ucol.bodypartid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, bodypartid
                  FROM users_bodyparts_favorites
                  GROUP BY bodypartid
                  ) AS faved ON bp.internalid = faved.bodypartid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, bodypartid
                  FROM users_bodyparts_favorites
                  WHERE userid = :userid
                  GROUP BY bodypartid
                  ) AS userfav ON bp.internalid = userfav.bodypartid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, bodypartid
                  FROM tags_bodyparts AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY bodypartid
                  ) AS tags ON bp.internalid = tags.bodypartid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, bodypartid
                  FROM users_bodyparts_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY bodypartid
                  ) AS favusers ON bp.internalid = favusers.bodypartid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, bodypartid
                  FROM users_bodyparts_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY bodypartid
                  ) AS colusers ON bp.internalid = colusers.bodypartid
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
                  bp.validatorid, uv.username AS validatorname, bp.validationdate, bp.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM bodyparts bp
            LEFT JOIN users uc ON bp.creatorid = uc.internalid
            LEFT JOIN users ue ON bp.editorid = ue.internalid
            LEFT JOIN users uv ON bp.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT bodypartid, additiondate, quantity
                  FROM users_bodyparts_collection
                  WHERE userid = :userid
                  ) AS ucol ON bp.internalid = ucol.bodypartid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, bodypartid
                  FROM users_bodyparts_favorites
                  GROUP BY bodypartid
                  ) AS faved ON bp.internalid = faved.bodypartid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, bodypartid
                  FROM users_bodyparts_favorites
                  WHERE userid = :userid
                  GROUP BY bodypartid
                  ) AS userfav ON bp.internalid = userfav.bodypartid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, bodypartid
                  FROM tags_bodyparts AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY bodypartid
                  ) AS tags ON bp.internalid = tags.bodypartid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, bodypartid
                  FROM users_bodyparts_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY bodypartid
                  ) AS favusers ON bp.internalid = favusers.bodypartid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, bodypartid
                  FROM users_bodyparts_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY bodypartid
                  ) AS colusers ON bp.internalid = colusers.bodypartid
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
                  bp.validatorid, uv.username AS validatorname, bp.validationdate, bp.haspicture,
                  pb.xmin, pb.xmax, pb.ymin, pb.ymax, pb.internalid AS photoannotationid,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
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
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, bodypartid
                  FROM users_bodyparts_favorites
                  GROUP BY bodypartid
                  ) AS faved ON bp.internalid = faved.bodypartid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, bodypartid
                  FROM users_bodyparts_favorites
                  WHERE userid = :userid
                  GROUP BY bodypartid
                  ) AS userfav ON bp.internalid = userfav.bodypartid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, bodypartid
                  FROM tags_bodyparts AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY bodypartid
                  ) AS tags ON bp.internalid = tags.bodypartid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, bodypartid
                  FROM users_bodyparts_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY bodypartid
                  ) AS favusers ON bp.internalid = favusers.bodypartid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, bodypartid
                  FROM users_bodyparts_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY bodypartid
                  ) AS colusers ON bp.internalid = colusers.bodypartid
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
    return $this->getByInternalid($bodypart->getInternalId(), $userid);
  }

  public function addPicture($bodypart_internalid, $userid) {
    $sql = "UPDATE bodyparts SET
              haspicture = 1
            WHERE internalid = :internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "internalid" => $bodypart_internalid
      ]);
    if(!$result) {
      throw new Exception("Could not update bodypart");
    }
    $this->addHistory($userid, $bodypart_internalid, "Update", "Picture has been updated");
  }
}
