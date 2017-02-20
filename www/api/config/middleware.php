<?php

$container = $app->getContainer();

$container["JwtAuthentication"] = function($container) {
  return new \Slim\Middleware\JwtAuthentication([
        "path" => "/auth",
        "passthrough" => ["/auth/login"],
        "secure" => true,
        "logger" => $container["jwtlogger"],
        "relaxed" => ["localhost", "192.168.99.100"],
        "secret" => $container["settings"]["jwt"]["secret"]
    ]);
};

$app->add("JwtAuthentication");

/*
To be continued with:

https://github.com/tuupola/slim-jwt-auth
http://www.appelsiini.net/projects/slim-jwt-auth
https://github.com/tuupola/slim-api-skeleton
https://github.com/tuupola/slim-api-skeleton/blob/master/routes/token.php
https://github.com/tuupola/slim-api-skeleton/blob/master/routes/todos.php

https://auth0.com/blog/build-an-app-with-vuejs/
 */
