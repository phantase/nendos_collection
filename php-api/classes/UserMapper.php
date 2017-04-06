<?php

class UserMapper extends Mapper
{
  protected $tablename = "users";

  public function get() {
    $sql = "SELECT u.internalid, u.usermail, u.username, u.administrator, u.validator, u.editor, u.signupdate, u.lastviewdate
            FROM users u";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new UserEntity($row);
    }
    return $results;
  }

  public function getByInternalid($user_internalid) {
    $sql = "SELECT u.internalid, u.usermail, u.username, u.administrator, u.validator, u.editor, u.signupdate, u.lastviewdate
            FROM users u
            WHERE u.internalid = :user_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["user_internalid" => $user_internalid]);

    if($row = $stmt->fetch()) {
      return new UserEntity($row);
    }
  }

  public function checkUser($usermail,$encpass) {
    $sql = "SELECT u.internalid, u.usermail, u.username, u.administrator, u.validator, u.editor, u.signupdate, u.lastviewdate
            FROM users u
            WHERE u.usermail = :usermail
            AND u.encpass = :encpass";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["usermail" => $usermail, "encpass" => $encpass]);

    if($row = $stmt->fetch()) {
      return new UserEntity($row);
    }
  }

  public function updateUserLastViewDate($user_internalid) {
    $sql = "UPDATE users SET lastviewdate = NOW() WHERE internalid = :user_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["user_internalid" => $user_internalid]);

    if(!$result) {
      throw new Exception("Could not update date");
    }
  }

  public function addHistory($userid, $elementid, $action, $detail="", $photoid=null) {
    $mapper = new HistoryMapper($this->db);
    $mapper->addElementHistory($userid, null, null,
                               null, null,
                               null, null, null,
                               $photoid, $action, $detail);
    return null;
  }

  public function getHistory($elementid) {
    $mapper = new HistoryMapper($this->db);
    return $mapper->getByElementid($elementid, "userid");
  }

}
