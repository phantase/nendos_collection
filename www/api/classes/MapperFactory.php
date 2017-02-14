<?php

class MapperFactory {

  public static function getMapper($db,$element){
    switch($element){
      case 'accessory':
      case 'accessories':
        return new AccessoryMapper($db);
      case 'bodypart':
      case 'bodyparts':
        return new BodypartMapper($db);
      case 'box':
      case 'boxes':
        return new BoxMapper($db);
      case 'face':
      case 'faces':
        return new FaceMapper($db);
      case 'hair':
      case 'hairs':
        return new HairMapper($db);
      case 'hand':
      case 'hands':
        return new HandMapper($db);
      case 'nendoroid':
      case 'nendoroids':
        return new NendoroidMapper($db);
      default:
        throw new Exception('Element not supported');
    }
  }

}
