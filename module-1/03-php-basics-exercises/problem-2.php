<?php

$title = "Problem 2 - Pythagorean Theorem";
include 'includes/header.php';

$adjacent = 14;
$opposite = 17;

/**
 * Remember that when PHP evaluates an arithmetic expression, the order of operations is applied.
 * 
 * BEDMAS - brackets, exponents, division/multiplication, addition/subtraction
 * 
 * PEMDAS - parenthesis, exponents, multiplcation/division, addition/subtration
 */

$hypotenuse = sqrt($adjacent ** 2 + $opposite ** 2);

// The number that PHP gives us is very long and not terribly user-friendly. We can round the value to two decimal places before we echo it out to the user.
$hypotenuse = round($hypotenuse, 2);

echo "<p>The hypotenuse of a right triangle with an adjacent length of $adjacent and an opposite lenth of $opposite is $hypotenuse.</p>";

?>

<a href="index.php" class="btn btn-outline-primary">Back to Table of Contents</a>

<?php include 'includes/footer.php'; ?>