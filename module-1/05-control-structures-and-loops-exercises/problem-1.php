<?php

$title = "Value Checker";
include 'includes/header.php';

$number = 7;

if ( !is_numeric($number) ) {
    echo "<p>$number is not a numerical value.</p>";
} elseif ($number > 0) { // positive value
    echo "<p>$number is a positive value.</p>";
} elseif ($number < 0) { // negative value
    echo "<p>$number is a negative value.</p>";
} elseif ($number === 0) { // number is zero
    echo "<p>$number is equal to zero.</p>";
} else {
    echo "<p>$number is an unknown data type.</p>";
}

?>

<a href="index.php" class="btn btn-outline-primary">Back to Table of Contents</a>

<?php include 'includes/footer.php'; ?>