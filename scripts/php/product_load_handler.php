<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/php/resources/config.php"); 

// Gets the values - offset and producer_id - from the Fetch request
// Makes it an associative array for easy access to different key value
// pairs
$datastream = json_decode(file_get_contents('php://input'), true);

// Checks whether the user is a producer or a customer, getting products
// of their own or looking at products available
switch (isset($datastream["producer_id"])) {
    case true:
        $result = handle_statement("dashboard");
        echo $result;
    case false:
        $result = handle_statement("market");
        echo $result;
}


function handle_statement($interface) {
    include "resources/db_connect.php";

    // Defines an error message variable for debugging purposes
    $error_message = "";
    
    // Gets the offset of the products - allows pagination
    $offset = $datastream["offset"];
    
    switch (true) {
        // Checks that the offset is a valid integer, breaks the switch
        // block if not
        case $interface:
            if (!is_int($offset)) {
                $error_message = "The offset provided is invalid.";
                break;
            }
        // If the user is a producer, then load only products where the
        // producer ID is theirs
        case $interface == "dashboard":
            // Checks if the producer ID is a valid integer breaks the
            // switch block if not
            $producer_id = $_POST["producer_id"];
            if (!is_int($producer_id)) {
                $error_message = "The producer ID provided is in an invalid format.";
                break;
            }

            // Prepares the statement for getting the producer's products
            $stmt = $conn->prepare("SELECT 
                producers.producer_id,
                producers.producer_username,
                products.product_name,
                products.product_description,
                products.product_stock
            FROM products
            JOIN producers ON products.producer_id = producers.producer_id
            WHERE products.producer_id = :producer_id
            LIMIT 10 OFFSET :offset
            ");
            $stmt->bindParam(":producer_id", $producer_id);
            $stmt->bindParam(":offset", $offset);
            
        // If the user is a customer, let them see all products regardless
        // of the producer
        case $interface == "market":
            // Prepares the statement for getting all products - extra
            // filtering and sorting will be added in the next iteration
            $stmt = $conn->prepare("SELECT
                producers.producer_id,
                producers.producer_username,
                products.product_name,
                products.product_description,
                products.product_stock
            FROM products
            JOIN producers ON products.producer_id = producers.producer_id
            LIMIT 10 OFFSET :offset
            ");
            $stmt->bindParam(":offset", $offset);
    }

    // Checks if there is an error message to display
    if (!empty($error_message)) {
        return "Product pulling failed: {$error_message}";
    }

    // Executes the statement and logs it as is for debugging purposes
    $result = $stmt->execute();
    info_log("--- Raw result:" . print_r($result, true));
    
    // Encodes the result into JSON format and logs it for further
    // debugging
    $result = json_encode($result, JSON_PRETTY_PRINT);
    info_log("--- JSON encoded result:" . print_r($result, true));

    return $result;

}
?>