<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use App\Models\CategoryTranslate;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    protected $categoryService;

    public function __construct(
        CategoryService $categoryService
    )
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request): JsonResponse
    {
        $query = [
            'perpage' => !empty($request->perpage) ? $request->perpage : 10,
            'page' => !empty($request->page) ? $request->page : 1
        ];
        $data = $this->categoryService->getList($query);

        return $this->responseSuccess($data, 0);
    }

    public function create(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'title' => 'required|max:255',
                'description' => 'required',
                'lang' => 'required',
            ]);
            if ($validate->fails()) {
                return $this->responseError($validate->errors(), 422);
            }

            $data = $this->categoryService->create([]);
            $category_id = $data->id;

//            $params = [
//                'name' => $request->name, ham` tren dang ddoi ra params ham` duoi tnhien dung request su dung lai deo tuong thich gio sua, coi day
//                'title' => $request->title,
//                'description' => $request->description,
//                'lang_id' => GlobalHelper::formatLocale($request->lang_id),
//                'category_id' => $category_id
//            ];

            $request['category_id'] = $category_id;
            $request['lang_id'] = GlobalHelper::formatLocale($request->lang);
            $data = $this->categoryService->createCategoryTranslate($request->all());

            return $this->responseSuccess($data, 0);
        } catch (\Exception $e) {
            return $this->responseError([], 500);
        }


    }

    public function detail($id): JsonResponse
    {
        if (!$id) {
            return $this->responseError([], 803);
        }
        $detail = $this->categoryService->getDetail($id);
        return $detail ? $this->responseSuccess($detail, 0) : $this->responseError([], 803);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            if (!$id) {
                return $this->responseError([], 803);
            }

            $validate = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'title' => 'required|max:255',
                'description' => 'required',
                'lang' => 'required',
            ]);
            if ($validate->fails()) {
                return $this->responseError($validate->errors(), 422);
            }

            $data = $this->categoryService->update($id, $request);

            LOG::error('update cate controller gon code lien', [$data]);

            return $data ? $this->responseSuccess([], 0) : $this->responseError([], 803);

        } catch (\Exception $e) {
            LOG::error('update category errror cai lol, no ghi loi laij nha', $e->getMessage());
            return $this->responseError([], 500);
        }
    }

}
