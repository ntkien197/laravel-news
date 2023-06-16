<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request): JsonResponse
    {
        $query = [
            'perpage' => !empty($request->perpage) ? $request->perpage : 10,
            'page' => !empty($request->page) ? $request->page : 1
        ];
        return $this->responseSuccess($this->postService->getList($query));
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $validate = Validator::make($request->all(),[
                'views' => 'required',
                'hot' => 'required',
                'category_id' => 'required',
                'name' => 'required',
                'title' => 'required',
                'sub_title' => 'required',
                'content' => 'required',
                'lang' => 'required',
            ]);
            if ($validate->fails()) {
                return $this->responseError($validate->errors(), 422);
            }
            $post = [
              'views' => $request->views,
              'hot' => $request->hot,
              'category_id' => $request->category_id,
            ];
            $data = $this->postService->create($post);
            $post_id = $data->id;
            $request['post_id'] = $post_id;
            $request['lang_id'] = GlobalHelper::formatLocale($request->lang);

            $data = $this->postService->createPostTranslate($request->all());

            return $this->responseSuccess($data, 0);

        } catch (\Exception $e) {
            return $this->responseError([],500);
        }
    }

    public function detail($id): JsonResponse
    {
        if (!$id) {
            return $this->responseError([], 803);
        }
        $detail = $this->postService->getDetail($id);
        return $detail ? $this->responseSuccess($detail, 0) : $this->responseError([], 810);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            if (!$id) {
                return $this->responseError([], 803);
            }

            $validate = Validator::make($request->all(), [
                'views' => 'required',
                'hot' => 'required',
                'category_id' => 'required',
                'name' => 'required',
                'title' => 'required',
                'sub_title' => 'required',
                'content' => 'required',
                'lang' => 'required',
            ]);
            if ($validate->fails()) {
                return $this->responseError($validate->errors(), 422);
            }
//            $params = [
//              'views' => $request->views,
//              'hot' => $request->hot,
//              'category_id' => $request->category_id
//            ];
//            $this->postService->update($id, $params);

            $data = $this->postService->updateForTranslate($id, $request);


            return $data ? $this->responseSuccess([], 0) : $this->responseError([], 810);

        } catch (\Exception $e) {
            dd($e->getMessage());
            return $this->responseError([], 500);
        }
    }
}
