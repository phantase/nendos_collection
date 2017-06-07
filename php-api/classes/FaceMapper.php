<?php

class FaceMapper extends Mapper
{
  protected $tablename = "faces";
  protected $collectiontablename = "users_faces_collection";
  protected $favoritestablename = "users_faces_favorites";
  protected $othertablecolumn = "faceid";

  public function get($userid=null, $validated=true) {
    $sql = "SELECT f.internalid, f.boxid, f.nendoroidid, f.eyes, f.eyes_color, f.mouth, f.skin_color, f.sex,
                  f.creatorid, uc.username AS creatorname, f.creationdate,
                  f.editorid, ue.username AS editorname, f.editiondate,
                  f.validatorid, uv.username AS validatorname, f.validationdate, f.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, colusers.colusers,
                  faved.numberfavorited, userfav.inuserfavorites, favusers.favusers
            FROM faces f
            LEFT JOIN users uc ON f.creatorid = uc.internalid
            LEFT JOIN users ue ON f.editorid = ue.internalid
            LEFT JOIN users uv ON f.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT faceid, additiondate, quantity
                  FROM users_faces_collection
                  WHERE userid = :userid
                  ) AS ucol ON f.internalid = ucol.faceid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, faceid
                  FROM users_faces_favorites
                  GROUP BY faceid
                  ) AS faved ON f.internalid = faved.faceid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, faceid
                  FROM users_faces_favorites
                  WHERE userid = :userid
                  GROUP BY faceid
                  ) AS userfav ON f.internalid = userfav.faceid
            LEFT JOIN (
                  SELECT CONCAT('[',GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')),']') AS favusers, faceid
                  FROM users_faces_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY faceid
                  ) AS favusers ON f.internalid = favusers.faceid
            LEFT JOIN (
                  SELECT CONCAT('[',GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')),']') AS colusers, faceid
                  FROM users_faces_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY faceid
                  ) AS colusers ON f.internalid = colusers.faceid";
    if ($validated) {
      $sql .= " WHERE f.validatorid IS NOT NULL";
    }
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new FaceEntity($row);
    }
    return $results;
  }

  public function getByInternalid($face_internalid, $userid=null) {
    $sql = "SELECT f.internalid, f.boxid, f.nendoroidid, f.eyes, f.eyes_color, f.mouth, f.skin_color, f.sex,
                  f.creatorid, uc.username AS creatorname, f.creationdate,
                  f.editorid, ue.username AS editorname, f.editiondate,
                  f.validatorid, uv.username AS validatorname, f.validationdate, f.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, colusers.colusers,
                  faved.numberfavorited, userfav.inuserfavorites, favusers.favusers
            FROM faces f
            LEFT JOIN users uc ON f.creatorid = uc.internalid
            LEFT JOIN users ue ON f.editorid = ue.internalid
            LEFT JOIN users uv ON f.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT faceid, additiondate, quantity
                  FROM users_faces_collection
                  WHERE userid = :userid
                  ) AS ucol ON f.internalid = ucol.faceid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, faceid
                  FROM users_faces_favorites
                  GROUP BY faceid
                  ) AS faved ON f.internalid = faved.faceid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, faceid
                  FROM users_faces_favorites
                  WHERE userid = :userid
                  GROUP BY faceid
                  ) AS userfav ON f.internalid = userfav.faceid
            LEFT JOIN (
                  SELECT CONCAT('[',GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')),']') AS favusers, faceid
                  FROM users_faces_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY faceid
                  ) AS favusers ON f.internalid = favusers.faceid
            LEFT JOIN (
                  SELECT CONCAT('[',GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')),']') AS colusers, faceid
                  FROM users_faces_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY faceid
                  ) AS colusers ON f.internalid = colusers.faceid
            WHERE f.internalid = :face_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["face_internalid" => $face_internalid, "userid" => $userid]);

    if($row = $stmt->fetch()) {
      return new FaceEntity($row);
    }
  }

  public function getByBoxid($boxid, $userid=null) {
    $sql = "SELECT f.internalid, f.boxid, f.nendoroidid, f.eyes, f.eyes_color, f.mouth, f.skin_color, f.sex,
                  f.creatorid, uc.username AS creatorname, f.creationdate,
                  f.editorid, ue.username AS editorname, f.editiondate,
                  f.validatorid, uv.username AS validatorname, f.validationdate, f.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, colusers.colusers,
                  faved.numberfavorited, userfav.inuserfavorites, favusers.favusers
            FROM faces f
            LEFT JOIN users uc ON f.creatorid = uc.internalid
            LEFT JOIN users ue ON f.editorid = ue.internalid
            LEFT JOIN users uv ON f.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT faceid, additiondate, quantity
                  FROM users_faces_collection
                  WHERE userid = :userid
                  ) AS ucol ON f.internalid = ucol.faceid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, faceid
                  FROM users_faces_favorites
                  GROUP BY faceid
                  ) AS faved ON f.internalid = faved.faceid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, faceid
                  FROM users_faces_favorites
                  WHERE userid = :userid
                  GROUP BY faceid
                  ) AS userfav ON f.internalid = userfav.faceid
            LEFT JOIN (
                  SELECT CONCAT('[',GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')),']') AS favusers, faceid
                  FROM users_faces_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY faceid
                  ) AS favusers ON f.internalid = favusers.faceid
            LEFT JOIN (
                  SELECT CONCAT('[',GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')),']') AS colusers, faceid
                  FROM users_faces_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY faceid
                  ) AS colusers ON f.internalid = colusers.faceid
            WHERE f.boxid = :boxid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["boxid" => $boxid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new FaceEntity($row);
    }
    return $results;
  }

  public function getByNendoroidid($nendoroidid, $userid=null) {
    $sql = "SELECT f.internalid, f.boxid, f.nendoroidid, f.eyes, f.eyes_color, f.mouth, f.skin_color, f.sex,
                  f.creatorid, uc.username AS creatorname, f.creationdate,
                  f.editorid, ue.username AS editorname, f.editiondate,
                  f.validatorid, uv.username AS validatorname, f.validationdate, f.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, colusers.colusers,
                  faved.numberfavorited, userfav.inuserfavorites, favusers.favusers
            FROM faces f
            LEFT JOIN users uc ON f.creatorid = uc.internalid
            LEFT JOIN users ue ON f.editorid = ue.internalid
            LEFT JOIN users uv ON f.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT faceid, additiondate, quantity
                  FROM users_faces_collection
                  WHERE userid = :userid
                  ) AS ucol ON f.internalid = ucol.faceid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, faceid
                  FROM users_faces_favorites
                  GROUP BY faceid
                  ) AS faved ON f.internalid = faved.faceid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, faceid
                  FROM users_faces_favorites
                  WHERE userid = :userid
                  GROUP BY faceid
                  ) AS userfav ON f.internalid = userfav.faceid
            LEFT JOIN (
                  SELECT CONCAT('[',GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')),']') AS favusers, faceid
                  FROM users_faces_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY faceid
                  ) AS favusers ON f.internalid = favusers.faceid
            LEFT JOIN (
                  SELECT CONCAT('[',GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')),']') AS colusers, faceid
                  FROM users_faces_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY faceid
                  ) AS colusers ON f.internalid = colusers.faceid
            WHERE f.nendoroidid = :nendoroidid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["nendoroidid" => $nendoroidid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new FaceEntity($row);
    }
    return $results;
  }

  public function getByFaceid($faceid, $userid=null) {
    $sql = "SELECT f.internalid, f.boxid, f.nendoroidid, f.eyes, f.eyes_color, f.mouth, f.skin_color, f.sex,
                  f.creatorid, uc.username AS creatorname, f.creationdate,
                  f.editorid, ue.username AS editorname, f.editiondate,
                  f.validatorid, uv.username AS validatorname, f.validationdate, f.haspicture,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, colusers.colusers,
                  faved.numberfavorited, userfav.inuserfavorites, favusers.favusers
            FROM faces f
            LEFT JOIN users uc ON f.creatorid = uc.internalid
            LEFT JOIN users ue ON f.editorid = ue.internalid
            LEFT JOIN users uv ON f.validatorid = uv.internalid
            LEFT JOIN (
                  SELECT faceid, additiondate, quantity
                  FROM users_faces_collection
                  WHERE userid = :userid
                  ) AS ucol ON f.internalid = ucol.faceid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, faceid
                  FROM users_faces_favorites
                  GROUP BY faceid
                  ) AS faved ON f.internalid = faved.faceid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, faceid
                  FROM users_faces_favorites
                  WHERE userid = :userid
                  GROUP BY faceid
                  ) AS userfav ON f.internalid = userfav.faceid
            LEFT JOIN (
                  SELECT CONCAT('[',GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')),']') AS favusers, faceid
                  FROM users_faces_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY faceid
                  ) AS favusers ON f.internalid = favusers.faceid
            LEFT JOIN (
                  SELECT CONCAT('[',GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')),']') AS colusers, faceid
                  FROM users_faces_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY faceid
                  ) AS colusers ON f.internalid = colusers.faceid
            WHERE f.internalid = :faceid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["faceid" => $faceid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new FaceEntity($row);
    }
    return $results;
  }

  public function getByPhotoid($photoid, $userid=null) {
    $sql = "SELECT f.internalid, f.boxid, f.nendoroidid, f.eyes, f.eyes_color, f.mouth, f.skin_color, f.sex,
                  f.creatorid, uc.username AS creatorname, f.creationdate,
                  f.editorid, ue.username AS editorname, f.editiondate,
                  f.validatorid, uv.username AS validatorname, f.validationdate, f.haspicture,
                  pf.xmin, pf.xmax, pf.ymin, pf.ymax, pf.internalid AS photoannotationid,
                  ucol.additiondate AS colladdeddate, ucol.quantity AS collquantity, colusers.colusers,
                  faved.numberfavorited, userfav.inuserfavorites, favusers.favusers
            FROM faces f
            LEFT JOIN users uc ON f.creatorid = uc.internalid
            LEFT JOIN users ue ON f.editorid = ue.internalid
            LEFT JOIN users uv ON f.validatorid = uv.internalid
            LEFT JOIN photos_faces pf ON f.internalid = pf.faceid
            LEFT JOIN (
                  SELECT faceid, additiondate, quantity
                  FROM users_faces_collection
                  WHERE userid = :userid
                  ) AS ucol ON f.internalid = ucol.faceid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, faceid
                  FROM users_faces_favorites
                  GROUP BY faceid
                  ) AS faved ON f.internalid = faved.faceid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, faceid
                  FROM users_faces_favorites
                  WHERE userid = :userid
                  GROUP BY faceid
                  ) AS userfav ON f.internalid = userfav.faceid
            LEFT JOIN (
                  SELECT CONCAT('[',GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')),']') AS favusers, faceid
                  FROM users_faces_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY faceid
                  ) AS favusers ON f.internalid = favusers.faceid
            LEFT JOIN (
                  SELECT CONCAT('[',GROUP_CONCAT(CONCAT('{ \"userid\":\"',c.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',c.additiondate,
                                                        '\",\"quantity\":\"',c.quantity,
                                                        '\"}')),']') AS colusers, faceid
                  FROM users_faces_collection AS c, users AS u
                  WHERE c.userid = u.internalid
                  GROUP BY faceid
                  ) AS colusers ON f.internalid = colusers.faceid
            WHERE pf.photoid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid, "userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new FaceEntity($row);
    }
    return $results;
  }

  public function addHistory($userid, $elementid, $action, $detail="", $photoid=null) {
    $element = $this->getByInternalid($elementid);

    $mapper = new HistoryMapper($this->db);
    $mapper->addElementHistory($userid, $element->getBoxId(), $element->getNendoroidId(),
                               null, null,
                               $elementid, null, null,
                               $photoid, $action, $detail);
    return null;
  }

  public function getHistory($elementid) {
    $mapper = new HistoryMapper($this->db);
    return $mapper->getByElementid($elementid, "faceid");
  }

  public function create(FaceEntity $face, $userid) {
    $sql = "INSERT INTO faces
              (boxid, nendoroidid, eyes, eyes_color, mouth, skin_color, sex, creatorid, creationdate, editorid, editiondate) VALUES
              (:boxid, :nendoroidid, :eyes, :eyes_color, :mouth, :skin_color, :sex, :userid, NOW(), :userid, NOW())";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "boxid" => $face->getBoxId(),
        "nendoroidid" => $face->getNendoroidId(),
        "eyes" => $face->getEyes(),
        "eyes_color" => $face->getEyesColor(),
        "mouth" => $face->getMouth(),
        "skin_color" => $face->getSkinColor(),
        "sex" => $face->getSex(),
        "userid" => $userid
      ]);
    if(!$result) {
      throw new Exception("Could not save face");
    }
    $faceid = $this->db->lastInsertId();
    $this->addHistory($userid,$faceid,"Creation");
    return $this->getByInternalid($faceid);
  }

  public function update(FaceEntity $face, $userid) {
    $sql = "UPDATE faces SET
              boxid = :boxid,
              nendoroidid = :nendoroidid,
              eyes = :eyes,
              eyes_color = :eyes_color,
              mouth = :mouth,
              skin_color = :skin_color,
              sex = :sex,
              editorid = :userid,
              editiondate = NOW(),
              validatorid = null,
              validationdate = null
            WHERE internalid = :internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "internalid" => $face->getInternalId(),
        "boxid" => $face->getBoxId(),
        "nendoroidid" => $face->getNendoroidId(),
        "eyes" => $face->getEyes(),
        "eyes_color" => $face->getEyesColor(),
        "mouth" => $face->getMouth(),
        "skin_color" => $face->getSkinColor(),
        "sex" => $face->getSex(),
        "userid" => $userid
      ]);
    if(!$result) {
      throw new Exception("Could not update face");
    }
    $this->addHistory($userid,$face->getInternalId(),"Update");
    return $this->getByInternalid($face->getInternalId(), $userid);
  }

  public function addPicture($face_internalid, $userid) {
    $sql = "UPDATE faces SET
              haspicture = 1
            WHERE internalid = :internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "internalid" => $face_internalid
      ]);
    if(!$result) {
      throw new Exception("Could not update face");
    }
    $this->addHistory($userid, $face_internalid, "Update", "Picture has been updated");
  }
}
