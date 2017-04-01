<?php

if( ! isLogged() ){
  raiseError("You must be logged in to collect an element.");
}

// First: get parameters (i.e. retrieve the box internalid)
$box_internalid = getGETorNULL('box_internalid');

// Second: retrieve collectable part of this box
/* BOX (the box itself...) */
$box = getValueOrRaiseError(get_singleBox($box_internalid,$_SESSION['userid']));
/* NENDOROIDS (if any) */
$nendoroids = getValueOrRaiseError(get_boxNendoroids($box_internalid,$_SESSION['userid']));
/* FACES (if any) */
$faces = getValueOrRaiseError(get_boxFaces($box_internalid,$_SESSION['userid']));
/* HAIRS (if any) */
$hairs = getValueOrRaiseError(get_boxHairs($box_internalid,$_SESSION['userid']));
/* HANDS (if any) */
$hands = getValueOrRaiseError(get_boxHands($box_internalid,$_SESSION['userid']));
/* BODYPARTS (if any) */
$bodyparts = getValueOrRaiseError(get_boxBodyparts($box_internalid,$_SESSION['userid']));
/* ACCESSORIES (if any) */
$accessories = getValueOrRaiseError(get_boxAccessories($box_internalid,$_SESSION['userid']));
