<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\DynamicFormRequest;
use App\Services\Interfaces\DynamicFormInterface;

class DynamicFormController extends Controller
{
    protected $formService;

    public function __construct(DynamicFormInterface $formService)
    {
        $this->formService = $formService;
    }

    public function createForm(DynamicFormRequest $request)
    {
        try {
            $response = $this->formService->createForm($request);

            return response()->json($response);
        } catch (\Exception $e) {
            
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'An error occurred while creating a survey.',
            ]);
        }
    }
}