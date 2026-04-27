<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/php/resources/config.php"); 
$title = "About Us";

?>

<!DOCTYPE html>
<html lang="en">
<?php include "assets/components/head.php"; ?>
<body>
    <?php include "assets/components/navbar.php"; ?>
    <article>
        <header class="hero-banner">
            <h1>About Us</h1>
            <p><i>Dive into our story and our goals.</i></p>
        </header>
        <section>
            <h2>Who we are</h2>
            <p>Welcome to Greenfield Local Hub, a vibrant collective market nestled in the heart of Greenfield, Greater Manchester, a rural village with a strong presence of fresh produce. Here, we celebrate the rich bounty of our local land and the hardworking farmers and food producers who cultivate it with care and passion. Our hub is more than just a marketplace; it’s a community where the journey of food from soil to table is honoured and shared.</p>
        </section>
        <section>
            <h2>What we are working towards</h2>
            <p>At Greenfield Local Hub, we believe in reconnecting people with the origins of their food. In a world dominated by mass-produced supermarket shelves, we offer a refreshing alternative: fresh, seasonal, and sustainably grown produce brought directly to you by the hands that nurtured it. Our mission is to inspire a shift towards mindful consumption, encouraging the public to choose quality over quantity, and community over convenience. This direct connection supports not only healthier eating but also a stronger, more resilient local economy.</p>
        </section>
        <section>
            <h2>Why you should shop with us</h2>
            <p>By choosing Greenfield Local Hub, you’re investing in transparency, sustainability, and the dignity of local farmers who pour their knowledge and love into every harvest. We provide a place for producers to share their produce directly. Together, we’re cultivating a future where food is valued as a vital part of our ecosystem and culture. Join us in celebrating local flavors, fostering meaningful connections, and nurturing the land that sustains us all.</p>
        </section>
    </article>
    <?php include "assets/components/footer.php"; ?>
</body>
</html>