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

/**
 * When the user clicks a filter (actually an achor tag that looks like a button), you want to toggle that value: add it if it isn't there, remove it if it is. Then, we need to rebuild the URL query string for that individual filter. 
 * 
 * $base_url - the page you're linking to (filters.php) 
 * $filters - the CURRENT filters already in the URL (an associative array)
 * $filter - the CATEGORY you're toggle (e.g continent, wellbeing ...)
 * $value - the specific VALUE you're toggling (e.g. africa, 6-8 ...)
 */
function build_query_url($base_url, $filters, $filter, $value)
{
    // Grab the current list for this filter and immediately convert everything to strings so comparisons are sane.
    $values = array_map('strval', $filters[$filter] ?? []);

    // Same treatment for the incoming value: it's a strong from here on out.
    $val = (string) $value;

    // Let's do a strict search inside of our array to make sure we only match the thing we expect. The result will be TRUE or FALSE. 
    $position = array_search($val, $values, TRUE);

    if ($position !== FALSE) {
        // If we found our value in our current query string, this means the user is clicking it for a second time and we need to toggle it OFF.
        unset($values[$position]);

        // Reindex so we don't end up with scruffy array keys in the query string.
        $values = array_values($values);
    } else {
        // In our else case, the value is not present yet (i.e. not yet in the query string). We will toggle it ON by appending it to the array.
        $values[] = $val;
    }

    // After toggling our single value, if the list for that filter is empty, we need to delete the filter key entirely. This will keep the URL tidy, our state accurate, and our later checks straightforward.
    if (!empty($values)) { // If the list for this filter still has at least one item ...
        $filters[$filter] = $values; 
    } else { // else, if the list is now empty because we toggled the last item off ...
        unset($filters[$filter]);
    }

    // Turn the filters back into a neat little query string and hand back the full URL.
    return $base_url . '?' . http_build_query($filters);
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
        // Is the option that we're currently generating already active (i.e. has the user previously clicked on it)?
        $is_active = in_array($value, $active_filters[$filter] ?? []);

        // Let's use the custom function from earlier to build a unique href value (incl. query string) for the button we're making.
        $url = build_query_url($_SERVER['PHP_SELF'], $active_filters, $filter, $value);

        echo '<a href="' . $url . '" class="btn ' .
            ($is_active ? 'btn-success' : 'btn-outline-success') . '" aria-pressed="' .
            ($is_active ? 'true' : 'false') . '">' .
            $label . '</a>';
    }

    echo '</div>';
}

// If there are active filters, we'll also give the user a 'clear filters' button. This literally just links to the same page but without a query string.
if (!empty($active_filters)) {
    echo '<div class="my-5"><a href="filters.php" class="btn btn-danger">Clear Filters</a></div>';

    include 'includes/filter-results.php';
}

?>

<?php include 'includes/footer.php'; ?>