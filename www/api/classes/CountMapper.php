<?php

class CountMapper extends Mapper
{
  protected $tablename = "";

  public function get() {
    $result = new CountEntity();

    $result->_setAccessories( (new AccessoryMapper($this->db))->count()['count']*1 );
    $result->_setBodyparts( (new BodypartMapper($this->db))->count()['count']*1 );
    $result->_setBoxes( (new BoxMapper($this->db))->count()['count']*1 );
    $result->_setFaces( (new FaceMapper($this->db))->count()['count']*1 );
    $result->_setHairs( (new HairMapper($this->db))->count()['count']*1 );
    $result->_setHands( (new HandMapper($this->db))->count()['count']*1 );
    $result->_setNendoroids( (new NendoroidMapper($this->db))->count()['count']*1 );
    $result->_setPhotos( (new PhotoMapper($this->db))->count()['count']*1 );

    return $result;
  }

}
