<?php

class PhotoMapper extends Mapper
{
  protected $tablename = "photos";

  public function get() {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoEntity($row);
    }
    return $results;
  }

  public function getByInternalid($photo_internalid) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            WHERE p.internalid = :photo_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photo_internalid" => $photo_internalid]);

    if($row = $stmt->fetch()) {
      return new PhotoEntity($row);
    }
  }

  public function getByBoxid($boxid) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            LEFT JOIN photos_boxes pb ON p.internalid = pb.photoid
            WHERE pb.boxid = :boxid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["boxid" => $boxid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoEntity($row);
    }
    return $results;
  }

  public function getByNendoroidid($nendoroidid) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            LEFT JOIN photos_nendoroids pn ON p.internalid = pn.photoid
            WHERE pn.nendoroidid = :nendoroidid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["nendoroidid" => $nendoroidid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoEntity($row);
    }
    return $results;
  }

  public function getByAccessoryid($accessoryid) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            LEFT JOIN photos_accessories pa ON p.internalid = pa.photoid
            WHERE pa.accessoryid = :accessoryid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["accessoryid" => $accessoryid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoEntity($row);
    }
    return $results;
  }

  public function getByBodypartid($bodypartid) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            LEFT JOIN photos_bodyparts pb ON p.internalid = pb.photoid
            WHERE pb.bodypartid = :bodypartid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["bodypartid" => $bodypartid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoEntity($row);
    }
    return $results;
  }

  public function getByFaceid($faceid) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            LEFT JOIN photos_faces pf ON p.internalid = pf.photoid
            WHERE pf.faceid = :faceid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["faceid" => $faceid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoEntity($row);
    }
    return $results;
  }

  public function getByHairid($hairid) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            LEFT JOIN photos_hairs ph ON p.internalid = ph.photoid
            WHERE ph.hairid = :hairid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["hairid" => $hairid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoEntity($row);
    }
    return $results;
  }

  public function getByHandid($handid) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            LEFT JOIN photos_hands ph ON p.internalid = ph.photoid
            WHERE ph.handid = :handid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["handid" => $handid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoEntity($row);
    }
    return $results;
  }

  public function getByPhotoid($photoid) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            WHERE p.internalid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid]);

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
