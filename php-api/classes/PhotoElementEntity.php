<?php

class PhotoElementEntity implements JsonSerializable
{
  protected $internalid;
  protected $photoid;
  protected $elementid;
  protected $userid;
  protected $xmin;
  protected $ymin;
  protected $xmax;
  protected $ymax;

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

    $this->photoid = $data['photoid'];
    $this->elementid = $data['elementid'];
    $this->userid = $data['userid'];
    $this->xmin = $data['xmin'];
    $this->xmax = $data['xmax'];
    $this->ymin = $data['ymin'];
    $this->ymax = $data['ymax'];
  }

  public function getInternalid() {
    return $this->internalid;
  }

  public function getPhotoId() {
    return $this->photoid;
  }

  public function getElementId() {
    return $this->elementid;
  }

  public function getUserId() {
    return $this->userid;
  }

  public function getXmin() {
    return $this->xmin;
  }

  public function getXmax() {
    return $this->xmax;
  }

  public function getYmin() {
    return $this->ymin;
  }

  public function getYmax() {
    return $this->ymax;
  }

  public function jsonSerialize() {
    return [
      'photoannotationid' => $this->internalid,
      'photoid' => $this->photoid,
      'elementid' => $this->elementid,
      'userid' => $this->userid,
      'xmin' => $this->xmin,
      'xmax' => $this->xmax,
      'ymin' => $this->ymin,
      'ymax' => $this->ymax
    ];
  }

}
