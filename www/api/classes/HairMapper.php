<?php

class HairMapper extends Mapper
{
  protected $tablename = "hairs";

  public function get() {
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

  public function getByInternalid($hair_internalid) {
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

  public function getByBoxid($boxid) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.main_color, h.other_color, h.haircut, h.description, h.frontback,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate
            FROM hairs h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            WHERE h.boxid = :boxid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["boxid" => $boxid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HairEntity($row);
    }
    return $results;
  }

  public function getByNendoroidid($nendoroidid) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.main_color, h.other_color, h.haircut, h.description, h.frontback,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate
            FROM hairs h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            WHERE h.nendoroidid = :nendoroidid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["nendoroidid" => $nendoroidid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HairEntity($row);
    }
    return $results;
  }

  public function getByHairid($hairid) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.main_color, h.other_color, h.haircut, h.description, h.frontback,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate
            FROM hairs h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            WHERE h.internalid = :hairid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["hairid" => $hairid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HairEntity($row);
    }
    return $results;
  }

  public function getByPhotoid($photoid) {
    $sql = "SELECT h.internalid, h.boxid, h.nendoroidid, h.main_color, h.other_color, h.haircut, h.description, h.frontback,
                  h.creatorid, uc.username AS creatorname, h.creationdate,
                  h.editorid, ue.username AS editorname, h.editiondate,
                  h.validatorid, uv.username AS validatorname, h.validationdate,
                  ph.xmin, ph.xmax, ph.ymin, ph.ymax
            FROM hairs h
            LEFT JOIN users uc ON h.creatorid = uc.internalid
            LEFT JOIN users ue ON h.editorid = ue.internalid
            LEFT JOIN users uv ON h.validatorid = uv.internalid
            LEFT JOIN photos_hairs ph ON h.internalid = ph.hairid
            WHERE ph.photoid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HairEntity($row);
    }
    return $results;
  }
}
