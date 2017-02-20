<?php

$container = $app->getContainer();

$container['applogger'] = function($c) {
  $applogger = new \Monolog\Logger('applogger');
  $approtating = new \Monolog\Handler\RotatingFileHandler("../logs/applogger.log", 0, \Monolog\Logger::DEBUG);
  $applogger->pushHandler($approtating);
  return $applogger;
};

$container['errlogger'] = function($c) {
  $errlogger = new \Monolog\Logger("errlogger");
  $errrotating = new \Monolog\Handler\RotatingFileHandler("../logs/errlogger.log", 0, \Monolog\Logger::DEBUG);
  $errlogger->pushHandler($errrotating);
  return $errlogger;
};

$container['jwtlogger'] = function($c) {
  $jwtlogger = new \Monolog\Logger("jwtlogger");
  $rotating = new \Monolog\Handler\RotatingFileHandler("../logs/jwtlogger.log", 0, \Monolog\Logger::DEBUG);
  $jwtlogger->pushHandler($rotating);
  return $jwtlogger;
};
