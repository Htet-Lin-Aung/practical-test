<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\DynamicFieldRequest;
use App\Services\Interfaces\DynamicFieldInterface;

class DynamicFieldController extends Controller
{
    protected $fieldService;

    public function __construct(DynamicFieldInterface $fieldService)
    {
        $this->fieldService = $fieldService;
    }

    public function fieldList()
    {
        try{
            $response = $this->fieldService->fieldList();

            return response()->json($response);

        } catch (\Exception $e){
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'An error occurred while fetching the list.',
            ]);
        }
    }

    public function createField(DynamicFieldRequest $request)
    {
        try {
            $response = $this->fieldService->createField($request);

            return $response;

        } catch (\Exception $e) {
            
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'An error occurred while creating a survey.',
            ]);
        }
    }
}