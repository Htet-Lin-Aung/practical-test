<?php

namespace App\Http\Controllers\API\V1;

use App\Exceptions\ApiExceptionHandler;
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
            
            throw new ApiExceptionHandler('An error occurs while creating the data');
        }
    }
}