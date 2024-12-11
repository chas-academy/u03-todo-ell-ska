<?php

function redirect(string $url) {
  header("Location: $url", true, 301);
  exit();
}
