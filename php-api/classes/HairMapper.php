<?php

class HairMapper extends Mapper
{
  protected $tablename = "hairs";
  protected $collectiontablename = "users_hairs_collection";
  protected $favoritestablename = "users_hairs_favorites";
  protected $othertablecolumn = "hairid";

  public function get($userid=null, $validated=true) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.main_color, h.other_color, h.haircut, h.description, h.frontback,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate, h.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity,
                  faved.numberfavorited, userfav.inuserfavorites, favusers.favusers
            FROM hairs h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT hairid, additiondate, quantity
                  FROM users_hairs_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.hairid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, hairid
                  FROM users_hairs_favorites
                  GROUP BY hairid
                  ) AS faved ON h.internalid = faved.hairid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, hairid
                  FROM users_hairs_favorites
                  WHERE userid = :userid
                  GROUP BY hairid
                  ) AS userfav ON h.internalid = userfav.hairid
            LEFT JOIN (
                  SELECT CONCAT('[',GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')),']') AS favusers, hairid
                  FROM users_hairs_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY hairid
                  ) AS favusers ON h.internalid = favusers.hairid";
    if ($validated) {
      $sql .= " WHERE h.validatorid IS NOT NULL";
    }
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
                  h.validatorid, uv.username AS validatorname, h.validationdate, h.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity,
                  faved.numberfavorited, userfav.inuserfavorites, favusers.favusers
            FROM hairs h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT hairid, additiondate, quantity
                  FROM users_hairs_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.hairid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, hairid
                  FROM users_hairs_favorites
                  GROUP BY hairid
                  ) AS faved ON h.internalid = faved.hairid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, hairid
                  FROM users_hairs_favorites
                  WHERE userid = :userid
                  GROUP BY hairid
                  ) AS userfav ON h.internalid = userfav.hairid
            LEFT JOIN (
                  SELECT CONCAT('[',GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')),']') AS favusers, hairid
                  FROM users_hairs_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY hairid
                  ) AS favusers ON h.internalid = favusers.hairid
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
                  h.validatorid, uv.username AS validatorname, h.validationdate, h.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity,
                  faved.numberfavorited, userfav.inuserfavorites, favusers.favusers
            FROM hairs h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT hairid, additiondate, quantity
                  FROM users_hairs_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.hairid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, hairid
                  FROM users_hairs_favorites
                  GROUP BY hairid
                  ) AS faved ON h.internalid = faved.hairid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, hairid
                  FROM users_hairs_favorites
                  WHERE userid = :userid
                  GROUP BY hairid
                  ) AS userfav ON h.internalid = userfav.hairid
            LEFT JOIN (
                  SELECT CONCAT('[',GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')),']') AS favusers, hairid
                  FROM users_hairs_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY hairid
                  ) AS favusers ON h.internalid = favusers.hairid
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
                  h.validatorid, uv.username AS validatorname, h.validationdate, h.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity,
                  faved.numberfavorited, userfav.inuserfavorites, favusers.favusers
            FROM hairs h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT hairid, additiondate, quantity
                  FROM users_hairs_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.hairid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, hairid
                  FROM users_hairs_favorites
                  GROUP BY hairid
                  ) AS faved ON h.internalid = faved.hairid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, hairid
                  FROM users_hairs_favorites
                  WHERE userid = :userid
                  GROUP BY hairid
                  ) AS userfav ON h.internalid = userfav.hairid
            LEFT JOIN (
                  SELECT CONCAT('[',GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')),']') AS favusers, hairid
                  FROM users_hairs_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY hairid
                  ) AS favusers ON h.internalid = favusers.hairid
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
                  h.validatorid, uv.username AS validatorname, h.validationdate, h.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity,
                  faved.numberfavorited, userfav.inuserfavorites, favusers.favusers
            FROM hairs h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT hairid, additiondate, quantity
                  FROM users_hairs_collection
                  WHERE userid = :userid
                  ) AS ucol ON h.internalid = ucol.hairid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, hairid
                  FROM users_hairs_favorites
                  GROUP BY hairid
                  ) AS faved ON h.internalid = faved.hairid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, hairid
                  FROM users_hairs_favorites
                  WHERE userid = :userid
                  GROUP BY hairid
                  ) AS userfav ON h.internalid = userfav.hairid
            LEFT JOIN (
                  SELECT CONCAT('[',GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')),']') AS favusers, hairid
                  FROM users_hairs_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY hairid
                  ) AS favusers ON h.internalid = favusers.hairid
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
                  h.validatorid, uv.username AS validatorname, h.validationdate, h.haspicture,
                  ph.xmin, ph.xmax, ph.ymin, ph.ymax, ph.internalid AS photoannotationid,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity,
                  faved.numberfavorited, userfav.inuserfavorites, favusers.favusers
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
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, hairid
                  FROM users_hairs_favorites
                  GROUP BY hairid
                  ) AS faved ON h.internalid = faved.hairid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, hairid
                  FROM users_hairs_favorites
                  WHERE userid = :userid
                  GROUP BY hairid
                  ) AS userfav ON h.internalid = userfav.hairid
            LEFT JOIN (
                  SELECT CONCAT('[',GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')),']') AS favusers, hairid
                  FROM users_hairs_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY hairid
                  ) AS favusers ON h.internalid = favusers.hairid
            WHERE ph.photoid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HairEntity($row);
    }
    return $results;
  }

  public function addHistory($userid, $elementid, $action, $detail="", $photoid=null) {
    $element = $this->getByInternalid($elementid);

    $mapper = new HistoryMapper($this->db);
    $mapper->addElementHistory($userid, $element->getBoxId(), $element->getNendoroidId(),
                               null, null,
                               null, $elementid, null,
                               $photoid, $action, $detail);
    return null;
  }

  public function getHistory($elementid) {
    $mapper = new HistoryMapper($this->db);
    return $mapper->getByElementid($elementid, "hairid");
  }

  public function create(HairEntity $hair, $userid) {
    $sql = "INSERT INTO hairs
              (boxid, nendoroidid, main_color, other_color, haircut, description, frontback, creatorid, creationdate, editorid, editiondate) VALUES
              (:boxid, :nendoroidid, :main_color, :other_color, :haircut, :description, :frontback, :userid, NOW(), :userid, NOW())";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "boxid" => $hair->getBoxId(),
        "nendoroidid" => $hair->getNendoroidId(),
        "main_color" => $hair->getMainColor(),
        "other_color" => $hair->getOtherColor(),
        "haircut" => $hair->getHairCut(),
        "description" => $hair->getDescription(),
        "frontback" => $hair->getFrontBack(),
        "userid" => $userid
      ]);
    if(!$result) {
      throw new Exception("Could not save hair");
    }
    $hairid = $this->db->lastInsertId();
    $this->addHistory($userid,$hairid,"Creation");
    return $this->getByInternalid($hairid);
  }

  public function update(HairEntity $hair, $userid) {
    $sql = "UPDATE hairs SET
              boxid = :boxid,
              nendoroidid = :nendoroidid,
              main_color = :main_color,
              other_color = :other_color,
              haircut = :haircut,
              description = :description,
              frontback = :frontback,
              editorid = :userid,
              editiondate = NOW(),
              validatorid = null,
              validationdate = null
            WHERE internalid = :internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "internalid" => $hair->getInternalId(),
        "boxid" => $hair->getBoxId(),
        "nendoroidid" => $hair->getNendoroidId(),
        "main_color" => $hair->getMainColor(),
        "other_color" => $hair->getOtherColor(),
        "haircut" => $hair->getHairCut(),
        "description" => $hair->getDescription(),
        "frontback" => $hair->getFrontBack(),
        "userid" => $userid
      ]);
    if(!$result) {
      throw new Exception("Could not update hair");
    }
    $this->addHistory($userid,$hair->getInternalId(),"Update");
    return $this->getByInternalid($hair->getInternalId(), $userid);
  }

  public function addPicture($hair_internalid, $userid) {
    $sql = "UPDATE hairs SET
              haspicture = 1
            WHERE internalid = :internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "internalid" => $hair_internalid
      ]);
    if(!$result) {
      throw new Exception("Could not update hair");
    }
    $this->addHistory($userid, $hair_internalid, "Update", "Picture has been updated");
  }
}
