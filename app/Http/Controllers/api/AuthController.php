<?php
namespace App\Http\Controllers\api;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function register(RegisterRequest $request)
    {
        $data = $this->authService->register($request->validated());
        return ApiResponse::sendResponse(201, 'User Account Created Successfully', $data);
    }
    public function login(LoginRequest $request)
    {
        $data = $this->authService->login($request->validated());
        if ($data) {
            return ApiResponse::sendResponse(200, 'Login Successfully', $data);
        } else {
            return ApiResponse::sendResponse(401, 'These credentials don\'t exist', null);
        }
    }
    public function logout(Request $request)
    {
        $this->authService->logout($request->user());
        return ApiResponse::sendResponse(204, 'Logout Successfully', []);
    }
}
