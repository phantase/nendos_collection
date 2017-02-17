<?php

class FaceMapper extends Mapper
{
  protected $tablename = "faces";

  public function get() {
    $sql = "SELECT f.internalid, f.boxid, f.nendoroidid, f.eyes, f.eyes_color, f.mouth, f.skin_color, f.sex,
                  f.creatorid, uc.username AS creatorname, f.creationdate,
                  f.editorid, ue.username AS editorname, f.editiondate,
                  f.validatorid, uv.username AS validatorname, f.validationdate
            FROM faces f
            LEFT JOIN users uc ON f.creatorid = uc.internalid
            LEFT JOIN users ue ON f.editorid = ue.internalid
            LEFT JOIN users uv ON f.validatorid = uv.internalid";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new FaceEntity($row);
    }
    return $results;
  }

  public function getByInternalid($face_internalid) {
    $sql = "SELECT f.internalid, f.boxid, f.nendoroidid, f.eyes, f.eyes_color, f.mouth, f.skin_color, f.sex,
                  f.creatorid, uc.username AS creatorname, f.creationdate,
                  f.editorid, ue.username AS editorname, f.editiondate,
                  f.validatorid, uv.username AS validatorname, f.validationdate
            FROM faces f
            LEFT JOIN users uc ON f.creatorid = uc.internalid
            LEFT JOIN users ue ON f.editorid = ue.internalid
            LEFT JOIN users uv ON f.validatorid = uv.internalid
            WHERE f.internalid = :face_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["face_internalid" => $face_internalid]);

    if($row = $stmt->fetch()) {
      return new FaceEntity($row);
    }
  }

  public function getByBoxid($boxid) {
    $sql = "SELECT f.internalid, f.boxid, f.nendoroidid, f.eyes, f.eyes_color, f.mouth, f.skin_color, f.sex,
                  f.creatorid, uc.username AS creatorname, f.creationdate,
                  f.editorid, ue.username AS editorname, f.editiondate,
                  f.validatorid, uv.username AS validatorname, f.validationdate
            FROM faces f
            LEFT JOIN users uc ON f.creatorid = uc.internalid
            LEFT JOIN users ue ON f.editorid = ue.internalid
            LEFT JOIN users uv ON f.validatorid = uv.internalid
            WHERE f.boxid = :boxid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["boxid" => $boxid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new FaceEntity($row);
    }
    return $results;
  }

  public function getByNendoroidid($nendoroidid) {
    $sql = "SELECT f.internalid, f.boxid, f.nendoroidid, f.eyes, f.eyes_color, f.mouth, f.skin_color, f.sex,
                  f.creatorid, uc.username AS creatorname, f.creationdate,
                  f.editorid, ue.username AS editorname, f.editiondate,
                  f.validatorid, uv.username AS validatorname, f.validationdate
            FROM faces f
            LEFT JOIN users uc ON f.creatorid = uc.internalid
            LEFT JOIN users ue ON f.editorid = ue.internalid
            LEFT JOIN users uv ON f.validatorid = uv.internalid
            WHERE f.nendoroidid = :nendoroidid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["nendoroidid" => $nendoroidid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new FaceEntity($row);
    }
    return $results;
  }

  public function getByFaceid($faceid) {
    $sql = "SELECT f.internalid, f.boxid, f.nendoroidid, f.eyes, f.eyes_color, f.mouth, f.skin_color, f.sex,
                  f.creatorid, uc.username AS creatorname, f.creationdate,
                  f.editorid, ue.username AS editorname, f.editiondate,
                  f.validatorid, uv.username AS validatorname, f.validationdate
            FROM faces f
            LEFT JOIN users uc ON f.creatorid = uc.internalid
            LEFT JOIN users ue ON f.editorid = ue.internalid
            LEFT JOIN users uv ON f.validatorid = uv.internalid
            WHERE f.internalid = :faceid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["faceid" => $faceid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new FaceEntity($row);
    }
    return $results;
  }

  public function getByPhotoid($photoid) {
    $sql = "SELECT f.internalid, f.boxid, f.nendoroidid, f.eyes, f.eyes_color, f.mouth, f.skin_color, f.sex,
                  f.creatorid, uc.username AS creatorname, f.creationdate,
                  f.editorid, ue.username AS editorname, f.editiondate,
                  f.validatorid, uv.username AS validatorname, f.validationdate,
                  pf.xmin, pf.xmax, pf.ymin, pf.ymax
            FROM faces f
            LEFT JOIN users uc ON f.creatorid = uc.internalid
            LEFT JOIN users ue ON f.editorid = ue.internalid
            LEFT JOIN users uv ON f.validatorid = uv.internalid
            LEFT JOIN photos_faces pf ON f.internalid = pf.faceid
            WHERE pf.photoid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new FaceEntity($row);
    }
    return $results;
  }
}
