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
      case 'photo':
      case 'photos':
        return new PhotoMapper($db);
      case 'photoaccessories':
        return new PhotoAccessoryMapper($db);
      case 'photobodyparts':
        return new PhotoBodypartMapper($db);
      case 'photoboxes':
        return new PhotoBoxMapper($db);
      case 'photofaces':
        return new PhotoFaceMapper($db);
      case 'photohairs':
        return new PhotoHairMapper($db);
      case 'photohands':
        return new PhotoHandMapper($db);
      case 'photonendoroids':
        return new PhotoNendoroidMapper($db);
      default:
        throw new Exception('Element not supported');
    }
  }

}
