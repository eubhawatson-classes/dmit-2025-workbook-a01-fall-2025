<?php

/* VARIABLES */

// We'll use this array to generate all of the option we need on our add and edit pages (and once again when validating provincial input). This way, the user can see the long form name of the province and the database will receive the proper two-character abbreviation.
$provincial_abbr = [
    'AB' => 'Alberta',
    'BC' => 'British Columbia',
    'MB' => 'Manitoba',
    'NB' => 'New Brunswick',
    'NL' => 'Newfoundland',
    'NT' => 'Northwest Territories',
    'NS' => 'Nova Scotia',
    'NU' => 'Nunuvut',
    'ON' => 'Ontario',
    'PE' => 'Prince Edward Island',
    'QC' => 'Quebec',
    'SK' => 'Saskatchewan',
    'YT' => 'Yukon Territories'
];


/* RESULTS TABLE */

/**
 * This function fetches all of the cities in our database and prints them out in an HTML table.
 * Note: We will add some parameters later on when we need it for our Edit and Delete pages.
 * @return void (because this function prints a table and handles potential errors on its own)
 */
function generate_table() {
    // Let's start by calling the function to retrieve all cities.
    $cities = get_all_cities();

    // If we got at least one record back, we'll spit out a table.
    if (count($cities) > 0) {

        echo "<table class=\"table table-bordered table-hover\"> \n
              <thead> \n
              <tr class=\"table-dark\"> \n
              <th scope=\"col\">City Name</th> \n
              <th scope=\"col\">Population</th> \n
              <th scope=\"col\">Trivia</th> \n
              </tr> \n
              </thead> \n
              <tbody> \n";

        foreach ($cities as $city) {
            extract($city);

            $capital = ($is_capital) ? '&starf;' : '';
            $trivia_info = ($trivia != NULL) ? "<i class=\"bi bi-info-circle\" data-bs-toggle=\"tooltip\" title=\"$trivia\"></i>" : "";
            $population = number_format($population);

            echo "<tr> \n
                  <td>$capital $city_name, $province</td> \n
                  <td>$population</td> \n
                  <td>$trivia_info</td> \n
                  </tr> \n";
        }

        echo "</tbody> \n
              </table> \n
              <aside> \n
              <h3 class=\"fs-5 fw-normal\">Notes</h3> \n
              <p class=\"text-muted my-3\">&starf; indicates the capital of a province or territory.</p> \n
              <p class=\"text-muted my-3\">Hover over <i class=\"bi bi-info-circle\" data-bs-toggle=\"tooltip\" title=\"I'm a tooltip!\"></i> to see additional trivia about the city.</p> \n
              </aside> \n";

    } else {
        echo "<h2 class=\"fw-light\">Oh no!</h2>";
        echo "<p>We're sorry, but we weren't able to find anything.</p>";
    }
}


/* DATA VALIDATION */

/**
 * This will validate our user input on the add and edit pages of our application.
 * 
 * @param string $city_name
 * @param string $province
 * @param int $population
 * @param int $capital (boolean, passed as a TINY INT)
 * @param string $trivia (optional; may be left NULL)
 * @param array $provincial_abbr
 * @return array 
 */
function validate_city_input($city_name, $province, $population, $capital, $trivia, $provincial_abbr) {

    global $connection;
    $errors = [];
    $validated_data = [];

    // Validate city name
    $city_name = trim($city_name);
    if (empty($city_name)) {
        $errors[] = "City name is required.";
    } elseif (strlen($city_name) < 2 || strlen($city_name) > 36) {
        $errors[] = "City name must be between 2 and 30 characters.";
    } elseif (preg_match('/["\']/', $city_name)) { // Sanitize quotes
        $city_name = mysqli_real_escape_string($connection, $city_name);
    }

    $validated_data['city_name'] = $city_name;

    // Validate province
    if (empty($province)) {
        $errors[] = "Province is required.";
    } elseif (!array_key_exists($province, $provincial_abbr)) {
        $errors[] = "Invalid province selected.";
    }

    $validated_data['province'] = $province;

    // Validate population
    $population = filter_var($population, FILTER_SANITIZE_NUMBER_INT);
    if (empty($population)) {
        $errors[] = "Population is required.";
    } elseif (!filter_var($population, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
        $errors[] = "Population must be a positive number.";
    }

    $validated_data['population'] = $population;

    // Validate capital
    if (isset($capital)) {
        if ($capital !== '1' && $capital !== '0') {
            $errors[] = "Invalid selection for capital.";
        } else {
            // Convert the value to a boolean: true if '1', false if '0'.
            $validated_data['capital'] = ($capital === '1');
        }
    } else {
        // Default to 0 (or false) if no selection is made.
        $validated_data['capital'] = 0;
    }

    // Validate trivia (this field is optional)
    $trivia = trim($trivia);
    if (!empty($trivia)) {
        if (strlen($trivia) > 255) {
            $errors[] = "City trivia must be 255 characters or fewer.";
        }
        // Use mysqli_real_escape_string to help sanitize input before database insertion.
        $validated_data['trivia'] = mysqli_real_escape_string($connection, $trivia);
    } else {
        $validated_data['trivia'] = null;
    }

    // A function can only return one value, so we're packing a few things into an array.
    return [
        'is_valid' => empty($errors),
        'errors' => $errors,
        'data' => $validated_data
    ];

}
?>