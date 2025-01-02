<?php

function validateString(string $string, bool $dieOnEmpty = false, string $message = 'Something went wrong') {
  $string = htmlspecialchars(trim($string));

  if (empty($string)) {
    if ($dieOnEmpty) {
      die($message);
    }

    return null;
  }

  return $string;
}
