<?php

if( ! isEditor() ){
  raiseError("You must be logged in with right credentials to add an element.");
}
