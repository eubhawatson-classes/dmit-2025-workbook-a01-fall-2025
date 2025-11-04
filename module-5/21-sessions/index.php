<?php

// This method needs to be called at the top of any script where we want access to $_SESSION. 
session_start();

if (isset($_POST['forget'])) {
    session_unset(); // removes all session variables
    session_destroy(); // closes the session and makes $_SESSION unavailable.
    header("Refresh:0");
}

// If the user has given us their name, we will store it in the $_SESSION.
if (isset($_POST['username'])) {
    $_SESSION['username'] = htmlspecialchars($_POST['username']);
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>
        <?php
        
        if (isset($_SESSION['username'])) {
            echo "Hello, " . $_SESSION['username'] . "!";
        } else {
            echo "Hello, friend.";
        }

        ?>
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body class="bg-secondary">
    <main class="d-flex justify-content-center align-items-center min-vh-100 p-3">
        <section class="row">
            <div class="col bg-white p-5 rounded shadow-sm">
                <?php if (!isset($_SESSION['username'])) : ?>
                <!-- If we do not know the user's name, we will present them with a form to do so. -->
                <h1 class="mb-3 fw-normal">Hello there!</h1>
                <p class="lead">This could be the start of something wonderful.</p>

                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="my-5">
                        <label for="username" class="form-label">What's your name?</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    
                    <input type="submit" id="submit" name="submit" value="Let's do it!" class="btn btn-primary">
                </form>
                <?php else : ?>
                <!-- If we do know the user's name, we will greet them with it. -->
                <h1 class="mb-3 fw-normal">Hello, <?= $_SESSION['username']; ?> !</h1>
                <p class="text-muted">It's good to see you.</p>
                <p>It's currently <?= date("l"); ?> at <?= date("h:i:sa"); ?>.</p>
                <?php endif; 
                
                if (isset($_SESSION['last-time'])) : ?>

                <p>The last time we saw each other was <?= $_SESSION['last-time'] ?>.</p>

                <?php endif;

                $_SESSION['last-time'] = date("Y/m/d h:i:sa");

                if (isset($_SESSION['username'])) : ?>

                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <input type="submit" id="forget" name="forget" class="btn btn-danger my-4" value="Forget me.">
                    </form>

                <?php endif; ?>
            </div>
        </section>
    </main>
  </body>
</html>