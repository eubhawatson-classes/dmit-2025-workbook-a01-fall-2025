<?php

/**
 * This file contains a collection of reusable validation helper functions.
 * 
 * BLANKS / PRESENCE: Check whether or not a value is set or exists.
 * EXCLUSION / INCLUSIONS: Verify that value is amongst a set of allowed values.
 * DATA TYPE: PHONE NUMBER: Normalise phone inputs by stripping syntax.
 * DATA TYPE: STRINGS: Validate string length and character constraints.
 */

/**
 * Determines if a value is blank (unset or empty after trimming whitespace).
 * Uses === to avoid false positives (unlike empty() which treats '0' as blank).
 * Note: trim() only works on strings.
 * 
 * @param mixed $value - The value we want to check.
 * @return BOOL - TRUE if the value is not set or is an empty string (after trimming).
 */
function is_blank($value) {
    return !isset($value) || trim($value) === '';
}

/**
 * EXCLUSIONS / INCLUSIONS
 */

/**
 * Checks if a given value exists in a set of allowed values.
 * Useful for validating dropdowns, radio buttons, or any discrete list of values.
 * 
 * @param mixed - The value to test.
 * @param array - An array of allowed values.
 * @return BOOL - TRUE if $value is found in $set; false otherwise.
 */
function has_allowed_value($value, $set) {
    return in_array($value, $set);
}


/**
 * DATA TYPE: PHONE NUMBER
 */

/**
 * Normalises a phone number string by stripping out common formatting characters.
 * Removes: +, -, ., (, ), and spaces.
 * 
 * @param string $value - The raw phone number input.
 * @return string - The cleaned numeric (hopefully) phone string.
 */
function valid_phone_format($value) {
    // We want to remove: + - . ( )
    $value = str_replace("+", "", $value);
    $value = str_replace("-", "", $value);
    $value = str_replace(".", "", $value);
    $value = str_replace("(", "", $value);
    $value = str_replace(")", "", $value);
    $value = str_replace(" ", "", $value);

    return $value;
}


/**
 * DATA TYPE: STRINGS
 */

?>