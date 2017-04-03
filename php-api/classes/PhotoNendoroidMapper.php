<?php

class PhotoNendoroidMapper extends Mapper
{
  protected $tablename = "photos_nendoroids";

  public function get() {
    $sql = "SELECT p.internalid, p.photoid, p.nendoroidid AS elementid, p.userid, p.xmin, p.ymin, p.xmax, p.ymax
            FROM photos_nendoroids p";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new PhotoElementEntity($row);
    }
    return $results;
  }

  public function getByInternalid($internalid) {
    $sql = "SELECT p.internalid, p.photoid, p.nendoroidid AS elementid, p.userid, p.xmin, p.ymin, p.xmax, p.ymax
            FROM photos_nendoroids p
            WHERE p.internalid = :internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["internalid" => $internalid]);

    if ($row = $stmt->fetch()) {
      return new PhotoElementEntity($row);
    }
  }

  public function addHistory($userid, $elementid, $action, $detail="", $photoid) {
    $elementmapper = new NendoroidMapper($this->db);
    $element = $elementmapper->getByInternalid($elementid);

    $mapper = new HistoryMapper($this->db);
    $mapper->addElementHistory($userid, $element->getBoxId(), $elementid,
                               null, null,
                               null, null, null,
                               $photoid, $action, $detail);
    return null;
  }

  public function create(PhotoElementEntity $photoelement, $userid) {
    $sql = "INSERT INTO photos_nendoroids
              (photoid, nendoroidid, userid, xmin, ymin, xmax, ymax) VALUES
              (:photoid, :elementid, :userid, :xmin, :ymin, :xmax, :ymax)";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "photoid" => $photoelement->getPhotoId(),
        "elementid" => $photoelement->getElementId(),
        "userid" => $userid,
        "xmin" => $photoelement->getXmin(),
        "ymin" => $photoelement->getYmin(),
        "xmax" => $photoelement->getXmax(),
        "ymax" => $photoelement->getYmax()
      ]);
    if(!$result) {
      throw new Exception("Could not save element photo association");
    }
    $photoelementid = $this->db->lastInsertId();
    $this->addHistory($userid, $photoelement->getElementId(), "Addition", "Nendoroid (".$photoelement->getElementId().") has been added to photo", $photoelement->getPhotoId());
    return $this->getByInternalid($photoelementid);
  }

}
