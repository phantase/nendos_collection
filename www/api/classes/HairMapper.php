<?php

class HairMapper extends Mapper
{

  public function getHairs() {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.main_color, h.other_color, h.haircut, h.description, h.frontback,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate
            FROM hairs h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HairEntity($row);
    }
    return $results;
  }

  public function getHairByInternalid($hair_internalid) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.main_color, h.other_color, h.haircut, h.description, h.frontback,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate
            FROM hairs h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            WHERE h.internalid = :hair_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["hair_internalid" => $hair_internalid]);

    if($row = $stmt->fetch()) {
      return new HairEntity($row);
    }
  }

}
