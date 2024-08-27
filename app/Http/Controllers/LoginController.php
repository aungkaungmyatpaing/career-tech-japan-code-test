<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\ResourceForbiddenException;
use App\Exceptions\ServerErrorException;
use App\Traits\ApiResponse;

class LoginController extends Controller
{
    use ApiResponse;
    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->validated('email'))->first();

            if (is_null($user)) {
                throw new ResourceNotFoundException('User not found');
            }

            if (!Hash::check($request->validated('password'), $user->password)) {
                throw new AuthenticationException('Email or password is incorrect');
            }

            return $this->success('Login successful',LoginResource::make($user));
        } catch (\Throwable $th) {
            throw new ServerErrorException($th->getMessage());
        }

    }
}
