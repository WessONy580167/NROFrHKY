<?php
// 代码生成时间: 2025-08-31 03:42:50
// XSS Protection Module
// This module provides a simple way to protect against XSS attacks.

class XssProtection {
    // Function to sanitize user input to prevent XSS attacks
    public function sanitizeInput($input) {
        // Use PHP's built-in filter_var function with the FILTER_SANITIZE_STRING flag
        // to remove any unwanted characters from the input.
        $sanitizedInput = filter_var($input, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);

        // Return the sanitized input
        return $sanitizedInput;
    }

    // Function to encode output to prevent XSS attacks
    public function encodeOutput($output) {
        // Use htmlspecialchars function to encode special characters in the output.
        // This will convert characters like <, >, and & to their corresponding HTML entities.
        $encodedOutput = htmlspecialchars($output, ENT_QUOTES, 'UTF-8');

        // Return the encoded output
        return $encodedOutput;
    }

    // Function to validate input against a whitelist or pattern
    public function validateInput($input, $pattern) {
        if (!preg_match($pattern, $input)) {
            // If the input does not match the pattern, throw an exception
            throw new InvalidArgumentException('Invalid input provided.');
        }

        // If the input matches the pattern, return it as valid
        return $input;
    }
}

// Usage example
try {
    $xssProtection = new XssProtection();
    $userInput = '<script>alert("XSS")</script>';
    $sanitizedInput = $xssProtection->sanitizeInput($userInput);
    $encodedOutput = $xssProtection->encodeOutput($sanitizedInput);
    echo $encodedOutput;

    // Validate input against a pattern
    $pattern = "/^[a-zA-Z0-9]+$/";
    $validatedInput = $xssProtection->validateInput($userInput, $pattern);
    echo $validatedInput;
} catch (InvalidArgumentException $e) {
    // Handle any errors that occur during input validation
    echo 'Error: ' . $e->getMessage();
}
