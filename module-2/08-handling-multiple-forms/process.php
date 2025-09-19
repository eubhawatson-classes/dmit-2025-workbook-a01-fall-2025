<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nums = array();

    for ($i = 1; $i <= $set_length; $i++) {
        $nums[] = $_POST["num-{$i}"];
    }

    /* MEAN */

    // This sorts an array of numbers in ascending order.
    sort($nums);

    // This counts the number of elements in an array. (We could also use $set_length, but I want to show you this method.) 
    $count = count($nums);

    // Instead of manually looping through and adding everything in an array together, we can use this method to return the sum of all of the elements in an array.
    $sum = array_sum($nums);

    $mean = $sum / $count;

    // Technically, we could write this all in a single line:
    // $mean = array_sum($nums) / count($nums);


    /* 
        MEDIAN 

        The median calculation depends upon whether the number of elements in the array is odd or even. 

        If the array has an odd number of elements, then the median is just the middle element. To calculate the index of the middle element, we first subtract 1 from the count to get the maximum index, and then divide by 2 and round down using floor().

        On the other hand, if the array has an even number of elements, then the median is the average of the two middle elements. To calculate the indices of the two middle elements, we use the same calculation as before, but we store the result in $middle and subtract 1 from it to get the index of the first middle element. We then add 1 to $middle to get the index of the second middle element. 
    */

    // The floor() function rounds a number DOWN to the nearest integer.
    // NOTE: ceiling() does the opposite (it always rounds UP).
    $middle = floor(($count - 1) / 2);

    // First, we check to see if there's an even or odd number of elements in the array.
    if ($count % 2 == 0) { // is the number even? 
        $median = ($nums[$middle] + $nums[$middle + 1]) / 2;
    } else { // is the number odd?
        $median = $nums[$middle];
    }

    /* MODE */

    // This takes the array $nums and returns an associative array where the keys are the unique values from $nums, and the values are the count of how many times each value appears in the array.
    $mode = array_count_values($nums);

    $mode = array_keys($mode, max($mode));

    // implode() is a PHP method that concatenates the elements of an array into a single string, using a specified delimiter. 
    $mode = implode(', ', $mode);

    echo "<div class=\"alert alert-info\" role=\"alert\"> \n
            <p>Your numbers were: " . implode(', ', $nums) . "</p> \n
            <p>Mean: {$mean}</p> \n
            <p>Median: {$median}</p> \n
            <p>Mode: {$mode}</p> \n
          </div>";
}

?>