<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/php/resources/config.php"); 
$title = "Sign Up";

?>

<!DOCTYPE html>
<html lang="en">
<?php include "assets/components/head.php"; ?>
<body>
    <?php include "assets/components/navbar.php"; ?>
    <article>
        <header class="hero-banner">
            <h1>Sign up</h1>
            <p><i>Create an account to checkout, view orders and more.</i></p>
        </header>
        <section class="side-by-side">
            <section>
            <form action="scripts\php\sign_up_handler.php" method="POST">
                <section class="form-section-container">
                    <h2>Your name</h2>
                    <div class="input-container">
                        <label for="first-name">First name <span class="req">*</span></label>
                        <input type="text" id="first-name" name="first_name" aria-label="Enter your first name here" required>
                    </div>
                    <div class="input-container">
                        <label for="last-name">Last name <span class="req">*</span></label>
                        <input type="text" id="last-name" name="last_name" aria-label="Enter your last name here" required>
                    </div>
                </section>
                <section class="form-section-container">
                    <h2>Your date of birth</h2>
                    <div class="input-container">
                        <label for="date-of-birth">Date of birth <span class="req">*</span></label>
                        <input type="date" id="date-of-birth" name="date_of_birth" max="<?= date("Y-m-d") ?>" aria-label="Enter your date of birth here">
                    </div>
                    <p>Please note that you must be aged 18 or over to use our services, in accordance with our terms and conditions.</p>
                </section>
                <section class="form-section-container">
                    <h2>Your contact details</h2>
                    <div class="input-container">
                        <label for="email-address">Email address <span class="req">*</span></label>
                        <input type="email" id="email-address" name="email_address" aria-label="Enter your email address here" required>
                    </div>
                    <div class="input-container">
                        <label for="phone-number">Phone number</label>
                        <input type="tel" id="phone-number" name="phone_number" aria-label="Enter your phone number here, optional">
                    </div>
                </section>
                <section class="form-section-container">
                    <h2>Your sign in details</h2>
                    <div class="input-container">
                        <label for="username">Username <span class="req">*</span></label>
                        <input type="text" id="username" name="username" aria-label="Enter your username here" required>
                    </div>
                    <div class="input-container">
                        <label for="password">Password <span class="req">*</span></label>
                        <input type="password" id="password" name="password" aria-label="Enter your password here" required>
                    </div>
                </section>
                <button id="submit-button" type="submit" name="customer_sign_up">Sign up</button>
                <button type="reset">Clear details</button>
            </form>
            </section>
        <section>
            <p>Please fill all fields marked with <span class="req">*</span> as we require this information to proceed. Any fields not marked with this symbol are optional. If you would like to know more about how we use this data, please view our legal documents located in the footer.</p>
            <p>Already have an account with us?</p>
            <button class="button-anchor-container">
                <a href="sign_in.php">
                    Sign in here!
                </a>
            </button>
            <p id="switch-hint">Are you a producer? You can sign up here to access your dashboard.</p>
            <button id="switch-account-button">Sign up to dashboard</button>
        </section>
    </article>
    <?php include "assets/components/footer.php"; ?>
</body>
</html>