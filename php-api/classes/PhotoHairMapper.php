<?php

class PhotoHairMapper extends Mapper
{
  protected $tablename = "photos_hairs";

  public function get() {
    $sql = "SELECT p.internalid, p.photoid, p.hairid AS elementid, p.xmin, p.ymin, p.xmax, p.ymax
            FROM photos_hairs p";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoElementEntity($row);
    }
    return $results;
  }

}
