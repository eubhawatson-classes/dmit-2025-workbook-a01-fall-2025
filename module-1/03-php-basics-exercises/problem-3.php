<?php

$title = "Problem 3 - Four-Digit Sums";
include 'includes/header.php';

/**
 * We could solve this mathematically; however, PHP is a weak-typed language. This means that the data type of a variable can mutate throughout the flow of the program.
 * 
 * In PHP, a string is actually an array of characters. We're going to create a string and add each of its values together.
 */

$string = '1234';

$total = $string[0] + $string[1] + $string[2] + $string[3];

echo "<p>The sum of each individual value in $string is $total.</p>";

?>

<form action="problem-3.php" method="POST">
    <label for="num-string">Please enter a number:</label>
    <input type="number" id="num-string" name="num-string">

    <input type="submit" id="submit" name="submit" value="Submit">
</form>


<a href="index.php" class="btn btn-outline-primary">Back to Table of Contents</a>

<?php include 'includes/footer.php'; ?>