<?php

$title = "Temperature Converter";
include 'includes/header.php';

$temperature = isset($_POST['temperature']) ? trim($_POST['temperature']) : '';
$direction = isset($_POST['direction']) ? $_POST['direction'] : '';
$message = '';

?>

<p class="lead mb-5">Use to the form below to conver temperatures between Celsius and Fahrenheit.</p>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <!-- Temperature Value (Number) -->
     <div class="mb-4">
        <label for="temperature" class="form-label">Temperature:</label>
        <input type="number" name="temperature" id="temperature" class="form-control" placeholder="Please enter a number." value="<?= $temperature; ?>">
     </div>

    <!-- Direction (C to F || F to C) -->
     <fieldset class="mb-4">
        <legend class="fw-normal fs-6">Conversion Type</legend>

        <div class="form-check">
            <input type="radio" name="direction" id="c-to-f" value="c-to-f" class="form-check-input" <?php echo $direction === 'c-to-f' ? 'checked' : ''; ?>>
            <label for="c-to-f">Celcius to Fahrenheit</label>
        </div>
        <div class="form-check">
            <input type="radio" name="direction" id="f-to-c" value="f-to-c" class="form-check-input" <?php echo $direction === 'f-to-c' ? 'checked' : ''; ?>>
            <label for="f-to-c">Fahrenheit to Celcius</label>
        </div>
     </fieldset>

     <!-- Form Submission -->
      <div class="mb-3">
        <input type="submit" name="submit" id="submit" value="Convert" class="btn btn-primary">
      </div>
</form>

<?php

if (isset($_POST['submit'])) {
    // We'll do some super basic validation here again.
    if ($temperature === '') {
        $message = "<p class=\"fs-2 text-danger\">Please enter a temperature.</p>";
    } elseif (!is_numeric($temperature)) {
        $message = "<p class=\"fs-2 text-danger\">Please enter a valid number.</p>";
    }
    // Next, let's make sure to validate the conversion direction.
    elseif (!in_array($direction, ['c-to-f', 'f-to-c'], TRUE)) {
         $message = "<p class=\"fs-2 text-danger\">Please select a conversion type.</p>";
    } else {
        $temperature = (float) $temperature;

        if ($direction === 'c-to-f') {
            $result = ($temperature * 9 / 5) + 32;
            $message = "<p class=\"fs-2 text-success\">{$temperature}&deg;C is <strong>" . round($result, 2) . "</strong>&deg;F.</p>";
        } else {
            $result = ($temperature - 32) * 5 / 9;
            $message = "<p class=\"fs-2 text-success\">{$temperature}&deg;F is <strong>" . round($result, 2) . "</strong>&deg;C.</p>";
        }
    }
}

if ($message != '') {
    echo $message;
}

?>

<a href="index.php" class="btn btn-outline-primary">Back to Table of Contents</a>

<?php include 'includes/footer.php'; ?>