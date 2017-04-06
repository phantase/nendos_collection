<?php

class Entity
{
  // Information about location in photo
  protected $xmin;
  protected $xmax;
  protected $ymin;
  protected $ymax;
  protected $photoannotationid;
  // For user collection
  protected $colladdeddate;
  protected $collquantity;

  public function getXMin() {
    return $this->xmin;
  }

  public function getXMax() {
    return $this->xmax;
  }

  public function getYMin() {
    return $this->ymin;
  }

  public function getYMax() {
    return $this->ymax;
  }

  public function getPhotoAnnotationId() {
    return $this->photoannotationid;
  }

  public function getCollAddedDate() {
    return $this->colladdeddate;
  }

  public function getCollQuantity() {
    return $this->collquantity;
  }

}