<?php

/**
 * In order for PHP to work, we need three things:
 * 
 * 1. a PHP-enabled server or development environment;
 * 2. a .php file; and
 * 3. PHP tags <?php ?>.
 */

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PHP Basics</title>

    <!-- BS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body class="container text-center">
    <section class="row min-vh-100 align-items-center justify-content-center">
        <div class="col-lg-8">
            <h1 class="display-5 mb-4">PHP Basics</h1>
            <h2 class="fw-light">Table of Contents</h2>

            <!-- 
                Cheaty Emmet Abbreviation
                ul.nav.flex-column>li.nav-item*4>a.nav-link
            -->

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="php-info.php" class="nav-link">PHP Installation Information</a>
                </li>
                <li class="nav-item">
                    <a href="hello-world.php" class="nav-link">Hello, World! Demo</a>
                </li>
                <li class="nav-item">
                    <a href="basic-math.php" class="nav-link">Basic Arithmetic</a>
                </li>
                <li class="nav-item">
                    <a href="arrays.php" class="nav-link">Insult Generator</a>
                </li>
            </ul>
        </div>
    </section>
  </body>
</html>