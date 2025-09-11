<?php

$title = "Problem 2 - Times Tables";
include 'includes/header.php';

$number = 5;

?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Equation</th>
            <th>Product</th>
        </tr>
    </thead>
    <tbody>
        <?php
        
        for ($i = 1; $i <= 10; $i++) {
            echo "<tr>";
            echo "<td>$number * $i</td>";            
            echo "<td>" . ($number * $i) . "</td>";
            echo "</tr>";
        }

        ?>
    </tbody>
</table>

<a href="index.php" class="btn btn-outline-primary">Back to Table of Contents</a>

<?php include 'includes/footer.php'; ?>