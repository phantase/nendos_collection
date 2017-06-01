<?php

class AccessoryEntity extends Entity implements JsonSerializable
{
  protected $internalid;
  protected $boxid;
  protected $nendoroidid;
  protected $type;
  protected $main_color;
  protected $other_color;
  protected $description;
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
  protected $haspicture;

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
    $this->nendoroidid = $data['nendoroidid'];
    $this->type = $data['type'];
    $this->main_color = $data['main_color'];
    $this->other_color = $data['other_color'];
    $this->description = $data['description'];
    $this->creatorid = $data['creatorid'];
    $this->creatorname = $data['creatorname'];
    $this->creationdate = $data['creationdate'];
    $this->editorid = $data['editorid'];
    $this->editorname = $data['editorname'];
    $this->editiondate = $data['editiondate'];
    $this->validatorid = $data['validatorid'];
    $this->validatorname = $data['validatorname'];
    $this->validationdate = $data['validationdate'];
    $this->haspicture = $data['haspicture'];
    $this->xmin = $data['xmin'];
    $this->xmax = $data['xmax'];
    $this->ymin = $data['ymin'];
    $this->ymax = $data['ymax'];
    $this->photoannotationid = $data['photoannotationid'];
    $this->colladdeddate = $data['colladdeddate'];
    $this->collquantity = $data['collquantity'];
    $this->numberfavorited = $data['numberfavorited'];
    $this->inuserfavorites = $data['inuserfavorites'];
    $this->favusers = $data['favusers'];
  }

  public function getInternalid() {
    return $this->internalid;
  }

  public function getBoxId() {
    return $this->boxid;
  }

  public function getNendoroidId() {
    return $this->nendoroidid;
  }

  public function getType() {
    return $this->type;
  }

  public function getMainColor() {
    return $this->main_color;
  }

  public function getOtherColor() {
    return $this->other_color;
  }

  public function getDescription() {
    return $this->description;
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

  public function getHasPicture() {
    return $this->haspicture;
  }

  public function jsonSerialize() {
    return [
      'internalid' => $this->internalid,
      'boxid' => $this->boxid,
      'nendoroidid' => $this->nendoroidid,
      'type' => $this->type,
      'main_color' => $this->main_color,
      'other_color' => $this->other_color,
      'description' => $this->description,
      'creatorid' => $this->creatorid,
      'creatorname' => $this->creatorname,
      'creationdate' => $this->creationdate,
      'editorid' => $this->editorid,
      'editorname' => $this->editorname,
      'editiondate' => $this->editiondate,
      'validatorid' => $this->validatorid,
      'validatorname' => $this->validatorname,
      'validationdate' => $this->validationdate,
      'haspicture' => $this->haspicture,
      'xmin' => $this->xmin,
      'xmax' => $this->xmax,
      'ymin' => $this->ymin,
      'ymax' => $this->ymax,
      'photoannotationid' => $this->photoannotationid,
      'colladdeddate' => $this->colladdeddate,
      'collquantity' => $this->collquantity,
      'numberfavorited' => $this->numberfavorited,
      'inuserfavorites' => $this->inuserfavorites,
      'favusers'  => json_decode($this->favusers)
    ];
  }

}
