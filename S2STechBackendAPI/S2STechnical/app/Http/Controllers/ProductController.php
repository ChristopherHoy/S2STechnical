<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Product;
use App\HTTP\Requests\Validatable;
use App\Helpers\Responses\ArrayResponse;
use App\Helpers\Responses\StringResponse;

class ProductController extends Controller
{

    // Create a product, if it exists, update it
    public function create(Validatable $request) {

        // Validate Request
        $request->validate([
            "sku" => "string|required",
            "attributes.foo" => "string|required",
            "attributes.grams" => "numeric|required",
            "attributes.size" => "string|in:small,medium,large",
        ]);

        // Create the product if it doesnt exist, else update it
        Product::updateOrCreate([
            'sku' => $request->input('sku')
        ],[
            'size' => $request->input('attributes')['size'],
            'grams' => $request->input('attributes')['grams'],
            'foo' => $request->input('attributes')['foo']
        ]);

        // Create response object and return it's json response
        $result_obj = new StringResponse('Success');
        return $result_obj->response();
    }


    // Fetch all products
    public function read(Validatable $request) {

        // Fetch all products
        $res = Product::all();

        // Map to desired structure and place in ArrayResponse
        $result_obj = new ArrayResponse();
        foreach ($res as  $row) {
            $tmp = [];
            $tmp['sku'] = $row['sku'];
            $tmp['attributes'] = [];
            foreach (['size', 'grams', 'foo'] as $attr) {
                $tmp['attributes'][$attr] = $row[$attr];
            }
            $result_obj->add($tmp);
        }

        // Return the ArrayResponse response json
        return $result_obj->response();
    }
}
