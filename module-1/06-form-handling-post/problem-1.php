<?php

$title = "Even or Odd";
include 'includes/header.php';

// This is a ternary statement. It says 'if the user already gave a number, let's use that number for this variable; if they haven't, let's initialise this variable with an empty value'.
$number = isset($_POST['number']) ? trim($_POST['number']) : '';

/* This ternary statement is the equivalent of:

if (isset($_POST['number'])) {
    $number = $_POST['number'];
} else {
    $number = '';    
}

*/

$message = '';

?>

<p class="lead mb-5">Enter a whole number below and hit "Submit" to see whether it is odd or even.</p>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="my-5">
    <div class="mb-3">
        <label for="number" class="form-label">Enter a Number:</label>
        <input type="number" id="number" name="number" step="1" class="form-control" value="<?= $number; ?>" required>
    </div>

    <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
</form>

<?php

if (isset($_POST['submit'])) {

    // Let's start by seeing if the user gave us a number.
    if ($number === '') {
        
        $message = "<p class=\"fs-2 text-danger\">Please enter a value.</p>";

    } elseif (filter_var($number, FILTER_VALIDATE_INT) !== FALSE) { // This method filters a variable (in this case, $number) based upon the rules in a given list.
        
        $number = (int) $number;
        
        if ($number % 2 == 0) { // If there is a remainder of 0, we have an even number.
            $message = "<p class=\"fs-2 text-success\">$number is an <strong>even</strong> number.</p>";
        } else { // If there is a remainder, the number is odd.
            $message = "<p class=\"fs-2 text-success\">$number is an <strong>odd</strong> number.</p>";
        }

    } else { // If the value is not numeric, we'll tell the user here.
        $message = "<p class=\"fs-2 text-danger\">Please enter a whole number.</p>";
    }
}

if ($message != '') {
    echo $message;
}

?>

<a href="index.php" class="btn btn-outline-primary">Back to Table of Contents</a>

<?php include 'includes/footer.php'; ?>