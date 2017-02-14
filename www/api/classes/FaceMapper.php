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

}
