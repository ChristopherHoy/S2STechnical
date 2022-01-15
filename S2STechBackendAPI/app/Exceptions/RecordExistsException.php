<?php

namespace App\Exceptions;

use Exception;

class RecordExistsException extends Exception
{
    private $details;

    public function __construct($key) {
        parent::__construct("Record '" . $key . "' already exists", 400);
    }
}
