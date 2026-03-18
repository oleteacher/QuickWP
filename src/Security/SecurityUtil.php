<?php

class SecurityUtil {

    // Generates a CSRF token
    public static function generateCsrfToken() {
        return bin2hex(random_bytes(32));
    }

    // Validates a CSRF token
    public static function validateCsrfToken($token, $sessionToken) {
        return hash_equals($token, $sessionToken);
    }

    // Sanitizes input data
    public static function sanitizeInput($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    // Rate limiting utility
    private static $requestCount = 0;
    private static $startTime;
    private static $rateLimitDuration = 60; // seconds
    private static $requestLimit = 100; // max requests in the duration

    public static function rateLimit() {
        if (is_null(self::$startTime)) {
            self::$startTime = time();
        }

        if (time() - self::$startTime > self::$rateLimitDuration) {
            self::$startTime = time();
            self::$requestCount = 0;
        }

        self::$requestCount++;

        if (self::$requestCount > self::$requestLimit) {
            throw new Exception('Rate limit exceeded. Please try again later.');
        }
    }
}

?>