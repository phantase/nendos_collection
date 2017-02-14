<?php

class MapperFactory {

  public static function getMapper($db,$element){
    switch($element){
      case 'accessories':
        return new AccessoryMapper($db);
      case 'bodyparts':
        return new BodypartMapper($db);
      default:
        throw new Exception('Element not supported');
    }
  }

}
