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

}
