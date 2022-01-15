<?php

namespace App\Helpers\Responses;

use Illuminate\Database\Eloquent\Model;

// Class used for list response data
// response() manages creating a formatted response object to return
class ArrayResponse
{
    private $data = [];

    public function setData($item) {
        $this->data = $item;
    }

    public function getData() {
        return $this->data;
    }

    public function add($item) {
        array_push($this->data, $item);
    }

    // Return with the number of results and the http status (success)
    public function response() {
        return response()->json([
            "data" => $this->data,
            "total_results" => count($this->data),
            "status" => 200
        ], 200);
    }
}
