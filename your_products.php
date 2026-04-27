<!-- For development use only. -->
<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/php/resources/config.php"); 
$title = "Dashboard - Your Products";

// If the user is signed in to a producer account, serve the page
if (isset($_SESSION["signed_in"]) && $_SESSION["user_type"] == "producer") {
?>

<!DOCTYPE html>
<html lang="en">
<?php include "assets/components/head.php"; ?>
<body>
    <?php include "assets/components/dashboard_navbar.php"; ?>
    <header class="hero-banner">
        <h1>Your Products</h1>
    </header>
    <section>
        <p>Create a new product</p>
        <button class="button-anchor-container">
            <a href=""></a>
        </button>
    </section>
    <section class="product-section" id="producer-products">
    </section>
    <?php include "assets/components/footer.php"; ?>
</body>
</html>

<?php } else { 
    header("Location: " . $_SERVER['DOCUMENT_ROOT'] . "/index.php");
} ?>
