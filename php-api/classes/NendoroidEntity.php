<?php

class NendoroidEntity extends Entity implements JsonSerializable
{
  protected $internalid;
  protected $boxid;
  protected $name;
  protected $version;
  protected $sex;
  protected $dominant_color;
  // Complementary information
  protected $creatorid;
  protected $creatorname;
  protected $creationdate;
  protected $editorid;
  protected $editorname;
  protected $editiondate;
  protected $validatorid;
  protected $validatorname;
  protected $validationdate;
  protected $nbpictures;

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

    $this->boxid = $data['boxid'];
    $this->name = $data['name'];
    $this->version = $data['version'];
    $this->sex = $data['sex'];
    $this->dominant_color = $data['dominant_color'];
    $this->creatorid = $data['creatorid'];
    $this->creatorname = $data['creatorname'];
    $this->creationdate = $data['creationdate'];
    $this->editorid = $data['editorid'];
    $this->editorname = $data['editorname'];
    $this->editiondate = $data['editiondate'];
    $this->validatorid = $data['validatorid'];
    $this->validatorname = $data['validatorname'];
    $this->validationdate = $data['validationdate'];
    $this->nbpictures = $data['nbpictures'];
    $this->xmin = $data['xmin'];
    $this->xmax = $data['xmax'];
    $this->ymin = $data['ymin'];
    $this->ymax = $data['ymax'];
    $this->photoannotationid = $data['photoannotationid'];
    $this->colladdeddate = $data['colladdeddate'];
    $this->collquantity = $data['collquantity'];
    $this->colusers = $data['colusers'];
    $this->numberfavorited = $data['numberfavorited'];
    $this->inuserfavorites = $data['inuserfavorites'];
    $this->favusers = $data['favusers'];
    $this->tags = $data['tags'];
  }

  public function getInternalid() {
    return $this->internalid;
  }

  public function getBoxId() {
    return $this->boxid;
  }

  public function getName() {
    return $this->name;
  }

  public function getVersion() {
    return $this->version;
  }

  public function getSex() {
    return $this->sex;
  }

  public function getDominantColor() {
    return $this->dominant_color;
  }

  public function getCreatorId() {
    return $this->creatorid;
  }

  public function getCreatorName() {
    return $this->creatorname;
  }

  public function getCreationDate() {
    return $this->creationdate;
  }

  public function getEditorId() {
    return $this->editorid;
  }

  public function getEditorName() {
    return $this->editorname;
  }

  public function getEditionDate() {
    return $this->editiondate;
  }

  public function getValidatorId() {
    return $this->validatorid;
  }

  public function getValidatorName() {
    return $this->validatorname;
  }

  public function getValidationDate() {
    return $this->validationdate;
  }

  public function getNbPictures() {
    return $this->nbpictures;
  }

  public function jsonSerialize() {
    return [
      'internalid' => $this->internalid,
      'boxid' => $this->boxid,
      'name' => $this->name,
      'version' => $this->version,
      'sex' => $this->sex,
      'dominant_color' => $this->dominant_color,
      'creatorid' => $this->creatorid,
      'creatorname' => $this->creatorname,
      'creationdate' => $this->creationdate,
      'editorid' => $this->editorid,
      'editorname' => $this->editorname,
      'editiondate' => $this->editiondate,
      'validatorid' => $this->validatorid,
      'validatorname' => $this->validatorname,
      'validationdate' => $this->validationdate,
      'nbpictures' => $this->nbpictures,
      'xmin' => $this->xmin,
      'xmax' => $this->xmax,
      'ymin' => $this->ymin,
      'ymax' => $this->ymax,
      'photoannotationid' => $this->photoannotationid,
      'colladdeddate' => $this->colladdeddate,
      'collquantity' => $this->collquantity,
      'colusers' => json_decode($this->colusers),
      'numberfavorited' => $this->numberfavorited,
      'inuserfavorites' => $this->inuserfavorites,
      'favusers'  => json_decode($this->favusers),
      'tags' => json_decode($this->tags)
    ];
  }

}
