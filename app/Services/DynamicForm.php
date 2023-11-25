<?php

namespace App\Services;

use App\Models\Form;
use App\Http\Resources\DynamicFormResource;
use App\Services\Interfaces\DynamicFormInterface;

class DynamicForm implements DynamicFormInterface
{
    public function createForm($request)
    {
        $createdForm = Form::create($request->all());

        $createdForm->fields()->attach($request->field_id);

        $response = new DynamicFormResource($createdForm);

        return $response;
    }
}