<?php

class HandMapper extends Mapper
{
  protected $tablename = "hands";
  protected $collectiontablename = "users_hands_collection";
  protected $favoritestablename = "users_hands_favorites";
  protected $othertablecolumn = "handid";

  public function get($userid=null, $validated=true) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.skin_color, h.leftright, h.posture, h.description,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate, h.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM hands h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT handid, additiondate, quantity
                  FROM users_hands_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.handid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, handid
                  FROM users_hands_favorites
                  GROUP BY handid
                  ) AS faved ON h.internalid = faved.handid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, handid
                  FROM users_hands_favorites
                  WHERE userid = :userid
                  GROUP BY handid
                  ) AS userfav ON h.internalid = userfav.handid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, handid
                  FROM tags_hands AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY handid
                  ) AS tags ON h.internalid = tags.handid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, handid
                  FROM users_hands_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY handid
                  ) AS favusers ON h.internalid = favusers.handid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, handid
                  FROM users_hands_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY handid
                  ) AS colusers ON h.internalid = colusers.handid";
    if ($validated) {
      $sql .= " WHERE h.validatorid IS NOT NULL";
    }
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
                  h.validatorid, uv.username AS validatorname, h.validationdate, h.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM hands h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT handid, additiondate, quantity
                  FROM users_hands_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.handid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, handid
                  FROM users_hands_favorites
                  GROUP BY handid
                  ) AS faved ON h.internalid = faved.handid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, handid
                  FROM users_hands_favorites
                  WHERE userid = :userid
                  GROUP BY handid
                  ) AS userfav ON h.internalid = userfav.handid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, handid
                  FROM tags_hands AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY handid
                  ) AS tags ON h.internalid = tags.handid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, handid
                  FROM users_hands_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY handid
                  ) AS favusers ON h.internalid = favusers.handid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, handid
                  FROM users_hands_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY handid
                  ) AS colusers ON h.internalid = colusers.handid
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
                  h.validatorid, uv.username AS validatorname, h.validationdate, h.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM hands h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT handid, additiondate, quantity
                  FROM users_hands_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.handid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, handid
                  FROM users_hands_favorites
                  GROUP BY handid
                  ) AS faved ON h.internalid = faved.handid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, handid
                  FROM users_hands_favorites
                  WHERE userid = :userid
                  GROUP BY handid
                  ) AS userfav ON h.internalid = userfav.handid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, handid
                  FROM tags_hands AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY handid
                  ) AS tags ON h.internalid = tags.handid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, handid
                  FROM users_hands_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY handid
                  ) AS favusers ON h.internalid = favusers.handid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, handid
                  FROM users_hands_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY handid
                  ) AS colusers ON h.internalid = colusers.handid
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
                  h.validatorid, uv.username AS validatorname, h.validationdate, h.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM hands h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT handid, additiondate, quantity
                  FROM users_hands_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.handid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, handid
                  FROM users_hands_favorites
                  GROUP BY handid
                  ) AS faved ON h.internalid = faved.handid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, handid
                  FROM users_hands_favorites
                  WHERE userid = :userid
                  GROUP BY handid
                  ) AS userfav ON h.internalid = userfav.handid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, handid
                  FROM tags_hands AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY handid
                  ) AS tags ON h.internalid = tags.handid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, handid
                  FROM users_hands_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY handid
                  ) AS favusers ON h.internalid = favusers.handid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, handid
                  FROM users_hands_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY handid
                  ) AS colusers ON h.internalid = colusers.handid
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
                  h.validatorid, uv.username AS validatorname, h.validationdate, h.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM hands h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT handid, additiondate, quantity
                  FROM users_hands_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.handid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, handid
                  FROM users_hands_favorites
                  GROUP BY handid
                  ) AS faved ON h.internalid = faved.handid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, handid
                  FROM users_hands_favorites
                  WHERE userid = :userid
                  GROUP BY handid
                  ) AS userfav ON h.internalid = userfav.handid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, handid
                  FROM tags_hands AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY handid
                  ) AS tags ON h.internalid = tags.handid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, handid
                  FROM users_hands_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY handid
                  ) AS favusers ON h.internalid = favusers.handid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, handid
                  FROM users_hands_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY handid
                  ) AS colusers ON h.internalid = colusers.handid
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
                  h.validatorid, uv.username AS validatorname, h.validationdate, h.haspicture,
                  ph.xmin, ph.xmax, ph.ymin, ph.ymax, ph.internalid AS photoannotationid,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
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
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, handid
                  FROM users_hands_favorites
                  GROUP BY handid
                  ) AS faved ON h.internalid = faved.handid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, handid
                  FROM users_hands_favorites
                  WHERE userid = :userid
                  GROUP BY handid
                  ) AS userfav ON h.internalid = userfav.handid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, handid
                  FROM tags_hands AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY handid
                  ) AS tags ON h.internalid = tags.handid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, handid
                  FROM users_hands_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY handid
                  ) AS favusers ON h.internalid = favusers.handid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, handid
                  FROM users_hands_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY handid
                  ) AS colusers ON h.internalid = colusers.handid
            WHERE ph.photoid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HandEntity($row);
    }
    return $results;
  }

  public function addHistory($userid, $elementid, $action, $detail="", $photoid=null) {
    $element = $this->getByInternalid($elementid);

    $mapper = new HistoryMapper($this->db);
    $mapper->addElementHistory($userid, $element->getBoxId(), $element->getNendoroidId(),
                               null, null,
                               null, null, $elementid,
                               $photoid, $action, $detail);
    return null;
  }

  public function getHistory($elementid) {
    $mapper = new HistoryMapper($this->db);
    return $mapper->getByElementid($elementid, "handid");
  }

  public function create(HandEntity $hand, $userid) {
    $sql = "INSERT INTO hands
              (boxid, nendoroidid, skin_color, leftright, posture, description, creatorid, creationdate, editorid, editiondate) VALUES
              (:boxid, :nendoroidid, :skin_color, :leftright, :posture, :description, :userid, NOW(), :userid, NOW())";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "boxid" => $hand->getBoxId(),
        "nendoroidid" => $hand->getNendoroidId(),
        "skin_color" => $hand->getSkinColor(),
        "leftright" => $hand->getLeftRight(),
        "posture" => $hand->getPosture(),
        "description" => $hand->getDescription(),
        "userid" => $userid
      ]);
    if(!$result) {
      throw new Exception("Could not save hand");
    }
    $handid = $this->db->lastInsertId();
    $this->addHistory($userid,$handid,"Creation");
    return $this->getByInternalid($handid);
  }

  public function update(HandEntity $hand, $userid) {
    $sql = "UPDATE hands SET
              boxid = :boxid,
              nendoroidid = :nendoroidid,
              skin_color = :skin_color,
              leftright = :leftright,
              posture = :posture,
              description = :description,
              editorid = :userid,
              editiondate = NOW(),
              validatorid = null,
              validationdate = null
            WHERE internalid = :internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "internalid" => $hand->getInternalId(),
        "boxid" => $hand->getBoxId(),
        "nendoroidid" => $hand->getNendoroidId(),
        "skin_color" => $hand->getSkinColor(),
        "leftright" => $hand->getLeftRight(),
        "posture" => $hand->getPosture(),
        "description" => $hand->getDescription(),
        "userid" => $userid
      ]);
    if(!$result) {
      throw new Exception("Could not save hand");
    }
    $this->addHistory($userid,$hand->getInternalId(),"Update");
    return $this->getByInternalid($hand->getInternalId(), $userid);
  }

  public function addPicture($hand_internalid, $userid) {
    $sql = "UPDATE hands SET
              haspicture = 1
            WHERE internalid = :internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "internalid" => $hand_internalid
      ]);
    if(!$result) {
      throw new Exception("Could not update hand");
    }
    $this->addHistory($userid, $hand_internalid, "Update", "Picture has been updated");
  }
}
