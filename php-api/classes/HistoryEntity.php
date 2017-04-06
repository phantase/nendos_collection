<?php

class HistoryEntity extends Entity implements JsonSerializable
{
  protected $internalid;
  protected $userid;
  protected $boxid;
  protected $nendoroid;
  protected $accessoryid;
  protected $bodypartid;
  protected $faceid;
  protected $hairid;
  protected $handid;
  protected $photoid;
  protected $action;
  protected $actiondate;
  protected $detail;

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

  	$this->userid		= $data['userid'];
  	$this->boxid		= $data['boxid'];
  	$this->nendoroid	= $data['nendoroid'];
  	$this->accessoryid	= $data['accessoryid'];
  	$this->bodypartid	= $data['bodypartid'];
  	$this->faceid		= $data['faceid'];
  	$this->hairid		= $data['hairid'];
  	$this->handid		= $data['handid'];
  	$this->photoid		= $data['photoid'];
  	$this->action		= $data['action'];
  	$this->actiondate	= $data['actiondate'];
  	$this->detail		= $data['detail'];
  }

  public function getInternalid() {
    return $this->internalid;
  }

  public function getUserId() {
    return $this->userid;
  }

  public function getBoxId() {
    return $this->boxid;
  }

  public function getNendoroidId() {
    return $this->nendoroidid;
  }

  public function getAccessoryId() {
    return $this->accessoryid;
  }

  public function getBodypartId() {
    return $this->bodypartid;
  }

  public function getFaceId() {
    return $this->faceid;
  }

  public function getHairId() {
    return $this->hairid;
  }

  public function getHandId() {
    return $this->handid;
  }

  public function getPhotoId() {
    return $this->photoid;
  }

  public function getAction() {
    return $this->action;
  }

  public function getActionDate() {
    return $this->actiondate;
  }

  public function getDetail() {
    return $this->detail;
  }

  public function jsonSerialize() {
    return [
      'internalid' => $this->internalid,
      'userid' => $this->userid,
      'boxid' => $this->boxid,
      'nendoroidid' => $this->nendoroidid,
      'accessoryid' => $this->accessoryid,
      'bodypartid' => $this->bodypartid,
      'faceid' => $this->faceid,
      'hairid' => $this->hairid,
      'handid' => $this->handid,
      'photoid' => $this->photoid,
      'action' => $this->action,
      'actiondate' => $this->actiondate,
      'detail' => $this->detail
    ];
  }

}
