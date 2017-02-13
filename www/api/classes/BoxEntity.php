<?php

class BoxEntity
{
  protected $internalid;
  protected $number;
  protected $name;
  protected $series;
  protected $manufacturer;
  protected $category;

  /**
   *
   *
   * @param  array $data The data to use to create
   */
  public function __construct(array $data) {
    // no internalid if we're creating
    if(isset($data['internalid'])) {
      $this->id = $data['internalid'];
    }

    $this->number = $data['number'];
    $this->name = $data['name'];
    $this->series = $data['series'];
    $this->manufacturer = $data['manufacturer'];
    $this->category = $data['category'];
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

}
