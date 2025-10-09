<?php

// These two lines of code import our credentials (i.e. the things MySQL needs in order to be authenticated and access the database) and create a connection handle. We use 'require' rather than 'include' because if the fille cannot be found or if PHP can't login to the database, the engine will throw a fatal error and the page won't load.

// `__DIR__` gives us the script's current directory. The `2` then lets us jump two levels up. Finally, the appended path then brings us into the data/ directory, where our connection information is. 
require_once dirname(__DIR__, 2) . '/data/connect.php';
$connection = db_connect();

?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Canadian Cities Queries</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    </head>

    <body class="container p-3">
        <header class="text-center row justify-content-center my-5">
            <section class="col col-md-10 col-xl-8">
                <h1 class="display-3">Canadian Cities Queries</h1>
                <p class="lead">The answers to all of the following questions are being pulled from the records we currently have stored in our database, one query at a time. This is done programatically, using MySQLi to fetch the records and PHP to display the results to the user. Every single time this page is loaded (or reloaded), the queries are run again.</p>
            </section>
        </header>

        <main class="row justify-content-center">
            <section class="col col-md-10 col-lg-8 col-xxl-6">
                <h2 class="display-4">Questions and Answers</h2>

                <h3 class="mt-4">Question 1: Which city has the highest population?</h3>

                <?php
                
                // First, let's write the statement PHP needs to execute.
                $sql = "SELECT city_name FROM cities ORDER BY population DESC LIMIT 1;";

                // We need to actually run the statment and fetch the results.
                $result = mysqli_query($connection, $sql);

                // This checks to see if we got at least one record from the database.
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    echo "<p>The city with the highest population is " . $row['city_name'] . ".</p>";
                } else {
                    echo "<p>No cities found.</p>";
                }

                ?>

                <h3 class="mt-4">Question 2: What are the names of all of the cities stored in our database, in alphabetical order?</h3>

                <?php
                
                $sql = "SELECT city_name FROM cities ORDER BY city_name ASC;";

                $result = mysqli_query($connection, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // We're initialising a simple indexed array here to store all of our records. 
                    $cities = array();

                    // We need to loop through each row in order to get all the names we need. 
                    while ($row = mysqli_fetch_assoc($result)) {
                        $cities[] = $row['city_name'];
                    }

                    // Finally, we can output our results to the user. Here, we're using an array implosion method that takes all of the items in the $cities[] array that we just made and separates them with a comma.
                    echo "<p>The following cities are currently stored in our database: " . implode(', ', $cities) . ".</p>";
                } else {
                    echo "<p>No cities found.</p>";
                }

                ?>

                <h3 class="mt-4">Question 3: Which cities are located in the province of "QC" (Quebec)?</h3>

                <?php
                
                $sql = "SELECT city_name FROM cities WHERE province = 'QC';";
                $result = mysqli_query($connection, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<p>" . $row['city_name'] . "</p>";
                    }
                } else {
                    echo "<p>No cities found.</p>";
                }

                ?>

                <h3 class="mt-4">Question 4: Count the number of cities in each province.</h3>

                <h3 class="mt-4">Question 5: Retrieve the city names and populations for cities with a population greater than 500,000.</h3>

                <h3 class="mt-4">Question 6: Sort the cities in alphabetical order by their names.</h3>

                <h3 class="mt-4">Question 7: Calculate the average population of all cities.</h3>

                <h3 class="mt-4">Question 8: Find the city with the smallest population.</h3>

                <h3 class="mt-4">Question 9: List the cities located in provinces starting with the letter "N".</h3>

                <h3 class="mt-4">Question 10: Retrieve the city names and populations for cities with populations between 100,000 and 500,000.</h3>

                <h3 class="mt-4">Question 11: Retrieve the total population for each province in the "cities" table.</h3>

            </section>
        </main>
    </body>
</html>

<?php

db_disconnect($connection);

?>