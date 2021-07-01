<?php

namespace App\Http\Controllers\Api;

use App\Custom\Abstracts\SocialLogin;
use App\Custom\NormalSignUp;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        //NOTE: $token = auth('api')->attempt($credentials) OR $token = auth()->login($user); jwt gives token here

        $user = auth()->guard('api')->userOrFail();

        $user->auth_token = $token;
        $user->save();
        return new UserResource($user, true);

        // return $this->respondWithToken($token);

    }

    public function register(RegisterRequest $request)
    {

        $registrationValidation = $this->validateSignUp($request);
        if ($registrationValidation->isValid()) {

            $user = $this->saveUser($request);
            if (!$user->auth_token) {
                $user->auth_token = auth()->guard('api')->login($user);
            }
            $user->verified = 1;
            $user->save();
            $user->roles()->sync([2]);
            return new UserResource($user, true);

        }
        throw new \Exception($registrationValidation->getErrorMessages(), Response::HTTP_UNPROCESSABLE_ENTITY);

    }

/*These are called Return Type declarations in PHP7. It indicates the type of value that the function returns, */
    private function saveUser(Request $request): User
    {
        $user = User::where('email', $request->email)->first() ?: new User;
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->password    = bcrypt(str_random('15'));
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->social_from = $request->input('from');
        $user->save();
        return $user;
    }

    private function validateSignUp(Request $request): SocialLogin
    {
        $loginPortal = $request->input('from');

        switch ($loginPortal) {
            case 'facebook':
                return (new FacebookLogin)->verify();
                break;
            case 'google':
                return (new GoogleLogin)->verify();
                break;
            default:
                return (new NormalSignUp())->verify();
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'refresh_token' => auth()->guard('api')->refresh(),
        ]);
    }

    public function logout()
    {
        //NOTE:after logout,the previous auth token is not valid
        $user = auth()->guard('api')->userOrFail(); //Get the currently authenticated user or throw an exception.

        $user->update(['auth_token' => null]);

        auth()->guard('api')->logout();

        return successResponse('Successfully logged out');
    }

    public function refreshAccessToken()
    {
        $user = auth()->guard('api')->userOrFail();

        $refreshedToken = auth()->guard('api')->refresh();

        $user->update(['auth_token' => $refreshedToken]);

        return new UserResource($user, true);
    }

    public function payload()
    {
        return auth()->guard('api')->payload();
    }
}
