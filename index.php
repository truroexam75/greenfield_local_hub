<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/php/resources/config.php"); 
$title = "Home";

?>

<!DOCTYPE html>
<html lang="en">
<?php include "assets/components/head.php"; ?>
<body>
    <?php include "assets/components/navbar.php"; ?>
    <article>
        <header class="hero-banner" aria-label="Containing the title of the website and our slogan, with a background image containing fresh produce. Also contains a quick way to get to our products, by the use of a button.">
            <h1>Greenfield Local Hub</h1>
            <p><i>Where the heart is - rooted in quality.</i></p>
            <button class="button-anchor-container" title="Visit our products page to venture into the wide range of produce we offer."><a href="products.php">Explore our range</a></button>
        </header>
        <section>
            <h2>Who we are</h2>
            <p>Greenfield Local Hub is a collective market for local farmers and food producers, situated in the rural village of Greenfield, Greater Manchester. Our mission is to encourage the public to switch from the mass-produced contents found in supermarkets to the fresh goods brought to you directly by the hands that nourished them and helped them grow.</p>
            <button class="button-anchor-container" title="Visit our about page for more in depth information about us, what we do and our story."><a href="about_us.php">Find out more</a></button>
        </section>
    </article>
    <?php include "assets/components/footer.php"; ?>
</body>
</html>