<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require "../App/core/init.php";

$app = new App();
$app->loadController();



