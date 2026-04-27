<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/php/resources/config.php"); 
$title = "Sign In";

?>

<!DOCTYPE html>
<html lang="en">
<?php include "assets/components/head.php"; ?>
<body>
    <?php include "assets/components/navbar.php"; ?>
    <article>
        <header class="hero-banner">
            <h1>Sign in</h1>
            <p><i>Sign in to your account to checkout, view orders and more.</i></p>
        </header>
        <section class="side-by-side">
            <section>
                <form action="scripts\php\sign_in_handler.php" method="POST">
                    <section class="form-section-container">
                        <h2>Your sign in details</h2>
                        <div class="input-container">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" aria-label="Enter your username here" required>
                        </div>
                        <div class="input-container">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" aria-label="Enter your password here" required>
                        </div>
                    </section>
                    <button type="submit" id="submit-button" name="customer_sign_in" aria-label="Use the details you have entered to sign in to your account">Sign in</button>
                    <button type="reset" aria-label="Clear the details you have entered so far">Clear details</button>
                </form>
            </section>
            <section>
                <p>Please fill both fields with the correct details to sign in</p>
                <p>Don't have an account with us yet?</p>
                <button class="button-anchor-container">
                    <a href="sign_up.php">
                        Sign up here!
                    </a>
                </button>
                <p id="switch-hint">Are you a producer? You can sign in here to access your dashboard.</p>
                <button id="switch-account-button">Sign in to dashboard</button>
            </section>
        </section>
    </article>
    <?php include "assets/components/footer.php"; ?>
</body>
</html>