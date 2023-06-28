<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Exception;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(
        UserService $userService

    )
    {
        $this->userService = $userService;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'email' => 'required|email|max:50',
            'password' => 'required|max:50'
        ]);
        $data = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];
//        dd(Hash::check($request['password']));
//        dd(Auth::attempt($data));
        if ($validate->fails()) {
            return $this->responseError($validate->errors(), 422);
        }

        $checkUser = $this->userService->getByEmail($request->email);
        if (!$checkUser) {
            return $this->responseError([], 401);
        }
        $checkPassword = Hash::check($request->password, $checkUser->password);
        if (!$checkPassword) {
            return $this->responseError([], 401);
        }
        try {
            $auth = Auth::attempt($data);
            if ($auth) {
                if (Auth::user()->status == 0) {
                    Auth::logout();
                    return $this->responseError([], 800);
                }
                $data = $this->createNewToken($auth);
                return $this->responseSuccess($data->original, 0);
            }
            return $this->responseError([], 401);

        } catch (\Exception $e) {
            return $this->responseError([], 500);
        }


    }

    public function register(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'username' => 'required|max:100|unique:users,username|regex:/\w*$/',
                'name' => 'required|max:100',
                'email' => 'required|email|max:100|unique:users',
                'password' => 'required|max:50',
                'birthday' => 'required|date_format:Y-m-d',
                'phone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
                'gender' => 'required|in:male,famale,other',
                'address' => 'required|max:255',
            ]);
//            /(84|0[3|5|7|8|9])+([0-9]{8})\b/g/
            if($validate->fails()) {
                return $this->responseError($validate->errors(),422);
            }
            $data = [
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'birthday' => $request->birthday,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'address' => $request->address,
            ];
//            dd($data);

            $res = $this->userService->create($data);
            Mail::to($request->email)->send(new TestEmail($data));
            return $this->responseSuccess($res,0);
        } catch (\Exception $e) {
            return $this->responseError($e->getMessage(), 500);
        }
    }
    public function logout() {
        try {
            Auth::logout();
            return $this->responseSuccess([],801);
        } catch (\Exception $e) {
            return $this->responseError([], 500);
        }
        Auth::logout();
        return $this->responseSuccess([],801);
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'token' => $token,
//            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
