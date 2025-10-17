<?php

$title = "Search";
include 'includes/header.php';

include 'includes/continents-key.php';

// Country Name Search
$country_search = isset($_GET['country-search']) ? trim(($_GET['country-search'])) : "";

// Selected Continents
$selected_continents = isset($_GET['continents']) ? $_GET['continents'] : array();

// Wellbeing Variables
$wellbeing_comparison = isset($_GET['wellbeing-comparison']) ?? '';
$wellbeing_value = isset($_GET['wellbeing-value']) ?? '';

// Life Expectancy Variables
$min = $_GET['life-expectancy-min'] ?? 50;
$max = $_GET['life-expectancy-max'] ?? 90;

?>

<!-- Introduction Area -->
<h2 class="display-5">Search Our Data</h2>
<p class="mb-5">Explore our data below by country name, contients, wellbeing score, and average lifespan. To get started, pick the options you'd like to use, and click the "Search" button. This will show you the filtered results based upon what you selected.</p>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET" class="mb-5 border border-success p-3 rounded shadow-sm">
    <h3 class="display-6">Advanced Search</h3>

    <!-- Country Name Search -->
     <fieldset class="my-5">
        <legend class="fs-5">Search By Country</legend>

        <div class="mb-3">
            <label for="country-search" class="form-label">Enter country name:</label>
            <input type="text" id="country-search" name="country-search" class="form-control" value="<?= $country_search; ?>">
        </div>
     </fieldset>

    <!-- Continents -->
     <fieldset class="my-5">
        <legend class="fs-5">Filter by Continent</legend>
        <p>Only show results from the following continent(s):</p>

        <!-- This is our default value. It is empty. If the user chooses this, we will omit continent from our query (as we want to include them all and NOT EXCLUDE anything in this column). -->
        <div class="form-check">
            <input type="checkbox" id="contient-all" name="continents[]" value="" class="form-check-input" <?= in_array("", $selected_continents) ? 'checked' : ""; ?>>
            <label for="contient-all" class="form-check-label">All Continents</label>
        </div>

        <!-- Now, let's loop through each continent in our key to create a checkbox. -->
        <?php foreach ($continents_key as $id => $name) : ?>
            <div class="form-check">
                <input type="checkbox" id="continent-<?= $id; ?>" name="continents[]" value="<?= $id; ?>" class="form-check-input" <?= in_array((string) $id, $selected_continents) ? "checked" : "" ?> >
                <label for="continent-<?= $id; ?>" class="form-check-label"><?= $name; ?></label>
            </div>
        <?php endforeach; ?>
     </fieldset>

    <!-- Wellbeing -->
     <fieldset class="my-5">
        <legend class="fs-5">By Wellbeing</legend>

        <!-- This is going to determine our comparison operator. We cannot directly pass '>' '>' into a query due to htmlspecialchars() and the sanitation these form values go through. Therefore, we're using stand-in strings, which we'll convert ourselves later on in the process. -->
        <div class="mb-3">
            <label for="wellbeing-comparison" class="form-label">Only show countries with a score:</label>
            <select name="wellbeing-comparison" id="wellbeing-comparison" class="form-select">
                <option value="greater" <?php if ($wellbeing_comparison == "above") echo "selected"; ?> >above</option>
                <option value="less" <?php if ($wellbeing_comparison == "below") echo "selected"; ?> >below</option>
            </select>
        </div>

        <!-- This will be the number for the wellbeing value. -->
        <div class="mb-3">
            <label for="wellbeing-value" class="form-label">the following value:</label>
            <input type="number" id="wellbeing-value" name="wellbeing-value" min="1" max="10" value="<?= $wellbeing_value; ?>" class="form-control">
        </div>
     </fieldset>

    <!-- Average Life Expectancy -->
     <fieldset class="my-5">
        <legend class="fs-5">Life Expectancy Range</legend>

        <!-- Minimum Age -->
         <div class="mb-3">
            <label for="life-expectancy-min" class="form-label">Show results with a minimum life expectancy of:</label>
            <input type="number" id="life-expectancy-min" name="life-expectancy-min" value="<?= $min; ?>" min="50" max="90" class="form-control">
         </div>

        <!-- Maximum Age -->
         <div class="mb-3">
            <label for="life-expectancy-max" class="form-label">and a maximum life expectancy of:</label>
            <input type="number" id="life-expectancy-max" name="life-expectancy-max" value="<?= $max; ?>" min="50" max="90" class="form-control">
         </div>
     </fieldset>

    <!-- Submit -->
    <div class="mb-3">
        <input type="submit" id="submit" name="submit" class="btn btn-success" value="Search">
    </div>
</form>

<!-- Results -->
<?php

/*
    If the user chose to include everything, their query would look something like this:

    SELECT * FROM happiness_index WHERE 1 = 1
    AND country LIKE '%$country'
    AND continent IN ($continents)
    AND wellbeing (> or <) $wellbeing_value
    AND life_expectancy BETWEEN $min AND $max;
*/

?>


<?php include 'includes/footer.php'; ?>