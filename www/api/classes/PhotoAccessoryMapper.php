<?php

class PhotoAccessoryMapper extends Mapper
{
  protected $tablename = "photos_accessories";

  public function get() {
    $sql = "SELECT p.internalid, p.photoid, p.accessoryid AS elementid, p.xmin, p.ymin, p.xmax, p.ymax
            FROM photos_accessories p";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoElementEntity($row);
    }
    return $results;
  }

}
