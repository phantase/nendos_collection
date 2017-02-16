<?php

class NendoroidMapper extends Mapper
{
  protected $tablename = "nendoroids";

  public function get() {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

  public function getByInternalid($nendoroid_internalid) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            WHERE n.internalid = :nendoroid_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["nendoroid_internalid" => $nendoroid_internalid]);

    if($row = $stmt->fetch()) {
      return new NendoroidEntity($row);
    }
  }

  public function getByBoxid($boxid) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            WHERE n.boxid = :boxid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["boxid" => $boxid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

  public function getByNendoroidid($nendoroidid) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            WHERE n.internalid = :nendoroidid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["nendoroidid" => $nendoroidid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

}
