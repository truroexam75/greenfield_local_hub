<!-- navbar.php -->
 
<nav>
    <div class="page-container">
        <!-- image container goes here -->
        <?php 
        $pages = [
            // Page title, or $page => Page source, or $source
            "Home" => "index.php",
            "Products" => "products.php",
            "About Us" => "about_us.php"
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
    <!-- The search bar, which contains a form leading to a script
     that will handle any search queries, and a search button. -->
    <div class="search-bar-container">
        <form action="search_handler.php">
            <button title="See results for search" aria-label="See results for search" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" version="1.1">
                    <path d="M 18.994 0.934 C 1.091 6.380, -5.708 27.980, 6.006 42.191 C 13.027 50.709, 27.653 53.729, 37.093 48.610 L 41.500 46.221 50.661 55.252 C 57.082 61.582, 60.303 64.098, 61.433 63.664 C 65.397 62.143, 64.304 59.843, 55.252 50.661 L 46.221 41.500 48.610 37.093 C 53.722 27.665, 50.709 13.027, 42.216 6.026 C 35.983 0.889, 26.197 -1.257, 18.994 0.934 M 23.500 6.460 C 22.950 6.661, 21.271 7.096, 19.768 7.427 C 16.332 8.184, 10.394 13.336, 8.307 17.372 C 7.433 19.064, 6.684 22.721, 6.644 25.500 C 6.496 35.723, 14.006 43.921, 24.301 44.775 C 32.425 45.449, 39.167 41.455, 43.207 33.575 C 47.430 25.337, 43.376 13.150, 35 8.904 C 31.439 7.099, 25.313 5.797, 23.500 6.460" stroke="none" fill="currentColor" fill-rule="evenodd"/>
                </svg>
            </button>
            <input title="Enter your search term" aria-label="Enter your search term" type="text">
        </form>
    </div>
    <!-- The container which holds the basket page and account page
     links. -->
    <div class="user-container">
        <button title="View basket" aria-label="View basket">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" version="1.1">
                <path d="M 15.944 13.250 C 8.818 22.064, 8.263 22.515, 4.174 22.810 C 0.005 23.112, -0.109 23.212, 0.191 26.310 L 0.500 29.500 31.380 29.765 C 53.332 29.953, 62.656 29.701, 63.630 28.892 C 64.383 28.267, 65.001 26.573, 65.002 25.128 C 65.003 22.663, 64.711 22.500, 60.301 22.500 L 55.600 22.500 48.276 13.500 C 41.216 4.824, 38 2.257, 38 5.298 C 38 6.092, 40.700 10.125, 44 14.259 C 47.300 18.393, 50 22.051, 50 22.388 C 50 22.724, 41.900 23, 32 23 C 22.100 23, 14 22.724, 14 22.388 C 14 22.051, 16.700 18.393, 20 14.259 C 23.300 10.125, 26 6.125, 26 5.371 C 26 2.185, 22.973 4.556, 15.944 13.250 M 0.232 26 C 0.232 27.925, 0.438 28.712, 0.689 27.750 C 0.941 26.788, 0.941 25.212, 0.689 24.250 C 0.438 23.288, 0.232 24.075, 0.232 26 M 7.920 46.750 L 11.591 59.500 32 59.500 L 52.409 59.500 56.080 46.750 L 59.750 34 32 34 L 4.250 34 7.920 46.750 M 18.518 43.156 C 19.571 50.858, 20.706 53.489, 22.376 52.103 C 24.463 50.371, 22.160 38.655, 19.638 38.169 C 17.952 37.844, 17.852 38.290, 18.518 43.156 M 30.206 45.250 C 30.435 50.897, 30.832 52.500, 32 52.500 C 33.168 52.500, 33.565 50.897, 33.794 45.250 C 34.069 38.471, 33.952 38, 32 38 C 30.048 38, 29.931 38.471, 30.206 45.250 M 42.633 38.785 C 41.471 40.664, 40.821 51.771, 41.835 52.398 C 43.391 53.360, 44.700 50.281, 45.514 43.750 C 46.118 38.906, 45.985 38, 44.674 38 C 43.818 38, 42.900 38.353, 42.633 38.785" stroke="none" fill="currentColor" fill-rule="evenodd"/>
            </svg>
        </button>
        <button class="button-anchor-container" title="View account" aria-label="View account">
            <!-- Checks if the user is signed in: if they are, use this
            button to take them to the account page; if not, use this
            button to take them to the sign in page -->
            <?php $href = isset($_SESSION["signed_in"]) ? "account.php" : "sign_in.php"; ?>
            <a href="<?= $href ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" version="1.1">
                    <path d="M 25.481 1.394 C 21.223 3.249, 16.221 9.305, 15.420 13.575 C 13.257 25.107, 25.098 36.384, 35.955 33.132 C 48.108 29.491, 52.695 15.417, 44.698 6.309 C 39.462 0.345, 32.169 -1.520, 25.481 1.394 M 15.992 41.250 C 9.066 45.403, 4.912 51.786, 4.671 58.645 L 4.500 63.500 32 63.500 L 59.500 63.500 59.329 58.645 C 59.088 51.786, 54.934 45.403, 48.008 41.250 C 42.804 38.129, 42.168 38, 32 38 C 21.832 38, 21.196 38.129, 15.992 41.250" stroke="none" fill="currentColor" fill-rule="evenodd"/>
                </svg>
            </a>
        </button>
    </div>
</nav>