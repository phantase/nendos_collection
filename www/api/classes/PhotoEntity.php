<?php

class PhotoEntity implements JsonSerializable
{
  protected $internalid;
  protected $userid;
  protected $username;
  protected $title;
  protected $width;
  protected $height;
  protected $uploaded;
  protected $updated;

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

    $this->userid = $data['userid'];
    $this->username = $data['username'];
    $this->title = $data['title'];
    $this->width = $data['width'];
    $this->height = $data['height'];
    $this->uploaded = $data['uploaded'];
    $this->updated = $data['updated'];
  }

  public function getInternalid() {
    return $this->internalid;
  }

  public function getUserId() {
    return $this->userid;
  }

  public function getUserName() {
    return $this->username;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getWidth() {
    return $this->width;
  }

  public function getHeight() {
    return $this->height;
  }

  public function getUploaded() {
    return $this->uploaded;
  }

  public function getUpdated() {
    return $this->updated;
  }

  public function jsonSerialize() {
    return [
      'internalid' => $this->internalid,
      'userid' => $this->userid,
      'username' => $this->username,
      'title' => $this->title,
      'width' => $this->width,
      'height' => $this->height,
      'uploaded' => $this->uploaded,
      'updated' => $this->updated,
    ];
  }

}
