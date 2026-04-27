<?php


require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/php/resources/config.php");

session_destroy();
header("Location: /index.php");

?>