<?php

namespace App\Services;

use App\Exceptions\ApiExceptionHandler;
use App\Models\Field;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
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
        try {
            DB::beginTransaction();

            $field = Field::create($request->all());

            DB::commit();

            $response = new DynamicFieldResource($field);

            return response()->json([
                'status' => Response::HTTP_CREATED,
                'message' => 'Dynamic form is successfully created.',
                'data' => $response
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            throw new ApiExceptionHandler('An error occurs while creating the data');
        }
    }
}