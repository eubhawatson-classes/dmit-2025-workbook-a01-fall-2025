<?php

// `require` is different from `include` in that if the file is not found, PHP will throw a fatal error and die().
require '../private/validation-functions.php'; 
require '../private/process-form.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Evil Corp.&trade; Henchmen Application</title>

    <!-- BS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- JS for Range Slider -->
     <script src="js/main.js" defer></script>
  </head>
  <body class="bg-black container px-3 py-5">
    <main class="row justify-content-center align-items-center min-vh-100">
        <section class="col-md-10 border border-secondary rounded bg-dark text-light p-5">
            <h1 class="fw-light text-center">Evil Corp.&trade; Henchmen Application</h1>
            <p class="lead text-center">Welcome to Evil Corp.&trade; where dastardly dreams meet career opportunities!</p>
            <p class="mb-5">We understand that being a henchperson is more than just a job - it's a calling. Whether you're a master of mischief, a pro at pressing big red buttons, or someone who just wants to look cool guarding a secret lair, we want you on our team.</p>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <section class="my-5">
                    <h2 class="fw-light">Account Creation</h2>
                    <p>All updates on your application status will be available through our exclusive Evil Portal&reg;</p>

                    <!-- Text Input (Name) -->
                     <div class="mb-4">
                        <!-- If there's an error message, we'll display it right by the input the user needs to fix. -->
                        <?php if ($message_name != '') echo $message_name; ?>
                        <label for="name" class="form-label">Full Name:</label>
                        <input type="text" id="name" name="name" placeholder="Robin Banks" value="<?= $name; ?>" class="form-control">
                        <p class="form-text text-light">Enter you full name as it appears on your evil henchperson license or birth certificate. Pseudonyms (e.g., "The Crusher", "Brutal Brutus", or "Dave") can be added later.</p>
                     </div>

                    <!-- Email Input -->
                     <div class="mb-4">
                        <?php if ($message_email != '') echo $message_email; ?>
                        <label for="email" class="form-label">Email Address:</label>
                        <input type="email" id="email" name="email" placeholder="example@evilcorp.com" value="<?= $email; ?>" class="form-control">
                        <p class="form-text text-light">Enter a valid email address that you check frequently – evil plans wait for no one.</p>
                     </div>

                    <!-- Phone Number -->
                     <div class="mb-4">
                        <?php if ($message_phone != '') echo $message_phone; ?>
                        <label for="phone" class="form-label">Phone Number:</label>
                        <input type="phone" id="phone" name="phone" placeholder="1234567890" value="<?= $phone; ?>" class="form-control">
                        <p class="form-text text-light">Provide a valid phone number where we can reach you. Carrier pigeons are no longer accepted after the law suit.</p>
                     </div>

                    <!-- Date (DOB) -->
                     <div class="mb-4">
                        <?php if ($message_dob != '') echo $message_dob; ?>
                        <label for="dob" class="form-label">Date of Birth:</label>
                        <input type="date" id="dob" name="dob" value="<?= $dob; ?>" class="form-control">
                        <p class="form-text text-light">Enter your date of birth. This helps us confirm you're old enough for hazardous henching.</p>
                     </div>

                    <!-- Password Input -->
                     <div class="mb-4">
                        <?php if ($message_password != '') echo $message_password; ?>
                        <label for="password" class="form-label">Secret Password:</label>
                        <input type="text" id="password" name="password" value="<?= $password; ?>" class="form-control">
                        <p class="form-text text-light">Choose a strong password, with:</p>
                        <ul class="form-text text-light">
                            <li>a minimum of 8 characters</li>
                            <li>at least one lowercase letter</li>
                            <li>at least one uppercase letter</li>
                            <li>at least one number</li>
                            <li>one of the following characters: !@#$%^&*</li>
                        </ul>
                        <p class="form-text text-light">Avoid using easy-to-guess passwords, like "password123" or "evil4life".</p>
                     </div>

                    <!-- Password Check -->
                     <div class="mb-4">
                        <?php if ($message_name != '') echo $message_name; ?>
                        <label for="" class="form-label"></label>
                        <input type="text" id="" name="" value="<?= $name; ?>" class="form-control">
                        <p class="form-text text-light"></p>
                     </div>
                </section>

                <section class="my-5">
                    <h2 class="fw-light">Qualifications</h2>

                    <!-- Number Input (Years of Experience) -->

                    <!-- Datalist (Regional Placement) -->

                    <!-- Radio Buttons (Department) -->

                    <!-- Checkboxes (Training) -->

                    <!-- Range Slider (Loyalty Level) -->

                    <!-- Dropdown (Referral) -->
                </section>

                <section class="my-5">
                    <h2 class="fw-light">Long Answer Question</h2>

                    <!-- Textarea -->
                </section>

                <!-- Submission -->
                 <div class="my-4">
                    <input type="submit" id="submit" name="submit" value="Create Account &amp; Apply" class="btn btn-warning">
                 </div>

                 <p class="form-text text-light">Evil Corp.&trade; prides itself on being an equal opportunity employer. All goons, mooks, minions, lackeys, grunts, and flunkies are encouraged to apply. Remember: just because we're evil doesn't mean we can't be equal.</p>
            </form>
        </section>
    </main>
</body>
</html>