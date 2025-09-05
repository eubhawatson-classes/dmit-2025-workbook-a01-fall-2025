<?php

$title = "Problem 1 - Swapping Variable Values";
include 'includes/header.php';

$number_1 = 5;
$number_2 = 6;

echo "<p>The first number is $number_1; the second number is $number_2.</p>";

$number_3 = $number_1;
$number_1 = $number_2;
$number_2 = $number_3;

echo "<p class=\"fw-bold\">The first number is $number_1; the second number is $number_2.</p>";

?>

<a href="index.php" class="btn btn-outline-primary">Back to Table of Contents</a>

<?php include 'includes/footer.php'; ?>