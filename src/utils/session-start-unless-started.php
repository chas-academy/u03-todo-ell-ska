<?php

function sessionStartUnlessStarted()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}
