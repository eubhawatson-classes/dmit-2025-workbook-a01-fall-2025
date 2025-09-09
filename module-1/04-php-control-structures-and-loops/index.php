<!doctype html>
<html lang="en">

<head>
  <!-- Required Meta Tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Comparison Operators, Logical Operators, Control Structures, & Loops</title>

  <!-- BS CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="container text-center">
  <section class="row justify-content-center">
    <div class="col-lg-8">
      <h1 class="display-5 my-5">Comparison Operators, Logical Operators, Control Structures, & Loops</h1>

      <h2 class="display-6 my-5">Comparison Operators</h2>
      <p class="lead">Used to compare two values (e.g., <code>==</code>, <code>!=</code>, <code>&lt;</code>, <code>&gt;</code>), returning <code>true</code> or <code>false</code>.</p>

      <?php

      // This is an assignment statement. We are assigning a value to something (in this case, a variable). It is a single = sign.
      $x = 6;

      // With an IF statement, we can check to see if an expression is evaluated as TRUE; if it is, we can execute some code inside of a block (i.e. between curly braces). If not, that code will be ignored.
      if ($x == 6) { // The double-equals sign (==) checks for equality.
        echo "<p>X is 6.</p>";
      }

      // This checks to see if these two things have the same values AND the same data type. It is stricter, but can help prevent weird data typing errors from happening.
      if ($x === 6) {
        echo "<p>X is 6 and it is the same data type.</p>";
      }

      // We can also check to see if two values are NOT equal with the negation operator.
      if ($x != 5) {
        echo "<p>X is not equal to 5.</p>";
      }

      // In PHP, != can also be written as: <>
      if ($x <> 4) {
        echo "<p>X is not equal to 4.</p>";
      }

      // Let's try a comparison operator! This is 'greater than'.
      if ($x > 5) {
        echo "<p>X is greater than 5.</p>";
      }

      // We can also see if a value is greater than or equal to another.
      if ($x >= 6) {
        echo "<p>X is greater than or equal to 6.</p>";
      }

      // Let's try 'less than' next!
      if ($x < 10) {
        echo "<p>X is less than 10.</p>";
      }

      // Now, 'less than or equal to'.
      if ($x <= 7) {
        echo "<p>X is less than or equal to 7.</p>";
      }

      ?>

      <h2 class="display-6 my-5">Logical Operators</h2>
      <p class="lead">Combine multiple conditions using <code>&amp;&amp;</code> (AND), <code>||</code> (OR), and <code>!</code> (NOT).</p>

      <?php

      // With the AND operator, all parts of the statement must be TRUE.
      if ($x > 2 && $x < 10) {
        echo "<p>X is greater than 2 <strong>AND</strong> less than 10; both parts must be TRUE.</p>";
      }

      // With the OR operator, at least one part of the statement must be TRUE.
      if ($x > 2 || $x < 4) {
        echo "<p>X is greater than 2 <strong>OR</strong> less than 4; at least one part of this statement must be TRUE,</p>";
      }

      // With XOR (exclusive OR), exactly one part of the statement must be TRUE.
      if ($x > 2 xor $x < 10) {
        echo "<p>X is either greater than 2 <strong>OR<strong> less than 10; only one of these statements is allowed to be true.</p>";
      }

      ?>

      <h2 class="display-6 my-5">Control Structures</h2>
      <p class="lead">Direct the flow of your program based on conditions.</p>

      <h3 class="my-3">Nested If/Else Block</h3>
      <p class="lead">An <code>if</code> or <code>else</code> statement placed inside another to check multiple layers of conditions.</p>

      <?php

      $x = "This variable is a string now.";

      if ($x === 5) {
        $message = "<p>X is 5.</p>";
      } elseif ($x === 6) {
        $message = "<p>X is 6.</p>";
      } elseif (is_numeric($x) && ($x < 10 || $x > 12)) {
        /**
         * Because of PHPs type juggling (i.e. it mutates a variable's data type on the fly), PHP will convert a string to a numeric value when trying to evaluate using a comparison operator (< or >).
         * 
         * In this case, a non-numeric string is converted to the number 0. So:
         * 
         * $x = "This variable is a string now." -> is coerced to 0.
         * 
         * ($x < 10 || $x > 12) -> (0 < 10) is TRUE -> overall condition is TRUE
         * 
         * To fix this, we need to add an extra step: is this numeric? Then, we can compare our values.
         * 
         * is_numeric() -> This method returns TRUE or FALSE depending upon whether the argument passed into it is a number or not a number.
         */
        $message = "<p>X is a number, and it is less than 10 or greater than 12.</p>";
      } else {
        $message = "<p>X is not equal to 5 or 6, and it is not less than 10 or greater than 12.</p>";
      }

      // isset() -> This method returns TRUE or FALSE depending upon if the value passing into it exists, is initialised, or (if it's a variable) is assigned a value. 
      if (isset($message)) {
        echo $message;
      }

      ?>

      <h3 class="my-3">Switch Statement</h3>
      <p class="lead">A cleaner way to check a single variable against many possible values using <code>switch</code> and <code>case</code>.</p>

      <?php

      // With switch statements, we start off with what sort of outcome we're looking for.
      switch (TRUE) {

        // Next, we present a case (i.e. a condition that we're checking).
        case $x === 5:
          $message = "<p>X is 5.</p>";
          // If the condition is met, we need to 'break' in order to exit the structure. If we do not break, then we do not exit the switch statement when we should and we keep evaluation subsequent cases.
          break;

        case $x === 6:
          $message = "<p>X is 6.</p>";
          break;

        // Up above, we used an OR operator to check two condition together. We'll use a fall-through case to evaluate multiple things at once. 
        case $x < 10:
        case $x > 12:
          $message = "<p>X is less than 10 or greater than 12.</p>";
          break;

        // If none of our cases are TRUE, we need a default case (equivalent to ELSE).
        default:
          $message = "<p>X is not equal to 5 or 6, and it is not less than 10 or greater than 12.</p>";
          break;
      }

      if (isset($message)) {
        echo $message;
      }

      ?>

      <h3 class="my-3">PHP 8+ Alternative: <code>match</code> Expression</h3>
      <p class="lead">A more concise and safer alternative to <code>switch</code>, introduced in PHP&nbsp;8, using the <code>match</code> expression.</p>

      <?php

      /**
       * This is a match expression. It returns a value, uses strict comparisons, and has concise syntax; however, it is functionally the same as nested-ifs and switch statements. 
       * 
       * Whater you put in the parenthesis is the thing you're 'matching' against each arm. It could be a variable, the literal TRUE, or even a functional call. 
       * 
       * Each line inside of the curly braces is called an arm. An arm has two parts, spearated by tthe arrow => :
       * 
       * 1. condition (or pattern) on the left
       * 2. result expression on the right
       * 
       * As soon as PHP finds the first arm whose condition "matches", it returns that arm's result and exits the structure.
       */

      // This match expression is identical to the switch case above.
      $message = match (TRUE) {
        $x === 5         => "<p>X is 5.</p>",
        $x === 6         => "<p>X is 6.</p>",
        $x < 10, $x > 12 => "<p>X is less than 10 or greater than 12.</p>",
        default          => "<p>X is not equal to 5 or 6, and it is not less than 10 or greater than 12.</p>",
      };

      if (isset($message)) {
        echo $message;
      }

      ?>

      <h2 class="display-6 my-5">Loops</h2>
      <p class="lead">Repeat blocks of code while a condition is <code>true</code>.</p>

      <h3 class="my-3">While Loop</h3>
      <p class="lead">Repeats code as long as a condition stays <code>true</code>, checking the condition <em>before</em> each run.</p>

      <?php
      
      /**
       * Loops need at least three things to work properly (and not get stuck in an infinite loop):
       * 
       * 1. An inital value; this usually counts how many times we've gone through a loop.
       * 
       * 2. Some sort of exit condition; if this condition is met, the interpreter will exit the loop.
       * 
       * 3. Some sort of change where the condition can approach FALSE; this is usually an increment (++) or decrement (--).
       */

      ?>

      <h3 class="my-3">Do/While Loop</h3>
      <p class="lead">Runs code <em>at least once</em>, then keeps looping if the condition is still <code>true</code>.</p>

      <h3 class="my-3">For Loop</h3>
      <p class="lead">Repeats code a specific number of times using a counter: <code>for (start; condition; update)</code>.</p>

      <h3 class="my-3">For Each Loop</h3>
      <p class="lead">Loops through each item in an array using <code>foreach ($array as $item)</code>.</p>
    </div>
  </section>
</body>

</html>