<?php

$title = "Edit a City";
$introduction = "To edit a city to our database, click 'Edit' beside the city you would like to change. Next, add your updated values into the form and hit 'Save'.";
include 'includes/header.php';

// We need to initalise a bunch of variables because we're dealing with multiple sets of data. We'll start by checking to see if there's a primary key in the query string. 
$city_id = $_GET['city_id'] ?? $_POST['city-id'] ?? '';

// NOTE: We should also sanitize everything here.
$city_id = filter_var($city_id, FILTER_VALIDATE_INT);

// If there's a primary key (i.e. if the user has chosen a city to edit), we need to fetch the details for that record (i.e. the values that already exist in the database.)
$city = $city_id ? select_city_by_id($city_id) : null;

// Here, we'll initialise the variables for all of the pre-existing values for the city.
$existing_city_name = $city['city_name'] ?? '';
$existing_province = $city['province'] ?? '';
$existing_population = $city['population'] ?? '';
$existing_capital = $city['is_capital'] ?? '0';
$existing_trivia = $city['trivia'] ?? '';

// Next, we'll define the variables for all of the values form the user (i.e. whatever they give us in the form).
$user_city_name = $_POST['city-name'] ?? '';
$user_province = $_POST['province'] ?? '';
$user_population = $_POST['population'] ?? '';
$user_capital = $_POST['capital'] ?? '0';
$user_trivia = $_POST['trivia'] ?? '';

$message = "";
$alert_class = "alert-danger";

// If the user has submitted the form (hit 'save' after editing), we need to validate their input and try updating the record in the database.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validation_result = validate_city_input($user_city_name, $user_province, $user_population, $user_capital, $user_trivia, $provincial_abbr);

    if ($validation_result['is_valid']) {

        $validated_data = $validation_result['data'];

        // If the data is good, we will try to update.
        if (update_city($validated_data['city_name'], $validated_data['province'], $validated_data['population'], $validated_data['capital'], $validated_data['trivia'], $city_id)) {

            $alert_class = "alert-success";
            $message = $validated_data['city_name'] . " was updated successfully.";

        } else {
            $message = "There was an error updating the city.";
        }

    } else {
        // If the data is not valid, we'll give the user errors.
        $message = implode("</p><p>", $validation_result['errors']);
    } 
}

// This is our validation message block.
if ($message != "") : ?>

<div class="alert <?= $alert_class; ?> my-5" role="alert">
    <p><?= $message; ?></p>
</div>

<?php endif;

// If the city ID is set (if the user chose a city to edit), we'll show the user the form. This should high up enough on the page for the user to see (and avoid potential confusion).
if ($city_id) : ?>

<h2 class="fw-light mb-3">Editing <?= $existing_city_name; ?></h2>

<?php include 'includes/form.php'; ?>

<?php endif;

// This will generate the table that the user sees when they load the page.
echo "<h2 class=\"fw-light mt-5 mb-3\">Current Cities in our Database</h2>";

generate_table(function($city) {
    $cid = $city['cid'];
    return "<a href=\"edit.php?city_id=" . urlencode($cid) . "\" class=\"btn btn-warning\">Edit</a>";
});

include 'includes/footer.php'; ?>