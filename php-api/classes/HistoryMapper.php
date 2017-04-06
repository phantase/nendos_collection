<?php

class HistoryMapper extends Mapper
{
  protected $tablename = "history";

  public function getByElementid($elementid, $filterfield) {
    // I trust the elementtype
    $sql = "SELECT h.internalid, h.userid, h.boxid, h.nendoroidid, h.accessoryid, h.bodypartid, h.faceid,
                  h.hairid, h.handid, h.photoid, h.action, h.actiondate, h.detail
            FROM history h
            WHERE $filterfield = :elementid
            ORDER BY actiondate DESC";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["elementid" => $elementid]);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new HistoryEntity($row);
    }
    return $results;
  }

  public function addElementHistory($userid, $boxid, $nendoroidid, $accessoryid, $bodypartid, $faceid, $hairid, $handid, $photoid, $action, $detail) {
    $sql = "INSERT INTO history(userid,boxid,nendoroidid,
                                accessoryid,bodypartid,faceid,hairid,handid,
                                photoid,action,actiondate,detail)
            VALUES(:userid,:boxid,:nendoroidid,
                  :accessoryid,:bodypartid,:faceid,:hairid,:handid,
                  :photoid,:action,NOW(),:detail)";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["userid" => $userid,
                              "boxid" => $boxid,
                              "nendoroidid" => $nendoroidid,
                              "accessoryid" => $accessoryid,
                              "bodypartid" => $bodypartid,
                              "faceid" => $faceid,
                              "hairid" => $hairid,
                              "handid" => $handid,
                              "photoid" => $photoid,
                              "action" => $action,
                              "detail" => $detail
                              ]);
  }

}
