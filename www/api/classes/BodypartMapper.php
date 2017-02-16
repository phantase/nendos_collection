<?php

class BodypartMapper extends Mapper
{
  protected $tablename = "bodyparts";

  public function get() {
    $sql = "SELECT bp.internalid, bp.boxid, bp.nendoroidid, bp.part, bp.main_color, bp.other_color, bp.description,
                  bp.creatorid, uc.username AS creatorname, bp.creationdate,
                  bp.editorid, ue.username AS editorname, bp.editiondate,
                  bp.validatorid, uv.username AS validatorname, bp.validationdate
            FROM bodyparts bp
            LEFT JOIN users uc ON bp.creatorid = uc.internalid
            LEFT JOIN users ue ON bp.editorid = ue.internalid
            LEFT JOIN users uv ON bp.validatorid = uv.internalid";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BodypartEntity($row);
    }
    return $results;
  }

  public function getByInternalid($bodypart_internalid) {
    $sql = "SELECT bp.internalid, bp.boxid, bp.nendoroidid, bp.part, bp.main_color, bp.other_color, bp.description,
                  bp.creatorid, uc.username AS creatorname, bp.creationdate,
                  bp.editorid, ue.username AS editorname, bp.editiondate,
                  bp.validatorid, uv.username AS validatorname, bp.validationdate
            FROM bodyparts bp
            LEFT JOIN users uc ON bp.creatorid = uc.internalid
            LEFT JOIN users ue ON bp.editorid = ue.internalid
            LEFT JOIN users uv ON bp.validatorid = uv.internalid
            WHERE bp.internalid = :bodypart_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["bodypart_internalid" => $bodypart_internalid]);

    if($row = $stmt->fetch()) {
      return new BodypartEntity($row);
    }
  }

  public function getByBoxid($boxid) {
    $sql = "SELECT bp.internalid, bp.boxid, bp.nendoroidid, bp.part, bp.main_color, bp.other_color, bp.description,
                  bp.creatorid, uc.username AS creatorname, bp.creationdate,
                  bp.editorid, ue.username AS editorname, bp.editiondate,
                  bp.validatorid, uv.username AS validatorname, bp.validationdate
            FROM bodyparts bp
            LEFT JOIN users uc ON bp.creatorid = uc.internalid
            LEFT JOIN users ue ON bp.editorid = ue.internalid
            LEFT JOIN users uv ON bp.validatorid = uv.internalid
            WHERE bp.boxid = :boxid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["boxid" => $boxid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BodypartEntity($row);
    }
    return $results;
  }

  public function getByNendoroidid($nendoroidid) {
    $sql = "SELECT bp.internalid, bp.boxid, bp.nendoroidid, bp.part, bp.main_color, bp.other_color, bp.description,
                  bp.creatorid, uc.username AS creatorname, bp.creationdate,
                  bp.editorid, ue.username AS editorname, bp.editiondate,
                  bp.validatorid, uv.username AS validatorname, bp.validationdate
            FROM bodyparts bp
            LEFT JOIN users uc ON bp.creatorid = uc.internalid
            LEFT JOIN users ue ON bp.editorid = ue.internalid
            LEFT JOIN users uv ON bp.validatorid = uv.internalid
            WHERE bp.nendoroidid = :nendoroidid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["nendoroidid" => $nendoroidid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BodypartEntity($row);
    }
    return $results;
  }

  public function getByAccessoryid($accessoryid) {
    return null;
  }

  public function getByBodypartid($bodypartid) {
    $sql = "SELECT bp.internalid, bp.boxid, bp.nendoroidid, bp.part, bp.main_color, bp.other_color, bp.description,
                  bp.creatorid, uc.username AS creatorname, bp.creationdate,
                  bp.editorid, ue.username AS editorname, bp.editiondate,
                  bp.validatorid, uv.username AS validatorname, bp.validationdate
            FROM bodyparts bp
            LEFT JOIN users uc ON bp.creatorid = uc.internalid
            LEFT JOIN users ue ON bp.editorid = ue.internalid
            LEFT JOIN users uv ON bp.validatorid = uv.internalid
            WHERE bp.internalid = :bodypartid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["bodypartid" => $bodypartid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BodypartEntity($row);
    }
    return $results;
  }

  public function getByFaceid($faceid) {
    return null;
  }

  public function getByHairid($hairid) {
    return null;
  }

  public function getByHandid($handid) {
    return null;
  }

  public function getByPhotoid($photoid) {
    $sql = "SELECT bp.internalid, bp.boxid, bp.nendoroidid, bp.part, bp.main_color, bp.other_color, bp.description,
                  bp.creatorid, uc.username AS creatorname, bp.creationdate,
                  bp.editorid, ue.username AS editorname, bp.editiondate,
                  bp.validatorid, uv.username AS validatorname, bp.validationdate
            FROM bodyparts bp
            LEFT JOIN users uc ON bp.creatorid = uc.internalid
            LEFT JOIN users ue ON bp.editorid = ue.internalid
            LEFT JOIN users uv ON bp.validatorid = uv.internalid
            LEFT JOIN photos_bodyparts pb ON bp.internalid = pb.bodypartid
            WHERE pb.photoid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BodypartEntity($row);
    }
    return $results;
  }

}
