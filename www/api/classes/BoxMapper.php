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

}
