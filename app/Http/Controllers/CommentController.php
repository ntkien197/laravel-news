<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    //
    public function __construct(
        protected CommentService $commentService
    )
    {
    }
    public function getComment(Request $request)
    {
        $query = [
            'perpage' => !empty($request->perpage) ? $request->perpage : 10,
            'page' => !empty($request->page) ? $request->page : 1
        ];
        $id = $request->post_id;
        $data = $this->commentService->getCommentByIdPost($query,$id);
        return $this->responseSuccess($data, 0);
    }

    public function postComment(Request $request)
    {
        try {
            $validate = Validator::make($request->all(),[
                'post_id' => 'required',
                'comment' => 'required|max:1000',
            ]);
            if($validate->fails()) {
                return $this->responseError($validate->errors(),422);
            }
            $user = Auth::user();
            $param = [
                'post_id' => $request->post_id,
                'content' => $request->comment,
                'user_id' => $user->id,
                'parent_id' => $request->parent_id
            ];

            $res = $this->commentService->create($param);
            if($res) {
                return $this->responseSuccess($res,0);
            }
            return $this->responseError([],500);
        } catch (\Exception $e) {
            return $this->responseError($e->getMessage(),500);
        }
    }
}
