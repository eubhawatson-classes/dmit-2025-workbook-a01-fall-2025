<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="border border-secondary-subtle rounded shadow-sm p-3">

<h2 class="fs-4 fs-light mb-4">City Details</h2>

<!-- City Name -->
 <div class="mb-4">
    <label for="city-name" class="form-label">City Name</label>
    <input type="text" id="city-name" name="city-name" class="form-control" value="<?php if (isset($_POST['city-name'])) echo $_POST['city-name']; ?>">
    <p class="form-text">What is the name of your city, town, or village?</p>
 </div>

<!-- Province or Territory -->
 <div class="mb-4">
    <label for="province" class="form-label">Province or Territory</label>
    <select name="province" id="province" class="form-select">
        <!-- We'll use a default option here; otherwise, the user might forget to choose a province and submit the first item in the array by mistake. -->
        <option value="">-- Please Select --</option>
        <?php
            // Let's generate the rest of the options for the user. We'll also check to see if they previously selected a province. 
            foreach ($provincial_abbr as $key => $value) {
                $selected = isset($_POST['province']) && $_POST['province'] == $key ? 'selected' : '';

                echo "<option value=\"$key\" $selected>$value</option>";
            }
        ?>
    </select>
 </div>

<!-- Population -->
 <div class="mb-4">
    <label for="population" class="form-label">Population</label>
    <input type="text" id="population" name="population" class="form-control" value="<?php if (isset($_POST['population'])) echo $_POST['population']; ?>">
    <p class="form-text">What is the approximate population of the city?</p>
 </div>

<!-- Capital City -->
 <fieldset class="mb-4">
    <legend class="fw-normal fs-6">Is this city the capital of its province or territory?</legend>

    <div class="form-check">
        <input type="radio" id="is-capital" name="capital" value="1" class="form-check-input" <?= (isset($_POST['capital']) && $_POST['capital'] === '1') ? 'checked': ''; ?>>
        <label for="is-capital" class="form-check-label">Yes</label>
    </div>

    <div class="form-check">
        <input type="radio" id="not-capital" name="capital" value="0" class="form-check-input" <?= (isset($_POST['capital']) && $_POST['capital'] === '0') ? 'checked': ''; ?>>
        <label for="not-capital" class="form-check-label">No</label>
    </div>
 </fieldset>

<!-- Trivia -->
 <div class="mb-4">
    <label for="trivia" class="form-label">City Trivia (Optional)</label>
    <input type="text" id="trivia" name="trivia" class="form-control" value="<?php if (isset($_POST['trivia'])) echo $_POST['trivia']; ?>">
    <p class="form-text">You may add a fun fact or piece of trivia for your city, in 255 characters or fewer.</p>
 </div>

<!-- Submit -->
 <input type="submit" id="submit" name="submit" value="Save" class="btn btn-lg btn-dark my-4">
</form>