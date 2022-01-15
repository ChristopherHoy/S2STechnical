<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\RecordExistsException;

class BaseModel extends Model
{
    public function throwIfExists($key, $value) {
        $exists = $this->where($key, $value )->exists();

        if ($exists) {
            throw new RecordExistsException($value);
        }

        return $exists;
    }
}
