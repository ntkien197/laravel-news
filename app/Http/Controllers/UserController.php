<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userService;

    public function __construct(
        UserService $userService
    )
    {
        $this->userService = $userService;
    }

    public function index(Request $request): JsonResponse
    {
        $query = [
            'perpage' => !empty($request->perpage) ? $request->perpage : 10,
            'page' => !empty($request->page) ? $request->page : 1,
            'sort' => !empty($request->sort) ? $request->sort : 'desc',
            'column' => !empty($request->column) ? $request->column : 'id',
        ];

        $data = $this->userService->getList($query);

        return $this->responseSuccess($data);
    }

    public function profile(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return $this->responseError([], 401);
            }
            return $this->responseSuccess($user, 0);
        } catch (\Exception $e) {
            return $this->responseError([], 500);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'old_password' => 'required',
                'new_password' => 'required|max:50',
                'confirm_password' => 'required|same:new_password'
            ]);
            if ($validate->fails()) {
                return $this->responseError($validate->errors(), 422);
            }
            $id = Auth::user()->id;
            $params = [
                'password' => Hash::make($request->new_password)
            ];
            $data = $this->userService->update($id, $params);
            return $this->responseSuccess([], 0);
        } catch (\Exception $e) {
            return $this->responseError([], 500);
        }
    }
}
