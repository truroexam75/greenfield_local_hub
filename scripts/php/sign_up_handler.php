<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/php/resources/config.php");

// Check which account is being signed up for, and use the data for that
// account type
switch (true) {
    // Checks if a string is returned as that indicates an error message
    // for the user.
    case isset($_POST['customer_sign_up']):
        $result = handle_statement("customer");
        if (is_string($result)) {
            echo $result;
        }

    case isset($_POST['producer_sign_up']):
        $result = handle_statement("producer");
        if (is_string($result)) {
            echo $result;
        }   
}


header("Location: /sign_in.php");
        
 
function handle_values($target_user): array | string {
    // Define an error message to be sent to the user should there be
    // a problem with the inputs they've sent
    $error_message = "";

    // Puts the requested sign up fields in an array 
    $sign_up_fields = [
        "{$target_user}_first_name",
        "{$target_user}_last_name",
        "{$target_user}_date_of_birth",
        "{$target_user}_email_address",
        "{$target_user}_phone_number",
        "{$target_user}_username",
        "{$target_user}_password"
    ];
    
    info_log("--- Raw sign up fields: \n" . print_r($_POST, true));

    // Loops through each value sent through POST to verify they are
    // the data needed and that the data sent is sanitised/validated
    foreach ($_POST as $field => $value) {
        // Since 'customer_sign_up' / 'producer_sign_up' have
        // already been checked, they can be skipped. Additionally,
        // any fields not requested in the form that the user may
        // have managed to inject are also skipped.

        if (stristr($field, "sign_up") || !in_array($target_user . "_" . $field, $sign_up_fields)) {
            continue;
        }


        // Switches through different data types and handles them
        // appropiately based on what sanitisation or validation they
        // may need. Hashing a password requires raw data, meaning
        // it is checked for prior to checking for a string.
        switch (true) {
            case stristr($field, "password"):
                $value = password_hash($value, PASSWORD_BCRYPT);
                break;
                
                
            case stristr($field, "email_address"):
                $value = filter_var($value, FILTER_SANITIZE_EMAIL);
                $value = filter_var($value, FILTER_VALIDATE_EMAIL);
                if ($value == false) {
                    $error_message = "Email address is invalid. Please provide a new address.";
                    break;
                }   
                        
            case is_string($value):
                $value = trim($value);
                $value = stripslashes($value);
                $value = htmlspecialchars($value);
                break;
    
            case stristr($field, "phone_number") && !empty($value):
                $state = empty($value);
                info_log("Key: {$field} Phone number: {$value} \n State: {$state}");
                $regex_pattern = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";
                $match = preg_match($regex_pattern, $value);
                if ($match == false) {
                    $error_message = "Phone number is invalid. Please provide a new phone number.";
                }
                break;
        }

        if (!empty($error_message)) {
            error_log("Input validation failed: {$error_message}");
            return $error_message;
        }

        // Assigns the value to the specified field after all 
        // cleansing has been done to the input

        $sign_up_fields[$target_user . "_" . $field] = $value;
    }

    return $sign_up_fields;
}

function handle_statement($target_user) {
    include "resources/db_connect.php";

    // Prepares the INSERT statement which will be used to create the
    // record of the account, with named parameters ready for the
    // values created by the 'handle_values()' function
    $stmt = $conn->prepare("INSERT INTO {$target_user}s (
        {$target_user}_first_name,
        {$target_user}_last_name,
        {$target_user}_date_of_birth,
        {$target_user}_email_address,
        {$target_user}_phone_number,
        {$target_user}_username,
        {$target_user}_password
    )
    VALUES (
        :{$target_user}_first_name,
        :{$target_user}_last_name,
        :{$target_user}_date_of_birth,
        :{$target_user}_email_address,
        :{$target_user}_phone_number,
        :{$target_user}_username,
        :{$target_user}_password
    );");

    // Logs the statement for debugging purposes
    info_log("--- Statement: \n" . print_r($stmt, true));

    $sign_up_fields = handle_values($target_user);
    
    // If it is a string, then it is an error message, so must
    // be returned for display purposes.
    if (is_string($sign_up_fields)) {
        return $sign_up_fields;    
    }

    info_log("--- Validated sign up fields: \n" . print_r($sign_up_fields, true));

    $stmt->bindParam(":{$target_user}_first_name", $sign_up_fields["{$target_user}_first_name"]);
    $stmt->bindParam(":{$target_user}_last_name", $sign_up_fields["{$target_user}_last_name"]);
    $stmt->bindParam(":{$target_user}_date_of_birth", $sign_up_fields["{$target_user}_date_of_birth"]);
    $stmt->bindParam(":{$target_user}_email_address", $sign_up_fields["{$target_user}_email_address"]);
    $stmt->bindParam(":{$target_user}_phone_number", $sign_up_fields["{$target_user}_phone_number"]);
    $stmt->bindParam(":{$target_user}_username", $sign_up_fields["{$target_user}_username"]);
    $stmt->bindParam(":{$target_user}_password", $sign_up_fields["{$target_user}_password"]);


    $stmt->execute();
}

?>