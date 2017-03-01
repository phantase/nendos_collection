<?php

class PhotoFaceMapper extends Mapper
{
  protected $tablename = "photos_faces";

  public function get() {
    $sql = "SELECT p.internalid, p.photoid, p.faceid AS elementid, p.xmin, p.ymin, p.xmax, p.ymax
            FROM photos_faces p";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoElementEntity($row);
    }
    return $results;
  }

}
