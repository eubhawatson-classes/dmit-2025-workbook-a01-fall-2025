<?php

$title = "Banana Oatmeal Muffins";
include 'includes/header.php';
include 'includes/conversions.php';

// Based upon what option(s) the user chose, we can now set our multiplier or coefficient for our ingredient quantities. We'll use a filter here, which just double-checks to make sure that whatever number they gave us was an integer. This is an important step with the $_GET method because the user can muck around with any values in the query string.
$recipe_yield = filter_input(
    INPUT_GET,
    'servings',
    FILTER_VALIDATE_INT,
    [
        'options' => [
            'default'   => 12,
            'min_range' => 1,
        ]        
    ]
);

// The base recipe is for 12 muffins, so we'll figure out our multiplier by dividing it by 12.
$multiplier = $recipe_yield / 12;

// Our oven temperature is either 325ºF or 165ºC, depending upon what the user selects. We'll use Celsius as our default. 
$temperature_units = isset($_GET['temperature']) ? htmlspecialchars($_GET['temperature']) : 'C';
$oven_temperature = ($temperature_units == 'C') ? '165&deg;C' : '325&deg;F';

?>

<!-- Introduction, Form & Input -->
<section class="mb-5">
    <div class="card shadow-sm">
        <h2 class="card-header text-bg-dark fw-light">Recipe Settings</h2>

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET" class="p-5">
            <!-- Recipe Yield -->
             <div class="mb-3">
                <label for="servings" class="form-label">How many muffins would you like to make?</label>
                <input type="number" id="servings" name="servings" step="1" min="1" class="form-control" value="<?= htmlspecialchars($recipe_yield); ?>">
                <p class="form-text">The original recipe makes 12 muffins. Enter any positive whole number to adjust the yield.</p>
             </div>

            <!-- Temperature -->
            <fieldset class="mb-3">
                <legend class="fs-5">Temperature Units</legend>

                <input type="radio" class="btn-check" name="temperature" id="temperature-c" value="C" <?php if ($temperature_units == 'C') echo 'checked'; ?>>
                <label for="temperature-c" class="btn btn-sm btn-outline-primary">Celsius</label>

                <input type="radio" class="btn-check" name="temperature" id="temperature-f" value="F" <?php if ($temperature_units == 'F') echo 'checked'; ?>>
                <label for="temperature-f" class="btn btn-sm btn-outline-primary">Fahrenheit</label>
            </fieldset>

            <hr class="my-4">

            <!-- Submit -->
            <input type="submit" id="submit" name="submit" value="Save Settings" class="btn btn-primary">
        </form>
    </div>
</section>

<!-- Ingredients List -->
 <section class="mb-5">
    <h2 class="mb-3">Ingredients</h2>

    <ul class="list-group">
        <?php foreach($ingredients as $ingredient) : ?>
            <li class="list-group-item">
                <?= round($ingredient['base_quantity'] * $multiplier, 2); ?>
                <?= $ingredient['unit']; ?>
                <?= $ingredient['name']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
 </section>

<!-- Directions -->

<?php include 'includes/footer.php'; ?>