<?php

$IS_LOCAL = $_SERVER["SERVER_NAME"] == "localhost" ? true : false;
$BASE_URL = sprintf("%s://%s/", $_SERVER["SERVER_PORT"] == "80" ? "http" : "https", $_SERVER["SERVER_NAME"]);

$GLOBALS = array_merge($GLOBALS, array(
  "title"   => "Vic Online",
  "author"  => "Vic P.",
  "user"    => "vic4key",
  "email"   => "vic4key@gmail.com",
  "domain"  => "vic.onl",
  "token"   => "",
  "auth"    => "",
  "year"    => (date("Y")),
  "base"    => ($BASE_URL),
  "local"   => ($IS_LOCAL),
  "icon"    => ($IS_LOCAL ? "" : $BASE_URL)."images/favicon.ico",
  "cover"   => ($IS_LOCAL ? "" : $BASE_URL)."images/cover.jpg",
  "avatar"  => ($IS_LOCAL ? "" : $BASE_URL)."images/avatar.jpg",
));

?>