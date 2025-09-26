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
?>