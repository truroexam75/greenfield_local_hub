<!-- navbar.php -->
 
<nav>
    <div class="page-container">
        <!-- image container goes here -->
        <?php 
        $pages = [
            // Page title, or $page => Page source, or $source
            "Dashboard Home" => "dashboard.php",
            "Your Products" => "your_products.php",
            "Upcoming Orders" => "upcoming_orders.php"
        ];
        // Short script to run through the pages and see which one is active
        // If it is active, make it noticeable for the user by assigning a
        // CSS class which will give relevant styling
        foreach ($pages as $page => $source) {
            echo "<a href=\"{$source}\"";
            echo $page == $title ? "class=\"current\"" : null;
            echo ">$page</a>";
        }
        ?>
    </div>
    <!-- The container which holds the account page link -->
    <div class="user-container">
        <button class="button-anchor-container" title="View account" aria-label="View account">
            <?php $href = isset($_SESSION["signed_in"]) ? "account.php" : "sign_in.php"; ?>
            <a href="<?= $href ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" version="1.1">
                    <path d="M 25.481 1.394 C 21.223 3.249, 16.221 9.305, 15.420 13.575 C 13.257 25.107, 25.098 36.384, 35.955 33.132 C 48.108 29.491, 52.695 15.417, 44.698 6.309 C 39.462 0.345, 32.169 -1.520, 25.481 1.394 M 15.992 41.250 C 9.066 45.403, 4.912 51.786, 4.671 58.645 L 4.500 63.500 32 63.500 L 59.500 63.500 59.329 58.645 C 59.088 51.786, 54.934 45.403, 48.008 41.250 C 42.804 38.129, 42.168 38, 32 38 C 21.832 38, 21.196 38.129, 15.992 41.250" stroke="none" fill="currentColor" fill-rule="evenodd"/>
                </svg>
            </a>
        </button>
    </div>
</nav>