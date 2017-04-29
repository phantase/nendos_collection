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
      case 'photoaccessory':
      case 'photoaccessories':
        return new PhotoAccessoryMapper($db);
      case 'photobodypart':
      case 'photobodyparts':
        return new PhotoBodypartMapper($db);
      case 'photobox':
      case 'photoboxes':
        return new PhotoBoxMapper($db);
      case 'photoface':
      case 'photofaces':
        return new PhotoFaceMapper($db);
      case 'photohair':
      case 'photohairs':
        return new PhotoHairMapper($db);
      case 'photohand':
      case 'photohands':
        return new PhotoHandMapper($db);
      case 'photonendoroid':
      case 'photonendoroids':
        return new PhotoNendoroidMapper($db);
      case 'user':
      case 'users':
        return new UserMapper($db);
      default:
        throw new Exception('Element not supported');
    }
  }

}
