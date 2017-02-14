<?php

class CountEntity implements JsonSerializable
{
  protected $accessories;
  protected $bodyparts;
  protected $boxes;
  protected $faces;
  protected $hairs;
  protected $hands;
  protected $nendoroids;
  protected $photos;

  /**
   * An empty contructor
   */
  public function __construct() {
  }
  /**
   * @param  array $data The data to use to create
   */
  /*public function __construct(array $data) {
    $this->accessories = $data['accessories'];
    $this->bodyparts = $data['bodyparts'];
    $this->boxes = $data['boxes'];
    $this->faces = $data['faces'];
    $this->hairs = $data['hairs'];
    $this->hands = $data['hands'];
    $this->nendoroids = $data['nendoroids'];
    $this->photos = $data['photos'];
  }*/

  public function getAccessories() {
    return $this->accessories;
  }
  public function _setAccessories($accessories){
    $this->accessories = $accessories;
  }

  public function getBodyparts() {
    return $this->bodyparts;
  }
  public function _setBodyparts($bodyparts){
    $this->bodyparts = $bodyparts;
  }

  public function getBoxes() {
    return $this->boxes;
  }
  public function _setBoxes($boxes){
    $this->boxes = $boxes;
  }

  public function getFaces() {
    return $this->faces;
  }
  public function _setFaces($faces){
    $this->faces = $faces;
  }

  public function getHairs() {
    return $this->hairs;
  }
  public function _setHairs($hairs){
    $this->hairs = $hairs;
  }

  public function getHands() {
    return $this->hands;
  }
  public function _setHands($hands){
    $this->hands = $hands;
  }

  public function getNendoroids() {
    return $this->nendoroids;
  }
  public function _setNendoroids($nendoroids){
    $this->nendoroids = $nendoroids;
  }

  public function getPhotos() {
    return $this->photos;
  }
  public function _setPhotos($photos){
    $this->photos = $photos;
  }

  public function jsonSerialize() {
    return [
      'accessories' => $this->accessories,
      'bodyparts' => $this->bodyparts,
      'boxes' => $this->boxes,
      'faces' => $this->faces,
      'hairs' => $this->hairs,
      'hands' => $this->hands,
      'nendoroids' => $this->nendoroids,
      'photos' => $this->photos
    ];
  }

}
