<?php

class NendoroidMapper extends Mapper
{
  protected $tablename = "nendoroids";
  protected $collectiontablename = "users_nendoroids_collection";
  protected $favoritestablename = "users_nendoroids_favorites";
  protected $tagstablename = "tags_nendoroids";
  protected $othertablecolumn = "nendoroidid";

  public function get($userid=null, $validated=true) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate, n.nbpictures,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT nendoroidid, additiondate, quantity
                  FROM users_nendoroids_collection
                  WHERE userid = :userid
                  ) AS ucol ON n.internalid = ucol.nendoroidid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, nendoroidid
                  FROM users_nendoroids_favorites
                  GROUP BY nendoroidid
                  ) AS faved ON n.internalid = faved.nendoroidid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, nendoroidid
                  FROM users_nendoroids_favorites
                  WHERE userid = :userid
                  GROUP BY nendoroidid
                  ) AS userfav ON n.internalid = userfav.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, nendoroidid
                  FROM tags_nendoroids AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS tags ON n.internalid = tags.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, nendoroidid
                  FROM users_nendoroids_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS favusers ON n.internalid = favusers.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, nendoroidid
                  FROM users_nendoroids_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS colusers ON n.internalid = colusers.nendoroidid";
    if ($validated) {
      $sql .= " WHERE n.validatorid IS NOT NULL";
    }
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
                  n.validatorid, uv.username AS validatorname, n.validationdate, n.nbpictures,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT nendoroidid, additiondate, quantity
                  FROM users_nendoroids_collection
                  WHERE userid = :userid
                  ) AS ucol ON n.internalid = ucol.nendoroidid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, nendoroidid
                  FROM users_nendoroids_favorites
                  GROUP BY nendoroidid
                  ) AS faved ON n.internalid = faved.nendoroidid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, nendoroidid
                  FROM users_nendoroids_favorites
                  WHERE userid = :userid
                  GROUP BY nendoroidid
                  ) AS userfav ON n.internalid = userfav.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, nendoroidid
                  FROM tags_nendoroids AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS tags ON n.internalid = tags.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, nendoroidid
                  FROM users_nendoroids_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS favusers ON n.internalid = favusers.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, nendoroidid
                  FROM users_nendoroids_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS colusers ON n.internalid = colusers.nendoroidid
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
                  n.validatorid, uv.username AS validatorname, n.validationdate, n.nbpictures,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT nendoroidid, additiondate, quantity
                  FROM users_nendoroids_collection
                  WHERE userid = :userid
                  ) AS ucol ON n.internalid = ucol.nendoroidid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, nendoroidid
                  FROM users_nendoroids_favorites
                  GROUP BY nendoroidid
                  ) AS faved ON n.internalid = faved.nendoroidid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, nendoroidid
                  FROM users_nendoroids_favorites
                  WHERE userid = :userid
                  GROUP BY nendoroidid
                  ) AS userfav ON n.internalid = userfav.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, nendoroidid
                  FROM tags_nendoroids AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS tags ON n.internalid = tags.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, nendoroidid
                  FROM users_nendoroids_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS favusers ON n.internalid = favusers.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, nendoroidid
                  FROM users_nendoroids_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS colusers ON n.internalid = colusers.nendoroidid
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
                  n.validatorid, uv.username AS validatorname, n.validationdate, n.nbpictures,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT nendoroidid, additiondate, quantity
                  FROM users_nendoroids_collection
                  WHERE userid = :userid
                  ) AS ucol ON n.internalid = ucol.nendoroidid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, nendoroidid
                  FROM users_nendoroids_favorites
                  GROUP BY nendoroidid
                  ) AS faved ON n.internalid = faved.nendoroidid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, nendoroidid
                  FROM users_nendoroids_favorites
                  WHERE userid = :userid
                  GROUP BY nendoroidid
                  ) AS userfav ON n.internalid = userfav.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, nendoroidid
                  FROM tags_nendoroids AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS tags ON n.internalid = tags.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, nendoroidid
                  FROM users_nendoroids_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS favusers ON n.internalid = favusers.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, nendoroidid
                  FROM users_nendoroids_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS colusers ON n.internalid = colusers.nendoroidid
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
                  n.validatorid, uv.username AS validatorname, n.validationdate, n.nbpictures,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
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
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, nendoroidid
                  FROM users_nendoroids_favorites
                  GROUP BY nendoroidid
                  ) AS faved ON n.internalid = faved.nendoroidid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, nendoroidid
                  FROM users_nendoroids_favorites
                  WHERE userid = :userid
                  GROUP BY nendoroidid
                  ) AS userfav ON n.internalid = userfav.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, nendoroidid
                  FROM tags_nendoroids AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS tags ON n.internalid = tags.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, nendoroidid
                  FROM users_nendoroids_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS favusers ON n.internalid = favusers.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, nendoroidid
                  FROM users_nendoroids_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS colusers ON n.internalid = colusers.nendoroidid
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
                  n.validatorid, uv.username AS validatorname, n.validationdate, n.nbpictures,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
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
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, nendoroidid
                  FROM users_nendoroids_favorites
                  GROUP BY nendoroidid
                  ) AS faved ON n.internalid = faved.nendoroidid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, nendoroidid
                  FROM users_nendoroids_favorites
                  WHERE userid = :userid
                  GROUP BY nendoroidid
                  ) AS userfav ON n.internalid = userfav.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, nendoroidid
                  FROM tags_nendoroids AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS tags ON n.internalid = tags.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, nendoroidid
                  FROM users_nendoroids_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS favusers ON n.internalid = favusers.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, nendoroidid
                  FROM users_nendoroids_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS colusers ON n.internalid = colusers.nendoroidid
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
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
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
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, nendoroidid
                  FROM users_nendoroids_favorites
                  GROUP BY nendoroidid
                  ) AS faved ON n.internalid = faved.nendoroidid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, nendoroidid
                  FROM users_nendoroids_favorites
                  WHERE userid = :userid
                  GROUP BY nendoroidid
                  ) AS userfav ON n.internalid = userfav.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, nendoroidid
                  FROM tags_nendoroids AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS tags ON n.internalid = tags.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, nendoroidid
                  FROM users_nendoroids_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS favusers ON n.internalid = favusers.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, nendoroidid
                  FROM users_nendoroids_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS colusers ON n.internalid = colusers.nendoroidid
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
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
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
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, nendoroidid
                  FROM users_nendoroids_favorites
                  GROUP BY nendoroidid
                  ) AS faved ON n.internalid = faved.nendoroidid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, nendoroidid
                  FROM users_nendoroids_favorites
                  WHERE userid = :userid
                  GROUP BY nendoroidid
                  ) AS userfav ON n.internalid = userfav.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, nendoroidid
                  FROM tags_nendoroids AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS tags ON n.internalid = tags.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, nendoroidid
                  FROM users_nendoroids_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS favusers ON n.internalid = favusers.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, nendoroidid
                  FROM users_nendoroids_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS colusers ON n.internalid = colusers.nendoroidid
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
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
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
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, nendoroidid
                  FROM users_nendoroids_favorites
                  GROUP BY nendoroidid
                  ) AS faved ON n.internalid = faved.nendoroidid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, nendoroidid
                  FROM users_nendoroids_favorites
                  WHERE userid = :userid
                  GROUP BY nendoroidid
                  ) AS userfav ON n.internalid = userfav.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, nendoroidid
                  FROM tags_nendoroids AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS tags ON n.internalid = tags.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, nendoroidid
                  FROM users_nendoroids_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS favusers ON n.internalid = favusers.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, nendoroidid
                  FROM users_nendoroids_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS colusers ON n.internalid = colusers.nendoroidid
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
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, CONCAT('[',colusers.colusers,']') AS colusers,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
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
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, nendoroidid
                  FROM users_nendoroids_favorites
                  GROUP BY nendoroidid
                  ) AS faved ON n.internalid = faved.nendoroidid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, nendoroidid
                  FROM users_nendoroids_favorites
                  WHERE userid = :userid
                  GROUP BY nendoroidid
                  ) AS userfav ON n.internalid = userfav.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, nendoroidid
                  FROM tags_nendoroids AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS tags ON n.internalid = tags.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, nendoroidid
                  FROM users_nendoroids_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS favusers ON n.internalid = favusers.nendoroidid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')) AS colusers, nendoroidid
                  FROM users_nendoroids_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY nendoroidid
                  ) AS colusers ON n.internalid = colusers.nendoroidid
            WHERE pn.photoid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

  public function addHistory($userid, $elementid, $action, $detail="", $photoid=null) {
    $element = $this->getByInternalid($elementid);

    $mapper = new HistoryMapper($this->db);
    $mapper->addElementHistory($userid, $element->getBoxId(), $elementid,
                               null, null,
                               null, null, null,
                               $photoid, $action, $detail);
    return null;
  }

  public function getHistory($elementid) {
    $mapper = new HistoryMapper($this->db);
    return $mapper->getByElementid($elementid, "nendoroidid");
  }

  public function create(NendoroidEntity $nendoroid, $userid) {
    $sql = "INSERT INTO nendoroids
              (boxid, name, version, sex, dominant_color, creatorid, creationdate, editorid, editiondate) VALUES
              (:boxid, :name, :version, :sex, :dominant_color, :userid, NOW(), :userid, NOW())";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "boxid" => $nendoroid->getBoxId(),
        "name" => $nendoroid->getName(),
        "version" => $nendoroid->getVersion(),
        "sex" => $nendoroid->getSex(),
        "dominant_color" => $nendoroid->getDominantColor(),
        "userid" => $userid
      ]);
    if(!$result) {
      throw new Exception("Could not save nendoroid");
    }
    $nendoroidid = $this->db->lastInsertId();
    $this->addHistory($userid,$nendoroidid,"Creation");
    return $this->getByInternalid($nendoroidid);
  }

  public function update(NendoroidEntity $nendoroid, $userid) {
    $sql = "UPDATE nendoroids SET
              boxid = :boxid,
              name = :name,
              version = :version,
              sex = :sex,
              dominant_color = :dominant_color,
              editorid = :userid,
              editiondate = NOW(),
              validatorid = null,
              validationdate = null
            WHERE internalid = :internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "internalid" => $nendoroid->getInternalid(),
        "boxid" => $nendoroid->getBoxId(),
        "name" => $nendoroid->getName(),
        "version" => $nendoroid->getVersion(),
        "sex" => $nendoroid->getSex(),
        "dominant_color" => $nendoroid->getDominantColor(),
        "userid" => $userid
      ]);
    if(!$result) {
      throw new Exception("Could not update nendoroid");
    }
    $this->addHistory($userid,$nendoroid->getInternalid(),"Update");
    return $this->getByInternalid($nendoroid->getInternalid(), $userid);
  }

  public function addPicture($nendoroid_internalid, $nendoroid_imagenumber, $userid) {
    $sql = "SELECT nbpictures
        FROM nendoroids
        WHERE internalid = :nendoroidid";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["nendoroidid" => $nendoroid_internalid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    $nbpictures = $results[0]->getNbPictures();

    if ($nendoroid_imagenumber > $nbpictures) {
      $nbpictures ++;

      $sql = "UPDATE nendoroids SET
                nbpictures = :nbpictures
          WHERE internalid = :internalid";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute([
          "internalid" => $nendoroid_internalid,
          "nbpictures" => $nbpictures
        ]);
      if(!$result) {
        throw new Exception("Could not update nendoroid");
      }
    }

    $this->addHistory($userid, $nendoroid_internalid, "Update", "Picture $nendoroid_imagenumber has been updated");
  }
}
