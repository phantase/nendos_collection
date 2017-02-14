<?php

class AccessoryMapper extends Mapper
{

  public function getAccessories() {
    $sql = "SELECT a.internalid, a.boxid, a.nendoroidid, a.type, a.main_color, a.other_color, a.description,
                  a.creatorid, uc.username AS creatorname, a.creationdate,
                  a.editorid, ue.username AS editorname, a.editiondate,
                  a.validatorid, uv.username AS validatorname, a.validationdate
            FROM accessories a
            LEFT JOIN users uc ON a.creatorid = uc.internalid
            LEFT JOIN users ue ON a.editorid = ue.internalid
            LEFT JOIN users uv ON a.validatorid = uv.internalid";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new AccessoryEntity($row);
    }
    return $results;
  }

  public function getAccessoryByInternalid($accessory_internalid) {
    $sql = "SELECT a.internalid, a.boxid, a.nendoroidid, a.type, a.main_color, a.other_color, a.description,
                  a.creatorid, uc.username AS creatorname, a.creationdate,
                  a.editorid, ue.username AS editorname, a.editiondate,
                  a.validatorid, uv.username AS validatorname, a.validationdate
            FROM accessories a
            LEFT JOIN users uc ON a.creatorid = uc.internalid
            LEFT JOIN users ue ON a.editorid = ue.internalid
            LEFT JOIN users uv ON a.validatorid = uv.internalid
            WHERE a.internalid = :accessory_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["accessory_internalid" => $accessory_internalid]);

    if($row = $stmt->fetch()) {
      return new AccessoryEntity($row);
    }
  }

}
