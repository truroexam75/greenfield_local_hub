<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/php/resources/config.php"); 
$title = "Account";

?>

<!DOCTYPE html>
<html lang="en">
<?php include "assets/components/head.php"; ?>
<body>
    <?php
    $navbar_include = "navbar.php";
    if (isset($_SESSION["user_type"])) {
        $navbar_include = $_SESSION["user_type"] == "customer" ? "navbar.php" : "dashboard_navbar.php";
    }
    include "assets/components/" . $navbar_include;
    ?>
    <article>
        <header class="hero-banner">
            <h1>Account</h1>
            <p><i>Manage your account, log out and more.</i></p>
        </header>
        <section>
            <p>The account you are signed into is a <b><?= $_SESSION["user_type"] ?></b> account.</p>
            <p>Sign out of your account?</p>
            <button class="button-anchor-container" title="Sign out of your account" aria-label="Sign out of your account">
                <a href="scripts/php/sign_out_handler.php">Sign out</a>
            </button>
        </section>
    </article>
    <?php include "assets/components/footer.php"; ?>
</body>
</html>