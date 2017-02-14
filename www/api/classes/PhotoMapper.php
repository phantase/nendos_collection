<?php

class PhotoMapper extends Mapper
{
  protected $tablename = "photos";

  public function get() {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoEntity($row);
    }
    return $results;
  }

  public function getByInternalid($photo_internalid) {
    $sql = "SELECT p.internalid, p.userid, u.username, p.title, p.width, p.height, p.uploaded, p.updated
            FROM photos p
            LEFT JOIN users u ON p.userid = u.internalid
            WHERE p.internalid = :photo_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["photo_internalid" => $photo_internalid]);

    if($row = $stmt->fetch()) {
      return new PhotoEntity($row);
    }
  }

}
