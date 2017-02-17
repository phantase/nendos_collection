<?php

class BoxMapper extends Mapper
{
  protected $tablename = "boxes";

  public function get() {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

  public function getByInternalid($box_internalid) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            WHERE b.internalid = :box_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["box_internalid" => $box_internalid]);

    if($row = $stmt->fetch()) {
      return new BoxEntity($row);
    }
  }

  public function getByBoxid($boxid) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            WHERE b.internalid = :boxid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["boxid" => $boxid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

  public function getByNendoroidid($nendoroidid) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            LEFT JOIN nendoroids n ON b.internalid = n.boxid
            WHERE n.internalid = :nendoroidid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["nendoroidid" => $nendoroidid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

  public function getByAccessoryid($accessoryid) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            LEFT JOIN accessories a ON b.internalid = a.boxid
            WHERE a.internalid = :accessoryid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["accessoryid" => $accessoryid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

  public function getByBodypartid($bodypartid) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            LEFT JOIN bodyparts bp ON b.internalid = bp.boxid
            WHERE bp.internalid = :bodypartid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["bodypartid" => $bodypartid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

  public function getByFaceid($faceid) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            LEFT JOIN faces f ON b.internalid = f.boxid
            WHERE f.internalid = :faceid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["faceid" => $faceid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

  public function getByHairid($hairid) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            LEFT JOIN hairs h ON b.internalid = h.boxid
            WHERE h.internalid = :hairid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["hairid" => $hairid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

  public function getByHandid($handid) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            LEFT JOIN hands h ON b.internalid = h.boxid
            WHERE h.internalid = :handid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["handid" => $handid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

  public function getByPhotoid($photoid) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category,
                  b.price, b.releasedate, b.specifications, b.sculptor, b.cooperation, b.officialurl,
                  b.creatorid, uc.username AS creatorname, b.creationdate,
                  b.editorid, ue.username AS editorname, b.editiondate,
                  b.validatorid, uv.username AS validatorname, b.validationdate,
                  pb.xmin, pb.xmax, pb.ymin, pb.ymax
            FROM boxes b
            LEFT JOIN users uc ON b.creatorid = uc.internalid
            LEFT JOIN users ue ON b.editorid = ue.internalid
            LEFT JOIN users uv ON b.validatorid = uv.internalid
            LEFT JOIN photos_boxes pb ON b.internalid = pb.boxid
            WHERE pb.photoid = :photoid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photoid" => $photoid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

}
