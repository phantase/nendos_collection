<?php

class PhotoMapper extends Mapper
{
  protected $tablename = "photos";
  protected $favoritestablename = "users_photos_favorites";
  protected $tagstablename = "tags_photos";
  protected $othertablecolumn = "photoid";

  public function get($userid=null) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, photoid
                  FROM users_photos_favorites
                  GROUP BY photoid
                  ) AS faved ON p.internalid = faved.photoid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, photoid
                  FROM users_photos_favorites
                  WHERE userid = :userid
                  GROUP BY photoid
                  ) AS userfav ON p.internalid = userfav.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, photoid
                  FROM tags_photos AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY photoid
                  ) AS tags ON p.internalid = tags.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, photoid
                  FROM users_photos_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY photoid
                  ) AS favusers ON p.internalid = favusers.photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoEntity($row);
    }
    return $results;
  }

  public function getByInternalid($photo_internalid, $userid=null) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, photoid
                  FROM users_photos_favorites
                  GROUP BY photoid
                  ) AS faved ON p.internalid = faved.photoid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, photoid
                  FROM users_photos_favorites
                  WHERE userid = :userid
                  GROUP BY photoid
                  ) AS userfav ON p.internalid = userfav.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, photoid
                  FROM tags_photos AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY photoid
                  ) AS tags ON p.internalid = tags.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, photoid
                  FROM users_photos_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY photoid
                  ) AS favusers ON p.internalid = favusers.photoid
            WHERE p.internalid = :photo_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photo_internalid" => $photo_internalid,"userid" => $userid]);

    if($row = $stmt->fetch()) {
      return new PhotoEntity($row);
    }
  }

  public function getByBoxid($boxid, $userid=null) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            LEFT JOIN photos_boxes pb ON p.internalid = pb.photoid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, photoid
                  FROM users_photos_favorites
                  GROUP BY photoid
                  ) AS faved ON p.internalid = faved.photoid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, photoid
                  FROM users_photos_favorites
                  WHERE userid = :userid
                  GROUP BY photoid
                  ) AS userfav ON p.internalid = userfav.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, photoid
                  FROM tags_photos AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY photoid
                  ) AS tags ON p.internalid = tags.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, photoid
                  FROM users_photos_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY photoid
                  ) AS favusers ON p.internalid = favusers.photoid
            WHERE pb.boxid = :boxid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["boxid" => $boxid,"userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoEntity($row);
    }
    return $results;
  }

  public function getByNendoroidid($nendoroidid, $userid=null) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            LEFT JOIN photos_nendoroids pn ON p.internalid = pn.photoid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, photoid
                  FROM users_photos_favorites
                  GROUP BY photoid
                  ) AS faved ON p.internalid = faved.photoid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, photoid
                  FROM users_photos_favorites
                  WHERE userid = :userid
                  GROUP BY photoid
                  ) AS userfav ON p.internalid = userfav.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, photoid
                  FROM tags_photos AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY photoid
                  ) AS tags ON p.internalid = tags.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, photoid
                  FROM users_photos_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY photoid
                  ) AS favusers ON p.internalid = favusers.photoid
            WHERE pn.nendoroidid = :nendoroidid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["nendoroidid" => $nendoroidid,"userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoEntity($row);
    }
    return $results;
  }

  public function getByAccessoryid($accessoryid, $userid=null) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            LEFT JOIN photos_accessories pa ON p.internalid = pa.photoid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, photoid
                  FROM users_photos_favorites
                  GROUP BY photoid
                  ) AS faved ON p.internalid = faved.photoid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, photoid
                  FROM users_photos_favorites
                  WHERE userid = :userid
                  GROUP BY photoid
                  ) AS userfav ON p.internalid = userfav.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, photoid
                  FROM tags_photos AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY photoid
                  ) AS tags ON p.internalid = tags.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, photoid
                  FROM users_photos_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY photoid
                  ) AS favusers ON p.internalid = favusers.photoid
            WHERE pa.accessoryid = :accessoryid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["accessoryid" => $accessoryid,"userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoEntity($row);
    }
    return $results;
  }

  public function getByBodypartid($bodypartid, $userid=null) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            LEFT JOIN photos_bodyparts pb ON p.internalid = pb.photoid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, photoid
                  FROM users_photos_favorites
                  GROUP BY photoid
                  ) AS faved ON p.internalid = faved.photoid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, photoid
                  FROM users_photos_favorites
                  WHERE userid = :userid
                  GROUP BY photoid
                  ) AS userfav ON p.internalid = userfav.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, photoid
                  FROM tags_photos AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY photoid
                  ) AS tags ON p.internalid = tags.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, photoid
                  FROM users_photos_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY photoid
                  ) AS favusers ON p.internalid = favusers.photoid
            WHERE pb.bodypartid = :bodypartid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["bodypartid" => $bodypartid,"userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoEntity($row);
    }
    return $results;
  }

  public function getByFaceid($faceid, $userid=null) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            LEFT JOIN photos_faces pf ON p.internalid = pf.photoid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, photoid
                  FROM users_photos_favorites
                  GROUP BY photoid
                  ) AS faved ON p.internalid = faved.photoid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, photoid
                  FROM users_photos_favorites
                  WHERE userid = :userid
                  GROUP BY photoid
                  ) AS userfav ON p.internalid = userfav.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, photoid
                  FROM tags_photos AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY photoid
                  ) AS tags ON p.internalid = tags.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, photoid
                  FROM users_photos_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY photoid
                  ) AS favusers ON p.internalid = favusers.photoid
            WHERE pf.faceid = :faceid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["faceid" => $faceid,"userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoEntity($row);
    }
    return $results;
  }

  public function getByHairid($hairid, $userid=null) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            LEFT JOIN photos_hairs ph ON p.internalid = ph.photoid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, photoid
                  FROM users_photos_favorites
                  GROUP BY photoid
                  ) AS faved ON p.internalid = faved.photoid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, photoid
                  FROM users_photos_favorites
                  WHERE userid = :userid
                  GROUP BY photoid
                  ) AS userfav ON p.internalid = userfav.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, photoid
                  FROM tags_photos AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY photoid
                  ) AS tags ON p.internalid = tags.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, photoid
                  FROM users_photos_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY photoid
                  ) AS favusers ON p.internalid = favusers.photoid
            WHERE ph.hairid = :hairid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["hairid" => $hairid,"userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoEntity($row);
    }
    return $results;
  }

  public function getByHandid($handid, $userid=null) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            LEFT JOIN photos_hands ph ON p.internalid = ph.photoid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, photoid
                  FROM users_photos_favorites
                  GROUP BY photoid
                  ) AS faved ON p.internalid = faved.photoid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, photoid
                  FROM users_photos_favorites
                  WHERE userid = :userid
                  GROUP BY photoid
                  ) AS userfav ON p.internalid = userfav.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, photoid
                  FROM tags_photos AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY photoid
                  ) AS tags ON p.internalid = tags.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, photoid
                  FROM users_photos_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY photoid
                  ) AS favusers ON p.internalid = favusers.photoid
            WHERE ph.handid = :handid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["handid" => $handid,"userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoEntity($row);
    }
    return $results;
  }

  public function getByPhotoid($photoid, $userid=null) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated,
                  faved.numberfavorited, userfav.inuserfavorites, CONCAT('[',favusers.favusers,']') AS favusers,
                  CONCAT('[',tags.tags,']') AS tags
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            LEFT JOIN (
                  SELECT count(*) AS numberfavorited, photoid
                  FROM users_photos_favorites
                  GROUP BY photoid
                  ) AS faved ON p.internalid = faved.photoid
            LEFT JOIN (
                  SELECT count(*) AS inuserfavorites, photoid
                  FROM users_photos_favorites
                  WHERE userid = :userid
                  GROUP BY photoid
                  ) AS userfav ON p.internalid = userfav.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"internalid\":\"',t.internalid,
                                                        '\",\"userid\":\"',t.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',t.additiondate,
                                                        '\",\"grade\":\"',t.grade,
                                                        '\",\"tag\":\"',t.tag,
                                                        '\"}')) AS tags, photoid
                  FROM tags_photos AS t, users AS u
                  WHERE t.userid = u.internalid
                  GROUP BY photoid
                  ) AS tags ON p.internalid = tags.photoid
            LEFT JOIN (
                  SELECT GROUP_CONCAT(CONCAT('{ \"userid\":\"',f.userid,
                                                        '\",\"username\":\"',u.username,
                                                        '\",\"additiondate\":\"',f.additiondate,
                                                        '\"}')) AS favusers, photoid
                  FROM users_photos_favorites AS f, users AS u
                  WHERE f.userid = u.internalid
                  GROUP BY photoid
                  ) AS favusers ON p.internalid = favusers.photoid
            WHERE p.internalid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid,"userid" => $userid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoEntity($row);
    }
    return $results;
  }

  public function addHistory($userid, $elementid, $action, $detail="", $photoid=null) {
    $mapper = new HistoryMapper($this->db);
    $mapper->addElementHistory($userid, null, null,
                               null, null,
                               null, null, null,
                               $elementid, $action, $detail);
    return null;
  }

  public function getHistory($elementid) {
    $mapper = new HistoryMapper($this->db);
    return $mapper->getByElementid($elementid, "photoid");
  }

  public function create(PhotoEntity $photo, $userid) {
    $sql = "INSERT INTO photos
              (userid, title, width, height, uploaded, updated) VALUES
              (:userid, :title, :width, :height, NOW(), NOW())";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "userid" => $userid,
        "title" => $photo->getTitle(),
        "width" => $photo->getWidth(),
        "height" => $photo->getHeight()
      ]);
    if(!$result) {
      throw new Exception("Could not save photo");
    }
    $photoid = $this->db->lastInsertId();
    $this->addHistory($userid,$photoid,"Creation");
    return $this->getByInternalid($photoid);
  }
}
