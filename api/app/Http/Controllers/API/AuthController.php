<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
use App\Services\UserAuthService;
use App\Http\Requests\AuthRequest;


class AuthController extends Controller
{
    private UserAuthService $userAuthService;

    public function __construct(UserAuthService $userAuthService)
    {
        $this->userAuthService = $userAuthService;
    }

    public function register(AuthRequest $request)
    {
        
            $data = $this->userAuthService->registerUser(
                ...array_values(
                    $request->only([
                        'name',
                        'email',
                        'password',

                    ])
                )
            );
            return response()->json([
                'status' => 200,
                'username' => $data['user']->name,
                'token' => $data['token'],
                'message' => 'Usuario Cadastrado Com Sucesso!'
            ]);
        
    }

    public function login(AuthRequest $request)
    {
       
        $data = $this->userAuthService->loginUser(
            ...array_values(
                $request->only([
                    'email',
                    'password'
                ])
            )
        );
        return response()->json([
            'status' => 200,
            'username' => $data['user']->name,
            'token' => $data['token'],
            'message' => 'Login Com Sucesso!'
        ]);
    }

    public function logout()
    {
        $this->userAuthService->logoutService();
        return response()->json([
            'status' => 200,
            'message' => 'Usuario saiu com Sucesso'

        ]);
    }
}
