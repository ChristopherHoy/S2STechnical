<?php

namespace App\Helpers\Responses;

use Illuminate\Database\Eloquent\Model;

// Class for simple string Responses
// response() manages creating a formatted response object to return
class StringResponse
{
    private $message = "";

    public function __construct($message) {
        $this->message = $message;
    }

    // Return with the message and the http status (success)
    public function response() {
        return response()->json([
            "message" => $this->message,
            "status" => 200
        ], 200);
    }
}
