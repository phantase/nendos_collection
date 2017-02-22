<?php

class CountMapper extends Mapper
{
  protected $tablename = "";

  public function get() {
    $count = new CountEntity();

    $count->_setAccessories( (new AccessoryMapper($this->db))->count()['count']*1 );
    $count->_setBodyparts( (new BodypartMapper($this->db))->count()['count']*1 );
    $count->_setBoxes( (new BoxMapper($this->db))->count()['count']*1 );
    $count->_setFaces( (new FaceMapper($this->db))->count()['count']*1 );
    $count->_setHairs( (new HairMapper($this->db))->count()['count']*1 );
    $count->_setHands( (new HandMapper($this->db))->count()['count']*1 );
    $count->_setNendoroids( (new NendoroidMapper($this->db))->count()['count']*1 );
    $count->_setPhotos( (new PhotoMapper($this->db))->count()['count']*1 );

    $result = ['counts' => $count];

    return $result;
  }

  public function getForUser($userid) {
    $usercount = new CountEntity();

    $usercount->_setAccessories(  (new AccessoryMapper($this->db) )->countForUser($userid)['count']*1 );
    $usercount->_setBodyparts(    (new BodypartMapper($this->db)  )->countForUser($userid)['count']*1 );
    $usercount->_setBoxes(        (new BoxMapper($this->db)       )->countForUser($userid)['count']*1 );
    $usercount->_setFaces(        (new FaceMapper($this->db)      )->countForUser($userid)['count']*1 );
    $usercount->_setHairs(        (new HairMapper($this->db)      )->countForUser($userid)['count']*1 );
    $usercount->_setHands(        (new HandMapper($this->db)      )->countForUser($userid)['count']*1 );
    $usercount->_setNendoroids(   (new NendoroidMapper($this->db) )->countForUser($userid)['count']*1 );
    // $usercount->_setPhotos(       (new PhotoMapper($this->db)     )->countForUser($userid)['count']*1 );

    $result = $this->get();
    $result['usercounts'] = $usercount;

    return $result;
  }

}
