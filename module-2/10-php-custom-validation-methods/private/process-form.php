<?php

// Account Creation
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$dob = isset($_POST['dob']) ? $_POST['dob'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$password_check = isset($_POST['password-check']) ? $_POST['password-check'] : '';

// Qualifications
$experience = isset($_POST['experience']) ? trim($_POST['experience']) : '';
$region = isset($_POST['region']) ? $_POST['region'] : '';
$department = isset($_POST['department']) ? $_POST['department'] : '';
$training = isset($_POST['training']) ? $_POST['training'] : []; // Checkbox data is an array, so our default here is an empty array rather than an empty string.
$loyalty = isset($_POST['loyalty']) ? $_POST['loyalty'] : 5;
$referral = isset($_POST['referral']) ? $_POST['referral'] : '';

// Long Answer
$evil_plan = isset($_POST['evil-plan']) ? trim($_POST['evil-plan']) : '';

// Error Messages
$message_name = "";
$message_email = "";
$message_phone = "";
$message_password = "";
$message_password_check = "";
$message_dob = "";

$message_experience = "";
$message_region = "";
$message_department = "";
$message_training = "";
$message_loyalty = "";
$message_referral = "";

$message_evil_plan = "";

// Test BOOL
$form_good = isset($_POST['submit']) ? TRUE : FALSE;

// If the user hits 'submit', we'll begin our test(s).
if (isset($_POST['submit'])) {

    /*
        VALIDATION FOR FULL NAME

        Generally, we should always start validation with a presence check (i.e., did the user fill out this field?).

        For a full name, we'll also make sure that the user gave us letters and that there's a space somewhere in there.
    */

    if (is_blank($name)) {
        $message_name = "<p class=\"text-warning\">Please enter your name.</p>";
    } elseif (!is_letters($name)) {
        $message_name = "<p class=\"text-warning\">Your name can only contain letters and spaces.</p>";
    } elseif (no_spaces($name)) {
        $message_name = "<p class=\"text-warning\">Please enter both your first and last name.</p>";
    } elseif ($name == FALSE) {
        $message_name = "<p class=\"text-warning\">Please enter a valid name.</p>";
    }

    if ($message_name != "") {
        $form_good = FALSE;
    }

    /*
        VALIDATION FOR EMAIL
    */

    if (is_blank($email)) {
        $message_email = "<p class=\"text-warning\">Please enter your email address.</p>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message_email = "<p class=\"text-warning\">Please enter a valid email address.</p>";
    }

    if ($message_email != "") {
        $form_good = FALSE;
    }

    /*
        PHONE NUMBERS 
    */

    $phone = valid_phone_format($phone);

    if (is_blank($phone)) {
        $message_phone = "<p class=\"text-warning\">Please enter your phone number.</p>";
    } elseif (!is_numeric($phone)) {
        $message_phone = "<p class=\"text-warning\">Please enter a valid phone number, using numbers only.</p>";
    } elseif (!filter_var($phone, FILTER_VALIDATE_INT)) {
        $message_phone = "<p class=\"text-warning\">Please enter a valid phone number, using numbers only.</p>";
    } elseif (!has_length_exactly($phone, 10)) {
        $message_phone = "<p class=\"text-warning\">Please enter a 10-digit phone number.</p>";
    }

    if ($message_phone != "") {
        $form_good = FALSE;
    }

    /*
        DATES & DATE OF BIRTH

        We can check to see if a provided value is a date by creating a DateTime object from it. This is because it ensures the value is both:

            1. properly formatted (matches Y-m-d)
            2. a valid calendar dates (e.g., it prevents 2025-02-30 from being accepted)

        While strtotime() can convert a string into a timestamp, it silently fixes invalid dates instead of rejecting them.
    */

    if (!empty($dob)) {
        // If what the user gave us isn't empty, we'll attempt to create a DateTime object from it.
        $dob_object = DateTime::createFromFormat('Y-m-d', $dob);

        // We'll check to see if we were able to do that, and that the resulting object (if any) follows our provided format.
        if ($dob_object && $dob_object->format('Y-m-d') === $dob) {

            // If the date is valid, we'll check the user's age by comparing today's date and time to their birthday.
            $today = new DateTime();
            $minimum_age = $today->modify('-18 years');

            if ($dob_object > $minimum_age) {
                $message_dob = "<p class=\"warning-text\">You must be at least 18 years old to apply.</p>";
            }

        } else {
            $message_dob = "<p class=\"warning-text\">Please enter a valid date.</p>";
        }

    } else {
        $message_dob = "<p class=\"warning-text\">Your date of birth is required.</p>";
    }

    if ($message_dob != "") {
        $form_good = FALSE;
    }

    /*
        PASSWORDS

        If we tell the user that we want certain things within a password, we should compare their input to a suitable regular expression. 

        We could check all of our conditions with a monstrously long Regular Expression, but if we do it piece-by-piece, we can give the user more explicit feedback on what they're missing. 
    */

    if (is_blank($password)) {
        $message_password = "<p class=\"text-warning\">Please provide a password.</p>";
    } elseif (strlen($password) < 8) {
        $message_password = "<p class=\"text-warning\">Your password must be at least 8 characters long.</p>";
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $message_password = "<p class=\"text-warning\">Your password must include at least one uppercase letter.</p>";
    } elseif (!preg_match('/[a-z]/', $password)) {
        $message_password = "<p class=\"text-warning\">Your password must include at least one lowercase letter.</p>";
    } elseif (!preg_match('/[0-9]/', $password)) {
        $message_password = "<p class=\"text-warning\">Your password must include at least one number.</p>";
    } elseif (!preg_match('/[\W_]/', $password)) {
        $message_password = "<p class=\"text-warning\">Your password must include at least one of the following special characters: !@#$%^&* </p>";
    }

    if ($message_password != "") {
        $form_good = FALSE;
    }

    /*
        PASSWORD COMPARISON
    */

    if ($password != $password_check) {
        $message_password_check = "<p class=\"text-warning\">This password does not match the response above. Please try typing your password again.</p>";
        $form_good = FALSE;
    }

}

?>