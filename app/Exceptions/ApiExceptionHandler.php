<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class ApiExceptionHandler extends Exception
{
    public function render($request, Exception $exception)
    {
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return response()->json([
                'status'   => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message'   => 'Validation errors',
                'data'      => $exception->validator->errors(),
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
            return response()->json([
                'status'   => Response::HTTP_FORBIDDEN,
                'message'   => "You don't have permissions!",
            ],Response::HTTP_FORBIDDEN);
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return response()->json([
                'status'   => Response::HTTP_UNAUTHORIZED,
                'message'   => "Please login and access with valid token!",
            ],Response::HTTP_UNAUTHORIZED);
        }

        if($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException){
            return response()->json([
                'status'   => Response::HTTP_METHOD_NOT_ALLOWED,
                'message'   => request()->method() . " method not allowed for this route!",
            ],Response::HTTP_METHOD_NOT_ALLOWED);
        }

        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {            
            return response()->json([
                'status'   => Response::HTTP_NOT_FOUND,
                'message'   => 'The URL was not found!',
            ],Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return response()->json([
                'status'   => Response::HTTP_NOT_FOUND,
                'message'   => 'The requested record was not found!',
            ],Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof \Illuminate\Database\QueryException) {
            if ($exception->getCode() == '23000') {
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Foreign key constraint violation!'
                ],Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            return response()->json([
                'status'   => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message'   => 'Please check your query!',
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        } 

        return response()->json([
            'message' => 'An error occurred while processing the request.',
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
