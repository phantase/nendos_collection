<?php

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

// Database credential
$config['db']['host']    = "";
$config['db']['user']    = "";
$config['db']['pass']    = "";
$config['db']['dbname']  = "";
$config['db']['charset'] = "utf8"; // e.g. utf8

// SMTP credential
$config['smtp']['host']   = ""; // e.g. mail.aserver.com
$config['smtp']['port']   = 587; // e.g. 587
$config['smtp']['user']   = ""; // e.g. administrator@aserver.com
$config['smtp']['pass']   = ""; // self explaining
$config['smtp']['from']   = ""; // e.g. administrator@aserver.com
$config['smtp']['bcc']    = ""; // e.g. registration@aserver.com
$config['smtp']['name']   = ""; // e.g. Registration (A Server)

// CORS
$config['cors']['origin'] = ""; // e.g. http://someadressyouallow.com
// JWT
$config['jwt']['secret'] = "";
$config['jwt']['secure'] = true; // i.e. do we require HTTPS or not
$config['jwt']['relaxed'] = ["localhost", "192.168.99.100"]; // e.g. ["localhost", "192.168.99.100"]
