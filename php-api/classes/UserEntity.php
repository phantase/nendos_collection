<?php

class UserEntity implements JsonSerializable
{
  protected $internalid;
  protected $usermail;
  protected $username;
  protected $administrator;
  protected $validator;
  protected $editor;
  protected $signupdate;
  protected $lastviewdate;
  /**
   *
   *
   * @param  array $data The data to use to create
   */
  public function __construct(array $data) {
    // no internalid if we're creating
    if(isset($data['internalid'])) {
      $this->internalid = $data['internalid'];
    }
    $this->usermail = $data['usermail'];
    $this->username = $data['username'];
    $this->administrator = $data['administrator'];
    $this->validator = $data['validator'];
    $this->editor = $data['editor'];
    $this->signupdate = $data['signupdate'];
    $this->lastviewdate = $data['lastviewdate'];
  }

  public function getInternalid() {
    return $this->internalid;
  }

  public function getUsermail() {
    return $this->usermail;
  }

  public function getUsername() {
    return $this->username;
  }

  public function getAdministror() {
    return $this->administrator;
  }

  public function getValidator() {
    return $this->validator;
  }

  public function getEditor() {
    return $this->editor;
  }

  public function getSignUpDate() {
    return $this->signupdate;
  }

  public function getLastViewDate() {
    return $this->lastviewdate;
  }

  public function jsonSerialize() {
    return [
      'internalid' => $this->internalid,
      'usermail' => $this->usermail,
      'username' => $this->username,
      'administrator' => $this->administrator,
      'validator' => $this->validator,
      'editor' => $this->editor,
      'signupdate' => $this->signupdate,
      'lastviewdate' => $this->lastviewdate
    ];
  }
}
