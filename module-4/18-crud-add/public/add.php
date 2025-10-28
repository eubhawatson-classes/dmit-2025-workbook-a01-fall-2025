<?php

$title = "Add a City";
$introduction = "To add a city to our database, simply fill out the form below and hit 'Save'.";
include 'includes/header.php';

// If nothing is selected for whether or not the city is a capital, we'll default to 'No' (a value of 0).
$capital = isset($_POST['capital']) ? $_POST['capital'] : '0';

if (isset($_POST['submit'])) {
    $message = '';
    $alert_class = 'alert-danger';

    // We'll call our validation function here. Remember that the array with the provincial abbreviation is in the validation script.
    $validation_result = validate_city_input($_POST['city-name'], $_POST['province'], $_POST['population'], $capital, $_POST['trivia'], $provincial_abbr);

    if ($validation_result['is_valid']) {

        // In this case, the data passed our tests and is good to insert.
        $data = $validation_result['data'];

        // Here, we'll call our function to insert a city using a prepared statement.
        if (insert_city($data['city_name'], $data['province'], $data['population'], $data['capital'], $data['trivia'])) {

            $message = "City added successfully!";
            $alert_class = "alert-success";

            // If we want, we can also clear our inputs after a successful insert to make sure the user doesn't spam-add a record. 
            // $city_name = $province = $population = "";

        } else {
            $message = "There was a problem adding the city: " . $connection->error;
        }

    } else {
        // If the data is invalid, we'll show some errors.
        $message = implode("</p><p>", $validation_result['errors']);
    } // end of validation handling
} // end of 'if the user submitted the form data'

if (isset($message)) : ?>

<div class="alert p-3 <?= $alert_class; ?>" role="alert">
    <p><?= $message; ?></p>
</div>

<?php endif;

include 'includes/form.php';

include 'includes/footer.php'; ?>