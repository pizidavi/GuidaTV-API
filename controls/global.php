<?php

function str_format() {
  $string = func_get_arg(0);
  $params = array_slice(func_get_args(), 1);
  foreach ($params as $key => $param) {
    $string = str_replace_first('{}', $param, $string);
  }
  return $string;
}

function str_replace_first($from, $to, $content) {
  $from = '/'.preg_quote($from, '/').'/';
  return preg_replace($from, $to, $content, 1);
}

function getToken($length=22) {
  $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
  $token = "";
  for ($i = 0; $i < $length; $i++) {
    $token .= $alphabet[rand(0, strlen($alphabet)-1)];
  }
  return $token;
}

 ?>
