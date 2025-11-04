<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="border border-secondary-subtle rounded shadow-sm p-3">

    <h2 class="fs-4 fs-light mb-4">City Details</h2>

    <!-- City Name -->
    <div class="mb-4">
        <label for="city-name" class="form-label">City Name</label>
        <input type="text" id="city-name" name="city-name" class="form-control" value="<?= htmlspecialchars($_POST['city-name'] ?? ($city['city_name'] ?? '')); ?>">
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
                $selected = ($_POST['province'] ?? $city['province'] ?? '') === $key ? 'selected' : '';

                echo "<option value=\"$key\" $selected>$value</option>";
            }
            ?>
        </select>
    </div>

    <!-- Population -->
    <div class="mb-4">
        <label for="population" class="form-label">Population</label>
        <input type="text" id="population" name="population" class="form-control" value="<?= htmlspecialchars($_POST['population'] ?? ($city['population'] ?? '')); ?>">
        <p class="form-text">What is the approximate population of the city?</p>
    </div>

    <!-- Capital City -->
    <fieldset class="mb-4">
        <legend class="fw-normal fs-6">Is this city the capital of its province or territory?</legend>

        <?php
        $capital = $_POST['capital']
            ?? (isset($city['is_capital']) ? ($city['is_capital'] ? '1' : '0') : '0');
        ?>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="capital id="is-capital" value="1" <?= $capital === '1' ? 'checked' : '' ?>>
            <label class="form-check-label" for="is-capital">Yes</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="capital" id="not-capital" value="0" <?= $capital === '0' ? 'checked' : '' ?>>
            <label class="form-check-label" for="not-capital">No</label>
        </div>
    </fieldset>

    <!-- Trivia -->
    <div class="mb-4">
        <label for="trivia" class="form-label">City Trivia (Optional)</label>
        <input type="text" id="trivia" name="trivia" class="form-control" value="<?= htmlspecialchars($_POST['trivia'] ?? ($city['trivia'] ?? '')); ?>">
        <p class="form-text">You may add a fun fact or piece of trivia for your city, in 255 characters or fewer.</p>
    </div>

    <!-- City ID -->
    <input type="hidden" name="city-id" id="city-id" value="<?= htmlspecialchars($_GET['city_id'] ?? $_POST['city-id'] ?? ''); ?>">

    <!-- Submit -->
    <input type="submit" id="submit" name="submit" value="Save" class="btn btn-lg btn-dark my-4">
</form>