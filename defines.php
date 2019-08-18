<?php

$IS_LOCAL = $_SERVER["SERVER_NAME"] == "localhost" ? true : false;
$BASE_URL = sprintf("%s://%s/", $_SERVER["SERVER_PORT"] == "80" ? "http" : "https", $_SERVER["SERVER_NAME"]);

$GLOBALS = array(
  "title"   => "Vic Lab",
  "author"  => "Vic P.",
  "user"    => "vic4key",
  "email"   => "vic4key@gmail.com",
  "domain"  => "viclab.biz",
  "token"   => "",
  "auth"    => "",
  "year"    => date("Y"),
  "base"    => $BASE_URL,
  "local"   => $IS_LOCAL,
  "icon"    => ($IS_LOCAL ? "" : $BASE_URL)."images/favicon.ico",
  "cover"   => ($IS_LOCAL ? "" : $BASE_URL)."images/ogimage.jpg",
  "avatar"  => ($IS_LOCAL ? "" : $BASE_URL)."images/avatar.jpg",
);

?>