<?php

include_once('mvc/models/get_faces.php');
$faces = get_allFaces();

$page_title = "Faces";

include_once('mvc/views/pages/skeleton.php');
