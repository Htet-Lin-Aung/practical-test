<?php

namespace App\Services;

use App\Exceptions\ApiExceptionHandler;
use App\Models\Form;
use App\Models\Field;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\DynamicFormResource;
use App\Services\Interfaces\DynamicFormInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DynamicForm implements DynamicFormInterface
{
    public function createForm($request)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            $createdForm = Form::create($request->all());

            // Check if each field_id exists before attaching
            foreach ($request->field_id as $fieldId) {
                Field::findOrFail($fieldId);
            }

            $createdForm->fields()->attach($request->field_id);

            // Commit the transaction
            DB::commit();

            $response = new DynamicFormResource($createdForm);

            return response()->json([
                'status' => Response::HTTP_CREATED,
                'message' => 'Dynamic form is successfully created.',
                'data' => $response
            ]);
        } catch (ModelNotFoundException $e) {
            // Rollback the transaction if an exception occurs
            DB::rollBack();

            throw new ApiExceptionHandler('One or more field_id does not exist.');
        }
    }
}