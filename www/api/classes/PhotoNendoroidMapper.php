<?php

class PhotoNendoroidMapper extends Mapper
{
  protected $tablename = "photos_nendoroids";

  public function get() {
    $sql = "SELECT p.internalid, p.photoid, p.nendoroidid AS elementid, p.xmin, p.ymin, p.xmax, p.ymax
            FROM photos_nendoroids p";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoElementEntity($row);
    }
    return $results;
  }

}
