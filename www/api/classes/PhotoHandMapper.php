<?php

class PhotoHandMapper extends Mapper
{
  protected $tablename = "photos_hands";

  public function get() {
    $sql = "SELECT p.internalid, p.photoid, p.handid AS elementid, p.xmin, p.ymin, p.xmax, p.ymax
            FROM photos_hands p";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoElementEntity($row);
    }
    return $results;
  }

}
