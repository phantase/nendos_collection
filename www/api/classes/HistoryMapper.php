<?php

class HistoryMapper extends Mapper
{
  protected $tablename = "history";

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
