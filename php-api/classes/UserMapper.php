<?php

class UserMapper extends Mapper
{
  protected $tablename = "users";

  public function get() {
    $sql = "SELECT u.internalid, u.usermail, u.username, u.administrator, u.validator, u.editor, u.signupdate, u.lastviewdate, u.haspicture
            FROM users u";
    $stmt = $this->db->query($sql);

    $results = [];
    while ($row = $stmt->fetch()) {
      $results[] = new UserEntity($row);
    }
    return $results;
  }

  public function getByInternalid($user_internalid) {
    $sql = "SELECT u.internalid, u.usermail, u.username, u.administrator, u.validator, u.editor, u.signupdate, u.lastviewdate, u.haspicture
            FROM users u
            WHERE u.internalid = :user_internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["user_internalid" => $user_internalid]);

    if($row = $stmt->fetch()) {
      return new UserEntity($row);
    }
  }

  public function getByUsermail($usermail) {
    $sql = "SELECT u.internalid, u.usermail, u.username, u.administrator, u.validator, u.editor, u.signupdate, u.lastviewdate, u.haspicture
            FROM users u
            WHERE u.usermail = :usermail";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["usermail" => $usermail]);

    if($row = $stmt->fetch()) {
      return new UserEntity($row);
    }
  }

  public function checkUser($usermail,$encpass) {
    $sql = "SELECT u.internalid, u.usermail, u.username, u.administrator, u.validator, u.editor, u.signupdate, u.lastviewdate, u.haspicture
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

  public function checkUserStaged($usermail) {
    $sql = "SELECT us.internalid, us.usermail, us.username, us.encpass, us.registrationdate, us.registrationcode
            FROM usersstaged us
            WHERE us.usermail = :usermail";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["usermail" => $usermail]);
    if($row = $stmt->fetch()) {
      return $row['registrationcode'];
    }
  }

  public function createUserStaged($usermail, $username, $encpass) {
    $registrationcode = md5($usermail.$username.$encpass.time());
    $sql = "INSERT INTO usersstaged
              (usermail, username, encpass, registrationcode) VALUES
              (:usermail, :username, :encpass, :registrationcode)";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "usermail" => $usermail,
        "username" => $username,
        "encpass" => $encpass,
        "registrationcode" => $registrationcode
      ]);
    if(!$result) {
      throw new Exception("Could not create a userstaged");
    }
    $userstagedid = $this->db->lastInsertId();
    return $registrationcode;
  }

  public function confirmUser($usermail, $registrationcode) {
    // Check if usermail and registrationcode match
    $sql = "SELECT us.internalid, us.usermail, us.username, us.encpass, us.registrationdate, us.registrationcode
            FROM usersstaged us
            WHERE us.usermail = :usermail
            AND us.registrationcode = :registrationcode";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["usermail" => $usermail, "registrationcode" => $registrationcode]);
    if($row = $stmt->fetch()) {
      // Yes, they match, now add the user to the normal users table (so really create the user)
      $sql = "INSERT INTO users
                (usermail, username, encpass, signupdate) VALUES
                (:usermail, :username, :encpass, :registrationdate)";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute([
          "usermail" => $row['usermail'],
          "username" => $row['username'],
          "encpass" => $row['encpass'],
          "registrationdate" => $row['registrationdate']
        ]);
      if(!$result) {
        throw new Exception("Could not create a user");
      }
      $userid = $this->db->lastInsertId();
      // Remove the userstaged
      $sql = "DELETE FROM usersstaged WHERE internalid = :internalid";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute([
          "internalid" => $row['internalid']
        ]);
      if(!$result) {
        throw new Exception("Cannot remove the staged user, but the normal user must be created");
      }
      // Finally, returns the created user
      return $this->getByInternalid($userid);
    }
  }

  public function checkUserStagedForgot($usermail) {
    $sql = "SELECT usf.internalid, usf.userid, usf.usermail, usf.requestdate, usf.requestcode
            FROM usersstagedforgot usf
            WHERE usf.usermail = :usermail";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["usermail" => $usermail]);
    if($row = $stmt->fetch()) {
      return $row['requestcode'];
    }
  }

  public function createUserStagedForgot($userid, $usermail) {
    $requestcode = md5($usermail.time());
    $sql = "INSERT INTO usersstagedforgot
                     (userid, usermail, requestcode) VALUES
                     (:userid, :usermail, :requestcode)";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "userid" => $userid,
        "usermail" => $usermail,
        "requestcode" => $requestcode
      ]);
    $userstagedforgotid = $this->db->lastInsertId();
    return $requestcode;
  }

  public function confirmUserForgot($usermail, $requestcode, $encpass) {
    // Check if usermail and requestcode match
    $sql = "SELECT usf.internalid, usf.userid, usf.usermail, usf.requestdate, usf.requestcode
            FROM usersstagedforgot usf
            WHERE usf.usermail = :usermail
            AND usf.requestcode = :requestcode";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(["usermail" => $usermail, "requestcode" => $requestcode]);
    if($row = $stmt->fetch()) {
      // Yes, they match, so create a new password to the user and send it to him
      $sql = "UPDATE users
                 SET encpass = :encpass
               WHERE internalid = :userid";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute([
          "userid" => $row['userid'],
          "encpass" => $encpass
        ]);
      if(!$result) {
        throw new Exception("Could not update user");
      }
      // Remove the userstaged
      $sql = "DELETE FROM usersstagedforgot WHERE internalid = :internalid";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute([
          "internalid" => $row['internalid']
        ]);
      if(!$result) {
        throw new Exception("Cannot remove the staged user (forgot), but the user's password must have been updagted");
      }
      // Finally, true...
      return true;
    }
    return false;
  }

  public function addPicture($user_internalid, $userid) {
    $sql = "UPDATE users SET
              haspicture = 1
            WHERE internalid = :internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "internalid" => $user_internalid
      ]);
    if(!$result) {
      throw new Exception("Could not update user");
    }
    $this->addHistory($userid, $user_internalid, "Update", "Picture has been updated");
  }

  public function update($usermail, $username, $encpass, $userid) {
    $sql = "UPDATE users SET
              usermail = :usermail,
              username = :username,
              encpass = :encpass
            WHERE internalid = :internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "internalid" => $userid,
        "usermail" => $usermail,
        "username" => $username,
        "encpass" => $encpass
      ]);
    if(!$result) {
      throw new Exception("Could not update user");
    }
    return $this->getByInternalid($userid);
  }

  public function updateRights($administrator, $validator, $editor, $userid) {
    $sql = "UPDATE users SET
              administrator = :administrator,
              validator = :validator,
              editor = :editor
            WHERE internalid = :internalid";
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute([
        "internalid" => $userid,
        "administrator" => $administrator,
        "validator" => $validator,
        "editor" => $editor
      ]);
    if(!$result) {
      throw new Exception("Could not update user");
    }
    return $this->getByInternalid($userid);
  }
}
