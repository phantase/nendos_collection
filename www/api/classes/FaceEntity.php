<?php

class FaceEntity implements JsonSerializable
{
  protected $internalid;
  protected $boxid;
  protected $nendoroidid;
  protected $eyes;
  protected $eyes_color;
  protected $mouth;
  protected $skin_color;
  protected $sex;
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
    $this->eyes = $data['eyes'];
    $this->eyes_color = $data['eyes_color'];
    $this->mouth = $data['mouth'];
    $this->skin_color = $data['skin_color'];
    $this->sex = $data['sex'];
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

  public function getEyes() {
    return $this->eyes;
  }

  public function getEyesColor() {
    return $this->eyes_color;
  }

  public function getMouth() {
    return $this->mouth;
  }

  public function getSkinColor() {
    return $this->skin_color;
  }

  public function getSex() {
    return $this->sex;
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
      'face' => [
        'internalid' => $this->internalid,
        'boxid' => $this->boxid,
        'nendoroidid' => $this->nendoroidid,
        'eyes' => $this->eyes,
        'eyes_color' => $this->eyes_color,
        'mouth' => $this->mouth,
        'skin_color' => $this->skin_color,
        'sex' => $this->sex,
        'creatorid' => $this->creatorid,
        'creatorname' => $this->creatorname,
        'creationdate' => $this->creationdate,
        'editorid' => $this->editorid,
        'editorname' => $this->editorname,
        'editiondate' => $this->editiondate,
        'validatorid' => $this->validatorid,
        'validatorname' => $this->validatorname,
        'validationdate' => $this->validationdate
      ]
    ];
  }

}
