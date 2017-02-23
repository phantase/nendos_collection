<?php

class BoxEntity extends Entity implements JsonSerializable
{
  protected $internalid;
  protected $number;
  protected $name;
  protected $series;
  protected $manufacturer;
  protected $category;
  protected $price;
  protected $releasedate;
  protected $specifications;
  protected $sculptor;
  protected $cooperation;
  protected $officialurl;
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
  // For user collection
  protected $colladdeddate;
  protected $collquantity;

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

    $this->number = $data['number'];
    $this->name = $data['name'];
    $this->series = $data['series'];
    $this->manufacturer = $data['manufacturer'];
    $this->category = $data['category'];
    $this->price = $data['price'] * 1;
    $this->releasedate = $data['releasedate'];
    $this->specifications = $data['specifications'];
    $this->sculptor = $data['sculptor'];
    $this->cooperation = $data['cooperation'];
    $this->officialurl = $data['officialurl'];
    $this->creatorid = $data['creatorid'];
    $this->creatorname = $data['creatorname'];
    $this->creationdate = $data['creationdate'];
    $this->editorid = $data['editorid'];
    $this->editorname = $data['editorname'];
    $this->editiondate = $data['editiondate'];
    $this->validatorid = $data['validatorid'];
    $this->validatorname = $data['validatorname'];
    $this->validationdate = $data['validationdate'];
    $this->xmin = $data['xmin'];
    $this->xmax = $data['xmax'];
    $this->ymin = $data['ymin'];
    $this->ymax = $data['ymax'];
    $this->colladdeddate = $data['colladdeddate'];
    $this->collquantity = $data['collquantity'];
  }

  public function getInternalid() {
    return $this->internalid;
  }

  public function getNumber() {
    return $this->number;
  }

  public function getName() {
    return $this->name;
  }

  public function getSeries() {
    return $this->series;
  }

  public function getManufacturer() {
    return $this->manufacturer;
  }

  public function getCategory() {
    return $this->category;
  }

  public function getPrice() {
    return $this->price;
  }

  public function getReleasedate() {
    return $this->releasedate;
  }

  public function getSpecifications() {
    return $this->specifications;
  }

  public function getSculptor() {
    return $this->sculptor;
  }

  public function getCooperation() {
    return $this->cooperation;
  }

  public function getOfficialURL() {
    return $this->officialurl;
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

  public function getCollAddedDate() {
    return $this->colladdeddate;
  }

  public function getCollQuantity() {
    return $this->collquantity;
  }

  public function jsonSerialize() {
    return [
      'internalid' => $this->internalid,
      'number' => $this->number,
      'name' => $this->name,
      'series' => $this->series,
      'manufacturer' => $this->manufacturer,
      'category' => $this->category,
      'price' => $this->price,
      'releasedate' => $this->releasedate,
      'specifications' => $this->specifications,
      'sculptor' => $this->sculptor,
      'cooperation' => $this->cooperation,
      'officialurl' => $this->officialurl,
      'creatorid' => $this->creatorid,
      'creatorname' => $this->creatorname,
      'creationdate' => $this->creationdate,
      'editorid' => $this->editorid,
      'editorname' => $this->editorname,
      'editiondate' => $this->editiondate,
      'validatorid' => $this->validatorid,
      'validatorname' => $this->validatorname,
      'validationdate' => $this->validationdate,
      'xmin' => $this->xmin,
      'xmax' => $this->xmax,
      'ymin' => $this->ymin,
      'ymax' => $this->ymax,
      'colladdeddate' => $this->colladdeddate,
      'collquantity' => $this->collquantity
    ];
  }

}
