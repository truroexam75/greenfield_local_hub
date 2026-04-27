<?php


// Sets the include path to the root to prevent relative path issues
ini_set('include_path', $_SERVER['DOCUMENT_ROOT']);

// Report all errors, don't display errors to user, but do to logs
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Error log's destination is set to the logs file, and the file name
// structure is created.
$error_log_destination = "{$_SERVER['DOCUMENT_ROOT']}/scripts/php/resources/logs/php-errors-" . time() . ".txt";
ini_set('error_log', $error_log_destination);

function info_log($message) {
    // Custom function for streamlining file_put_contents() process
    $info_log_destination = "{$_SERVER['DOCUMENT_ROOT']}/scripts/php/resources/logs/php-info-" . time() . ".txt";
    file_put_contents($info_log_destination, $message, FILE_APPEND);
    }
    
// Session cookie settings to reduce security risk
// session.cookie_secure would be enabled if I were able to create a
// https environment with Laragon.
ini_set("session.cookie_httponly", 1);
ini_set("session.use_only_cookies", 1);
ini_set("session.use_trans_sid", 0);
    
// Session starting is included here as this file is included [once] on
// every page
session_start();