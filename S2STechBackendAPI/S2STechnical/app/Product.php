<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;

class Product extends BaseModel
{
    // Basic config
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'products';
    protected $primaryKey = 'sku';

    // Laravel assumes the key is an auto incrementing ingteger
    // We need to explicitely let it know that this is not the case
    public $incrementing = false;
    protected $keyType = 'string';

    // Returned from query
    protected $fillable = [
        'size',
        'grams',
        'foo',
        'sku'
    ];
}
