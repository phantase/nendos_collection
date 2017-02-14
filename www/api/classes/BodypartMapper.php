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

}
