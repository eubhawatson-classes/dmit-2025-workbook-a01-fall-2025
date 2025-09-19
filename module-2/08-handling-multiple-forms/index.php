<?php

// Let's make sure to retain the data set length from either GET or POST. If the user hasn't submitted anything yet, we'll just initialise it.
$set_length = '';

switch (TRUE) {
    case isset($_GET['set-length']):
        $set_length = htmlspecialchars($_GET['set-length']);
        break;
    case isset($_POST['set-length']):
        $set_length = htmlspecialchars($_POST['set-length']);
        break;
    default: 
        $set_length = '';
        break;
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Mean, Median, &amp; Mode Calculator</title>
    
    <!-- BS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <main class="container mt-5">
        <section class="row justify-content-center">
            <div class="col-md-10 col-kg-9 col-xxl-8">
                <h1 class="mb-5 text-center">Mean, Median, &amp; Mode Calculator</h1>

                <div class="row">
                    <!-- Introduction & Definitions -->
                    <div class="col-md-6">
                        <aside class="card">
                            <div class="card-header bg-info">
                                <h2 class="card-title">What are Mean, Median, and Mode?</h2>
                            </div>
                            <div class="card-body">
                                <p class="mb-4 text-body-secondary">The mean, median, and mode are different ways of figuring out the 'centre', or a 'typical' data point in a given set of numbers.</p>

                                <dl>
                                    <dt>Mean</dt>
                                    <dd>The 'average' number; found by adding all data points and dividing that sum by the number of data points.</dd>

                                    <dt>Median</dt>
                                    <dd>The 'middle' number; found by ordering all data points and picking out the one in the middle.</dd>

                                    <dt>Mode</dt>
                                    <dd>The most 'frequent' number – that is, the number that occurs the highest number of times.</dd>
                                </dl>
                            </div>
                        </aside> <!-- end of .card --> 
                    </div> <!-- end of .col -->

                    <div class="col-md-6">
                        <!-- In our processing script, we will echo out the final calculations if the user has given us all the information we need. We're putting it here so that the final results show up near the top of the page. -->
                        <?php include 'process.php'; ?>

                        <!-- Let's start by asking the user how many numbers are in their data set (i.e. how many inputs are needed in the second form). -->
                        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET" class="mb-5">
                            <div class="mb-3">
                                <label for="set-length" class="form-label">How many numbers are in your data set?</label>
                                <input type="number" id="set-length" name="set-length" value="<?= $set_length; ?>" class="form-control">
                            </div>

                            <input type="submit" id="submit-get" name="submit-get" value="Generate Form" class="btn btn-info">
                        </form>

                        <?php if ($set_length != '') : ?>

                            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <input type="hidden" name="set-length" id="post-set-length" value="<?= $set_length; ?>">

                                <?php 
                                
                                for ($i = 1; $i <= $set_length; $i++) {
                                    // Even though we are dynamically generating this form, it's possible that the user has already filled it out. Let's make sure that, if they've already given us a value, that we retain it.
                                    $value = isset($_POST["num-{$i}"]) ? htmlspecialchars($_POST["num-{$i}"]): '';

                                    echo "<div class=\"mb-3\"> \n
                                          <label for=\"num-{$i}\" class=\"form-label\">Enter Number {$i}: </label> \n
                                          <input type=\"number\" class=\"form-control\" name=\"num-{$i}\" id=\"num-{$i}\" value=\"{$value}\" required> \n
                                          </div> \n";
                                }

                                ?>

                                <input type="submit" id="submit-post" name="submit-post" class="btn btn-info my-4" value="Calculate">
                            </form>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
  </body>
</html>