<?php

$container = $app->getContainer();

$container["JwtAuthentication"] = function($container) {
  return new \Slim\Middleware\JwtAuthentication([
        "path" => "/auth",
        "passthrough" => ["/auth/login", "/auth/register", "/auth/confirm"],
        "secure" => $container["settings"]["jwt"]["secure"],
        "logger" => $container["jwtlogger"],
        "relaxed" => $container["settings"]["jwt"]["relaxed"],
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
