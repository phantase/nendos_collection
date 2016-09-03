<?php

/** Used to urlize a string (i.e. transform it to become more pleasant in the address bar) */
function urlize($string){
  return preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $string)));
}

/** Used to transform an interval to something human readable */
function intervalFormater($interval){
  if($interval->y>1){
    return $interval->format('%y years ago');
  } else if($interval->y>0){
    return $interval->format('1 year ago');
  } else if($interval->m>1){
    return $interval->format('%m months ago');
  } else if($interval->m>0){
    return $interval->format('1 month ago');
  } else if($interval->d>1){
    return $interval->format('%d days ago');
  } else if($interval->d>0){
    return $interval->format('1 day ago');
  } else if($interval->h>1){
    return $interval->format('%h hours ago');
  } else if($interval->h>0){
    return $interval->format('1 hour ago');
  } else if($interval->i>1){
    return $interval->format('%i minutes ago');
  } else if($interval->i>0){
    return $interval->format('1 minute ago');
  } else if($interval->s>1){
    return $interval->format('%s seconds ago');
  } else if($interval->s>0){
    return $interval->format('1 second ago');
  }

  return "Right now";
}

/** Used to know if the current user can edit the DB */
function canEdit(){
  if(isset($_SESSION['userid'])){
    return true;
  } else {
    return false;
  }
}
