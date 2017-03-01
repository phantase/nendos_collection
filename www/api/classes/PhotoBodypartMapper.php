<?php

class PhotoBodypartMapper extends Mapper
{
  protected $tablename = "photos_bodyparts";

  public function get() {
    $sql = "SELECT p.internalid, p.photoid, p.bodypartid AS elementid, p.xmin, p.ymin, p.xmax, p.ymax
            FROM photos_bodyparts p";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoElementEntity($row);
    }
    return $results;
  }

}
