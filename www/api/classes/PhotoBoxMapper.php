<?php

class PhotoBoxMapper extends Mapper
{
  protected $tablename = "photos_boxes";

  public function get() {
    $sql = "SELECT p.internalid, p.photoid, p.boxid AS elementid, p.xmin, p.ymin, p.xmax, p.ymax
            FROM photos_boxes p";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoElementEntity($row);
    }
    return $results;
  }

}
