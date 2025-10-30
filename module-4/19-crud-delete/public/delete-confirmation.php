<?php

/**
 * There are three potential states this page can be in:
 * 
 * 1. The user has just selected a city to delete.
 * 2. The user has successfully deleted a city.
 * 3. Error state (there is information missing from the query string, or the deletion process went awry).
 */

$title = "Delete Confirmation";
$introduction = "";
include 'includes/header.php';

// Because we're using the GET method, remember that the user can muck around with the query string. To prevent any weirdness, we'll check to make sure the city ID is valid.
$city_id = filter_input(INPUT_GET, 'city', FILTER_VALIDATE_INT);
$city_name = filter_input(INPUT_GET, 'city_name', FILTER_SANITIZE_SPECIAL_CHARS);

$message = "";

if (!$city_id || !$city_name) {
    $message = "<p>Please return to the delete page and select an option from the table.</p>";
}

// TODO: Let's handle the deletion here.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hidden_id = filter_input(INPUT_POST, 'hidden-id', FILTER_VALIDATE_INT);
    $hidden_name = filter_input(INPUT_POST, 'hidden-name', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($hidden_id) {
        // Call the delete a city function.
        delete_city($hidden_id);

        $message = "<p>" . urldecode($hidden_name) . " was deleted from the database.</p>";
        $city_id = NULL;
    }
}

if ($message != "") : ?>

    <div class="alert alert-danger text-center" role="alert">
        <?= $message; ?>
    </div>

<?php endif;

// If the user has just selected a city from the delete page, they'll have the city_id in their query string. In that case, we'll give them the big red delete button.
if ($city_id) : ?>

    <p class="text-danger lead mb-5 text-center">Are you sure that you want to delete <?= urldecode($city_name); ?> ?</p>

    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="text-center">
        <input type="hidden" name="hidden-id" id="hidden-id" value="<?= $city_id; ?>">
        <input type="hidden" name="hidden-name" id="hidden-name" value="<?= $city_name; ?>">

        <!-- Submit Button -->
        <input type="submit" name="confirm" id="confirm" value="Yes, I'm sure." class="btn btn-danger">
    </form>

<?php endif; ?>

<a href="delete.php" class="text-link">Return to 'Delete A City' Page</a>

<?php include 'includes/footer.php'; ?>