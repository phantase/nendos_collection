<?php

class AccessoryMapper extends Mapper
{
  protected $tablename = "accessories";
  protected $collectiontablename = "users_accessories_collection";
  protected $favoritestablename = "users_accessories_favorites";
  protected $tagstablename = "tags_accessories";
  protected $othertablecolumn = "accessoryid";

  public function get($userid=null, $validated=true) {
    $sql = "SELECT a.internalid, a.boxid, a.nendoroidid, a.type, a.main_color, a.other_color, a.description,
                  a.creatorid, uc.username AS creatorname, a.creationdate,
                  a.editorid, ue.username AS editorname, a.editiondate,
                  a.validatorid, uv.username AS validatorname, a.validationdate, a.nbpictures,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM accessories a
            LEFT JOIN users uc ON a.creatorid = uc.internalid
            LEFT JOIN users ue ON a.editorid = ue.internalid
            LEFT JOIN users uv ON a.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT accessoryid, additiondate, quantity
                  FROM users_accessories_collection
                  WHERE userid = :userid
                  ) AS ucol ON a.internalid = ucol.accessoryid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, accessoryid
                  FROM users_accessories_favorites
                  GROUP BY accessoryid
                  ) AS faved ON a.internalid = faved.accessoryid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, accessoryid
                  FROM users_accessories_favorites
                  WHERE userid = :userid
                  GROUP BY accessoryid
                  ) AS userfav ON a.internalid = userfav.accessoryid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, accessoryid
                  FROM tags_accessories AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY accessoryid
                  ) AS tags ON a.internalid = tags.accessoryid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, accessoryid
                  FROM users_accessories_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY accessoryid
                  ) AS favusers ON a.internalid = favusers.accessoryid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, accessoryid
                  FROM users_accessories_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY accessoryid
                  ) AS colusers ON a.internalid = colusers.accessoryid";
    if ($validated) {
      $sql .= " WHERE a.validatorid IS NOT NULL";
    }
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
                  a.validatorid, uv.username AS validatorname, a.validationdate, a.nbpictures,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM accessories a
            LEFT JOIN users uc ON a.creatorid = uc.internalid
            LEFT JOIN users ue ON a.editorid = ue.internalid
            LEFT JOIN users uv ON a.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT accessoryid, additiondate, quantity
                  FROM users_accessories_collection
                  WHERE userid = :userid
                  ) AS ucol ON a.internalid = ucol.accessoryid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, accessoryid
                  FROM users_accessories_favorites
                  GROUP BY accessoryid
                  ) AS faved ON a.internalid = faved.accessoryid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, accessoryid
                  FROM users_accessories_favorites
                  WHERE userid = :userid
                  GROUP BY accessoryid
                  ) AS userfav ON a.internalid = userfav.accessoryid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, accessoryid
                  FROM tags_accessories AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY accessoryid
                  ) AS tags ON a.internalid = tags.accessoryid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, accessoryid
                  FROM users_accessories_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY accessoryid
                  ) AS favusers ON a.internalid = favusers.accessoryid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, accessoryid
                  FROM users_accessories_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY accessoryid
                  ) AS colusers ON a.internalid = colusers.accessoryid
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
                  a.validatorid, uv.username AS validatorname, a.validationdate, a.nbpictures,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM accessories a
            LEFT JOIN users uc ON a.creatorid = uc.internalid
            LEFT JOIN users ue ON a.editorid = ue.internalid
            LEFT JOIN users uv ON a.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT accessoryid, additiondate, quantity
                  FROM users_accessories_collection
                  WHERE userid = :userid
                  ) AS ucol ON a.internalid = ucol.accessoryid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, accessoryid
                  FROM users_accessories_favorites
                  GROUP BY accessoryid
                  ) AS faved ON a.internalid = faved.accessoryid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, accessoryid
                  FROM users_accessories_favorites
                  WHERE userid = :userid
                  GROUP BY accessoryid
                  ) AS userfav ON a.internalid = userfav.accessoryid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, accessoryid
                  FROM tags_accessories AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY accessoryid
                  ) AS tags ON a.internalid = tags.accessoryid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, accessoryid
                  FROM users_accessories_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY accessoryid
                  ) AS favusers ON a.internalid = favusers.accessoryid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, accessoryid
                  FROM users_accessories_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY accessoryid
                  ) AS colusers ON a.internalid = colusers.accessoryid
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
                  a.validatorid, uv.username AS validatorname, a.validationdate, a.nbpictures,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM accessories a
            LEFT JOIN users uc ON a.creatorid = uc.internalid
            LEFT JOIN users ue ON a.editorid = ue.internalid
            LEFT JOIN users uv ON a.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT accessoryid, additiondate, quantity
                  FROM users_accessories_collection
                  WHERE userid = :userid
                  ) AS ucol ON a.internalid = ucol.accessoryid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, accessoryid
                  FROM users_accessories_favorites
                  GROUP BY accessoryid
                  ) AS faved ON a.internalid = faved.accessoryid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, accessoryid
                  FROM users_accessories_favorites
                  WHERE userid = :userid
                  GROUP BY accessoryid
                  ) AS userfav ON a.internalid = userfav.accessoryid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, accessoryid
                  FROM tags_accessories AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY accessoryid
                  ) AS tags ON a.internalid = tags.accessoryid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, accessoryid
                  FROM users_accessories_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY accessoryid
                  ) AS favusers ON a.internalid = favusers.accessoryid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, accessoryid
                  FROM users_accessories_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY accessoryid
                  ) AS colusers ON a.internalid = colusers.accessoryid
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
                  a.validatorid, uv.username AS validatorname, a.validationdate, a.nbpictures,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM accessories a
            LEFT JOIN users uc ON a.creatorid = uc.internalid
            LEFT JOIN users ue ON a.editorid = ue.internalid
            LEFT JOIN users uv ON a.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT accessoryid, additiondate, quantity
                  FROM users_accessories_collection
                  WHERE userid = :userid
                  ) AS ucol ON a.internalid = ucol.accessoryid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, accessoryid
                  FROM users_accessories_favorites
                  GROUP BY accessoryid
                  ) AS faved ON a.internalid = faved.accessoryid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, accessoryid
                  FROM users_accessories_favorites
                  WHERE userid = :userid
                  GROUP BY accessoryid
                  ) AS userfav ON a.internalid = userfav.accessoryid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, accessoryid
                  FROM tags_accessories AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY accessoryid
                  ) AS tags ON a.internalid = tags.accessoryid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, accessoryid
                  FROM users_accessories_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY accessoryid
                  ) AS favusers ON a.internalid = favusers.accessoryid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, accessoryid
                  FROM users_accessories_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY accessoryid
                  ) AS colusers ON a.internalid = colusers.accessoryid
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
                  a.validatorid, uv.username AS validatorname, a.validationdate, a.nbpictures,
                  pa.xmin, pa.xmax, pa.ymin, pa.ymax, pa.internalid AS photoannotationid,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
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
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, accessoryid
                  FROM users_accessories_favorites
                  GROUP BY accessoryid
                  ) AS faved ON a.internalid = faved.accessoryid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, accessoryid
                  FROM users_accessories_favorites
                  WHERE userid = :userid
                  GROUP BY accessoryid
                  ) AS userfav ON a.internalid = userfav.accessoryid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, accessoryid
                  FROM tags_accessories AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY accessoryid
                  ) AS tags ON a.internalid = tags.accessoryid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, accessoryid
                  FROM users_accessories_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY accessoryid
                  ) AS favusers ON a.internalid = favusers.accessoryid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, accessoryid
                  FROM users_accessories_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY accessoryid
                  ) AS colusers ON a.internalid = colusers.accessoryid
            WHERE pa.photoid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new AccessoryEntity($row);
    }
    return $results;
  }

  public function addHistory($userid, $elementid, $action, $detail="", $photoid=null) {
    $element = $this->getByInternalid($elementid);

    $mapper = new HistoryMapper($this->db);
    $mapper->addElementHistory($userid, $element->getBoxId(), $element->getNendoroidId(),
                               $elementid, null,
                               null, null, null,
                               $photoid, $action, $detail);
    return null;
  }

  public function getHistory($elementid) {
    $mapper = new HistoryMapper($this->db);
    return $mapper->getByElementid($elementid, "accessoryid");
  }

  public function create(AccessoryEntity $accessory, $userid) {
    $sql = "INSERT INTO accessories
              (boxid, nendoroidid, type, main_color, other_color, description, creatorid, creationdate, editorid, editiondate) VALUES
              (:boxid, :nendoroidid, :type, :main_color, :other_color, :description, :userid, NOW(), :userid, NOW())";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "boxid" => $accessory->getBoxId(),
        "nendoroidid" => $accessory->getNendoroidId(),
        "type" => $accessory->getType(),
        "main_color" => $accessory->getMainColor(),
        "other_color" => $accessory->getOtherColor(),
        "description" => $accessory->getDescription(),
        "userid" => $userid
      ]);
    if(!$result) {
      throw new Exception("Could not save accessory");
    }
    $accessoryid = $this->db->lastInsertId();
    $this->addHistory($userid,$accessoryid,"Creation");
    return $this->getByInternalid($accessoryid);
  }

  public function update(AccessoryEntity $accessory, $userid) {
    $sql = "UPDATE accessories SET
              boxid = :boxid,
              nendoroidid = :nendoroidid,
              type = :type,
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
        "internalid" => $accessory->getInternalId(),
        "boxid" => $accessory->getBoxId(),
        "nendoroidid" => $accessory->getNendoroidId(),
        "type" => $accessory->getType(),
        "main_color" => $accessory->getMainColor(),
        "other_color" => $accessory->getOtherColor(),
        "description" => $accessory->getDescription(),
        "userid" => $userid
      ]);
    if(!$result) {
      throw new Exception("Could not update accessory");
    }
    $this->addHistory($userid,$accessory->getInternalId(),"Update");
    return $this->getByInternalid($accessory->getInternalId(), $userid);
  }

  public function addPicture($accessory_internalid, $accessory_imagenumber, $userid) {
    $sql = "SELECT nbpictures
          FROM accessories
          WHERE internalid = :accessoryid";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["accessoryid" => $accessory_internalid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new AccessoryEntity($row);
    }
    $nbpictures = $results[0]->getNbPictures();

    if ($accessory_imagenumber > $nbpictures) {
      $nbpictures ++;

      $sql = "UPDATE accessories SET
                nbpictures = :nbpictures
          WHERE internalid = :internalid";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute([
          "internalid" => $accessory_internalid,
          "nbpictures" => $nbpictures
        ]);
      if(!$result) {
        throw new Exception("Could not update accessory");
      }
    }

    $this->addHistory($userid, $accessory_internalid, "Update", "Picture $accessory_imagenumber has been updated");
  }
}
