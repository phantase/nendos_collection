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

  public function getByAccessoryid($accessoryid) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN accessories a ON n.internalid = a.nendoroidid
            WHERE a.internalid = :accessoryid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["accessoryid" => $accessoryid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

  public function getByBodypartid($bodypartid) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN bodyparts bp ON n.internalid = bp.nendoroidid
            WHERE bp.internalid = :bodypartid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["bodypartid" => $bodypartid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

  public function getByFaceid($faceid) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN faces f ON n.internalid = f.nendoroidid
            WHERE f.internalid = :faceid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["faceid" => $faceid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

  public function getByHairid($hairid) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN hairs h ON n.internalid = h.nendoroidid
            WHERE h.internalid = :hairid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["hairid" => $hairid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

  public function getByHandid($handid) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN hands h ON n.internalid = h.nendoroidid
            WHERE h.internalid = :handid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["handid" => $handid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

  public function getByPhotoid($photoid) {
    $sql = "SELECT n.internalid, n.boxid, n.name, n.version, n.sex, n.dominant_color,
                  n.creatorid, uc.username AS creatorname, n.creationdate,
                  n.editorid, ue.username AS editorname, n.editiondate,
                  n.validatorid, uv.username AS validatorname, n.validationdate
            FROM nendoroids n
            LEFT JOIN users uc ON n.creatorid = uc.internalid
            LEFT JOIN users ue ON n.editorid = ue.internalid
            LEFT JOIN users uv ON n.validatorid = uv.internalid
            LEFT JOIN photos_nendoroids pn ON n.internalid = pn.nendoroidid
            WHERE pn.photoid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new NendoroidEntity($row);
    }
    return $results;
  }

}
