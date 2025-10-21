<?php

$title = "Browse by Filters";
include 'includes/header.php';

/*
    First, we're going to build a two-dimensional array for: 

        1. all of the filter categories (i.e. which columns can be queried)
        2. the values for each category

    We'll use a range for the categories involving numbers.
*/

$filters = [
    "continent" => [
        1 => "Latin America",
        2 => "North America &amp; Oceania",
        3 => "Western Europe",
        4 => "Middle East",
        5 => "Africa",
        6 => "South Asia",
        7 => "Eastern Europe &amp; Central Asia",
        8 => "East Asia",
    ],
    "life_expectancy" => [
        "50-60" => "50-60 years",
        "60-70" => "60-70 years",
        "70-80" => "70-80 years",
        "80-90" => "80+ years",
    ],
    "wellbeing" => [
        "2-4" => "2-4 out of 10",
        "4-6" => "4-6 out of 10",
        "6-8" => "6-8 out of 10",
    ],
    "eco_footprint" => [
        "0-4" => "0-4 global hectares",
        "4-8" => "4-8 global hectares",
        "8-12" => "8-12 global hectares",
        "12-16" => "12-16 global hectares"
    ]
];

// Next, we'll see if the user chose any filters (i.e. if any filters are active). We'll start by initialising the array that will hold everything.
$active_filters = [];

/*
    All of our filter value will be stored in the query string. This loop processes everything in the query string ($_GET) to:

    1. Extract each filter and its values.

    2. Ensure all values are stored in an array (even if there's only one value).

    (Why? So that we can use methods meant for arrays down below and don't have to worry about other data types.)

    3. Sanitise the values to make the safe for display by preventing malicious input.
*/

foreach ($_GET as $filter => $values) {
    // If any of the values are NOT arrays, let's convert them into one.
    $values = is_array($values) ? $values : [$values];

    // Now, let's sanitise the value. This line uses array_map() with an arrow function (callback) to apply htmlspecialchars() to each element ($v) in $values. 
    $active_filters[$filter] = array_map(fn($v) => htmlspecialchars($v, ENT_QUOTES | ENT_HTML5, 'UTF-8'), $values);
}

function build_query_url($base_url, $filters, $filter, $value) {
    // The function starts by copying the existing filters into a new variable, $updated_filters. This ensures that the original $filters remains unchanged while we modify the copy.
    $updated_filters = $filters;

    /*
        This checks to see if the filter value exists.

        isset($updated_filters[$filter]) --> checks whether the filter key exists in the array.

        in_array($value, $updated_filters[$filter]) --> checks to see if the value is already present for that filter.

        If the filter exists and already includes the value, we need to remove (toggle off) that value.

    */
    if (isset($updated_filters[$filter]) && in_array($value, $updated_filters[$filter])) {
        
    }
}

?>

<h2 class="display-5">Filter The Data</h2>
<p class="lead mb-5">Select any combination of the buttons below to filter the data.</p>

<?php

// We have a two-dimensional array, so we will need two loops to get through everything. The first loop will be for the 'outer' array, or all of the category names.
foreach ($filters as $filter => $options) {
    // We want to print out all of the category names. Because they match our column names, we need to present them in a user-friendly manner. We'll capitalise each word and replace underscores with spaces.
    $heading = ucwords(str_replace("_", " ", $filter));
    echo '<h3 class="fw-light mt-5 mb-1">' . $heading . '</h3>';

    // The inner foreach loop will bring us through all of the values for each of the four categories.
    echo '<div class="btn-group mb-3" role="group" aria-label="' . htmlspecialchars($filter) . ' Filter Group">';
    foreach ($options as $value => $label) {

    }
    echo '</div>';
}

?>

<?php include 'includes/footer.php'; ?>