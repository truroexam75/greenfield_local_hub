<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/php/resources/config.php"); 

handle_statement();


function handle_statement() {
    include "resources/db_connect.php";

    // Declared for debugging purposes
    $error_message = "";

    if (!empty($error_message)) {
        return $error_message;
    }

    $producer_id = $_POST["producer_id"];

    $stmt = $conn->prepare("INSERT INTO products (
        producer_id,
        product_name,
        product_description,
        product_stock
    ) VALUES (
        :producer_id,
        :product_name,
        :product_description,
        :product_stock
    )");

    $stmt->bindParam(":producer_id");
    $stmt->bindParam(":product_name");
    $stmt->bindParam(":product_description");
    $stmt->bindParam(":product_stock");

    $stmt->execute();

}
?>