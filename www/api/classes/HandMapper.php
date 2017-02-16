<?php

class HandMapper extends Mapper
{
  protected $tablename = "hands";

  public function get() {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.skin_color, h.leftright, h.posture, h.description,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate
            FROM hands h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HandEntity($row);
    }
    return $results;
  }

  public function getByInternalid($hand_internalid) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.skin_color, h.leftright, h.posture, h.description,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate
            FROM hands h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            WHERE h.internalid = :hand_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["hand_internalid" => $hand_internalid]);

    if($row = $stmt->fetch()) {
      return new HandEntity($row);
    }
  }

  public function getByBoxid($boxid) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.skin_color, h.leftright, h.posture, h.description,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate
            FROM hands h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            WHERE h.boxid = :boxid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["boxid" => $boxid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HandEntity($row);
    }
    return $results;
  }

  public function getByNendoroidid($nendoroidid) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.skin_color, h.leftright, h.posture, h.description,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate
            FROM hands h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            WHERE h.nendoroidid = :nendoroidid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["nendoroidid" => $nendoroidid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HandEntity($row);
    }
    return $results;
  }

}
