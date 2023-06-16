<?php

namespace App\Services;

use App\Helpers\GlobalHelper;
use App\Repositories\Category\CategoryRepository;

class CategoryService
{
    public function __construct(
        protected CategoryRepository $repo
    )
    {
    }

    public function getList($query)
    {
        return $this->repo->getList($query);
    }

    public function create($params)
    {
        return $this->repo->create($params);
    }

    public function getDetail($id)
    {
        return $this->repo->getDetail($id);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    public function createCategoryTranslate($params)
    {
        return $this->repo->createCategoryTranslate($params);
    }

    public function findDataTranslate($id, $lang)
    {
        return $this->repo->findDataTranslate($id, $lang);

    }

    public function update($id, $request)
    {
        $lang = GlobalHelper::formatLocale($request->lang);

        $category = $this->getDetail($id);
        // có cate nè
        if (!$category) {
            return false;
        }
        $dataTranslate = $this->findDataTranslate($id, $lang);
        if (!$dataTranslate) {
            $request['lang_id'] = $lang;
            $request['category_id'] = $id;
            return !!$this->createCategoryTranslate($request->all());
        }
         return !!$this->repo->updateForTranslate($id, $request);
    }
}
