<?php

namespace App\Http\Controllers\API\V1;

use App\Exceptions\ApiExceptionHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\V1\RegisterRequest;
use App\Http\Requests\V1\LoginRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {   
        try {
            $request['password'] = bcrypt($request->password);
            
            $user = User::create($request->all());
            
            $data = new UserResource($user);
            
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'User registered successfully', 
                'data' => $data,
            ]);

        } catch (\Exception $e) {
            
            throw new ApiExceptionHandler('An error occurs while creating a user.');
        }
    }
   
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status' => Response::HTTP_UNAUTHORIZED,
                    'message' => 'Invalid credentials',
                ]);
            }

            $user = $request->user();
            $token = $user->createToken('User Token')->plainTextToken;

            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'User logged in successfully', 
                'data' => new UserResource($user), 
                'access_token' => $token
            ]);
        } catch (\Exception $e) {

            throw new ApiExceptionHandler('An error occurs while loggin in.'); 
        }
    }

    /**
     * Logout api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();

            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'You have successfully logged out.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'An error occurred while logging out.',
            ]);

            throw new ApiExceptionHandler('An error occurred while logging out.'); 
        }
    }

}