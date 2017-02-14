<?php

class HairEntity implements JsonSerializable
{
  protected $internalid;
  protected $boxid;
  protected $nendoroidid;
  protected $main_color;
  protected $other_color;
  protected $haircut;
  protected $description;
  protected $frontback;
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
    $this->main_color = $data['main_color'];
    $this->other_color = $data['other_color'];
    $this->haircut = $data['haircut'];
    $this->description = $data['description'];
    $this->frontback = $data['frontback'];
    $this->creatorid = $data['creatorid'];
    $this->creatorname = $data['creatorname'];
    $this->creationdate = $data['creationdate'];
    $this->editorid = $data['editorid'];
    $this->editorname = $data['editorname'];
    $this->editiondate = $data['editiondate'];
    $this->validatorid = $data['validatorid'];
    $this->validatorname = $data['validatorname'];
    $this->validationdate = $data['validationdate'];
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

  public function getMainColor() {
    return $this->main_color;
  }

  public function getOtherColor() {
    return $this->other_color;
  }

  public function getHairCut() {
    return $this->haircut;
  }

  public function getDescription() {
    return $this->description;
  }

  public function getFrontBack() {
    return $this->frontback;
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

  public function jsonSerialize() {
    return [
      'internalid' => $this->internalid,
      'boxid' => $this->boxid,
      'nendoroidid' => $this->nendoroidid,
      'main_color' => $this->main_color,
      'other_color' => $this->other_color,
      'haircut' => $this->haircut,
      'description' => $this->description,
      'frontback' => $this->frontback,
      'creatorid' => $this->creatorid,
      'creatorname' => $this->creatorname,
      'creationdate' => $this->creationdate,
      'editorid' => $this->editorid,
      'editorname' => $this->editorname,
      'editiondate' => $this->editiondate,
      'validatorid' => $this->validatorid,
      'validatorname' => $this->validatorname,
      'validationdate' => $this->validationdate
    ];
  }

}
