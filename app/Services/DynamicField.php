<?php

namespace App\Services;

use App\Models\Field;
use App\Http\Resources\DynamicFieldResource;
use App\Services\Interfaces\DynamicFieldInterface;

class DynamicField implements DynamicFieldInterface
{
    public function fieldList()
    {
        $fields = Field::paginate(10);

        return $fields;
    }
    public function createField($request)
    {
        $field = Field::create($request->all());

        $response = new DynamicFieldResource($field);

        return $response;
    }
}