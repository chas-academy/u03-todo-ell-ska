<?php

function redirect(string $url)
{
    header("Location: $url", true, 301);
    exit;
}

function refresh()
{
    $referer = $_SERVER['HTTP_REFERER'] ?? '/';
    header("Location: $referer", true, 303);
    exit;
}
