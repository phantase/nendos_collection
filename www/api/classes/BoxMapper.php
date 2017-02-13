<?php

class BoxMapper extends Mapper
{

  public function getBoxes() {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category FROM boxes b";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new BoxEntity($row);
    }
    return $results;
  }

  public function getBoxByInternalid($box_internalid) {
    $sql = "SELECT b.internalid, b.number, b.name, b.series, b.manufacturer, b.category FROM boxes b WHERE b.internalid = :box_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["box_internalid" => $box_internalid]);

    if($result) {
      return new BoxEntity($stmt->fetch());
    }
  }

}
