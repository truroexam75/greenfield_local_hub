<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/php/resources/config.php");

// Checks if the user is a customer or producer, and signs them in to that
// account type - if successful, redirect to their respective home page,
// if not, provide the user the error.
switch (true) {
    case isset($_POST['customer_sign_in']):
        $result = handle_statement("customer");
        if (!is_string($result)) {
            header("Location: /index.php");
        } else {
            echo $result;
        }
    case isset($_POST['producer_sign_in']):
        $result = handle_statement("producer");
        if (!is_string($result)) {
            header("Location: /dashboard.php");
        } else {
            echo $result;
        }

}


function handle_values($target_user): array {
    $sign_in_fields = [
        "{$target_user}_username",
        "{$target_user}_password"
    ];

    info_log("--- Raw sign in fields: \n" . print_r($_POST, true));

    foreach ($_POST as $field => $value) {
        if (stristr($field, "sign_in") || !in_array($target_user . "_" . $field, $sign_in_fields)) {
            continue;
        }

        switch (true) {
            case stristr($field, "username"):
                $value = trim($value);
                $value = stripslashes($value);
                $value = htmlspecialchars($value);
                break;
        }

        $sign_in_fields[$target_user . "_" . $field] = $value;
    }

    return $sign_in_fields;
}

function handle_statement($target_user) {
    include 'resources/db_connect.php';

    $error_message = "";

    $stmt = $conn->prepare("SELECT {$target_user}_id, {$target_user}_username, {$target_user}_password
    FROM {$target_user}s
    WHERE {$target_user}_username = :{$target_user}_username;
    ");

    // Logs the statement for debugging purposes
    info_log("--- Statement: \n" . print_r($stmt, true));

    $sign_in_fields = handle_values($target_user);
    
    $stmt->bindParam(":{$target_user}_username", $sign_in_fields["{$target_user}_username"]);

    $stmt->execute();

    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($record) {
        $valid = password_verify($sign_in_fields["{$target_user}_password"], $record["{$target_user}_password"]);
    } else {
        $error_message = "Sorry, this account does not exist.";
        return $error_message;
    }

    if ($valid) {
        $_SESSION["signed_in"] = true;
        $_SESSION["user_type"] = $target_user;
        $_SESSION["user_id"] = $record["{$target_user}_id"];
        $_SESSION["username"] = $record["{$target_user}_username"];
    }

    info_log("--- Session variables: \n" . print_r($_SESSION, true));

}

?>