<?php

class MapperFactory {

  public static function getMapper($db,$element){
    switch($element){
      case 'accessories':
        return new AccessoryMapper($db);
      case 'bodyparts':
        return new BodypartMapper($db);
      case 'boxes':
        return new BoxMapper($db);
      case 'faces':
        return new FaceMapper($db);
      case 'hairs':
        return new HairMapper($db);
      case 'hands':
        return new HandMapper($db);
      case 'nendoroids':
        return new NendoroidMapper($db);
      default:
        throw new Exception('Element not supported');
    }
  }

}
