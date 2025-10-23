<?php

$sql = "SELECT * FROM happiness_index WHERE 1 = 1";
$types = "";
$parameters = [];

foreach ($active_filters as $filter => $filter_values) {
    // Queries that use a range (i.e. looks for something BETWEEN two values) are handled differently than the condition to look at specific continents. We'll store all of them in their own little array. 
    $range_queries = [];

    if (in_array($filter, ["life_expectancy", "wellbeing", "eco_footprint"])) {

        foreach ($filter_values as $value) {
            // This makes a list (a type of array) out of the range the user chose. It parses everything before the hyphen and after the hyphen to create a $min and a $max value.
            list($min, $max) = explode("-", $value, 2);

            $range_queries[] = "$filter BETWEEN ? AND ?";
            $types .= "dd";
            $parameters[] = $min;
            $parameters[] = $max;            
        }

        if (!empty($range_queries)) {
            $sql .= " AND (" . implode(" OR ", $range_queries) . ")";
        }
    } elseif (array_key_exists($filter, $filters)) {
        // This is for anything that isn't a range query (i.e. continents). First, we'll figure out how many continents the user chose and how many ?s we need.
        $placeholders = str_repeat("?,", count($filter_values) - 1) . "?";
        $sql .= " AND $filter IN ($placeholders)";
        $types .= str_repeat("s", count($filter_values));
        $parameters = array_merge($parameters, $filter_values);
    }
}

if (!empty($active_filters)) {
    $statement = $connection->prepare($sql);

    if ($statement == FALSE) {
        echo "<p>Error retrieving data. Please try again later.</p>";
        exit();
    }

    // TO DO: splat the params

    $result = $statement->get_result();

    echo '<h2 class="display-4 mt-5 mb-4">Results</h2>';

    // Now, let's generate our cards.
    if ($result->num_rows > 0) {
        echo '<div class="row">';

        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-6 col-xl-4">';
            include 'includes/country-card.php';
            echo '</div>';
        }

        echo '</div>';
    } else { // if there were 0 results
        echo '<p>We were not able to find anything matching your selected filters.</p>';
    }

}

/*
    DEBUG BLOCK

    echo "<p>" . $sql . "<p>";
    var_dump($parameters);
    echo "<p>" . $types . "<p>";
*/ 
 
?>