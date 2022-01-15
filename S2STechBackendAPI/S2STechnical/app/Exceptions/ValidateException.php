<?php

namespace App\Exceptions;

use Exception;

// Exception thrown by failed input validation
class ValidateException extends Exception
{
    private $details;

    // Set message, error code and validation details
    public function __construct($data) {
        parent::__construct("Invalid arguments supplied", 400);
        $this->details = $data;
    }

    // Get details, used by Handler when creating response
    public function getDetails() {
        return $this->details;
    }
}
