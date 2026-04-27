<!-- For development use only. -->
<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/php/resources/config.php"); 
$title = "Page Template";

?>

<!DOCTYPE html>
<html lang="en">
<?php include "assets/components/head.php"; ?>
<body>
    <?php include "assets/components/navbar.php"; ?>
    <header class="hero-banner">
        <h1>Page Template</h1>
        <p><i>Any additional banner text.</i></p>
    </header>
    <!-- Page specific contents go here -->
    <?php include "assets/components/footer.php"; ?>
</body>
</html>