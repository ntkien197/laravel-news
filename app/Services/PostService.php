<?php

namespace App\Services;

use App\Helpers\GlobalHelper;
use App\Repositories\Post\PostRepository;

class PostService
{
    public function __construct(
        protected PostRepository $repo
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

    public function createPostTranslate($params)
    {
        return $this->repo->createPostTranslate($params);
    }

    public function getDetail($id)
    {
        return $this->repo->getDetail($id);
    }
    public function findDataTranslate($id, $lang)
    {
        return $this->repo->findDataTranslate($id, $lang);

    }
    public function update($id, $params) {
        return $this->repo->update($id,$params);
    }
    public function updateForTranslate($id, $request)
    {
        $lang = GlobalHelper::formatLocale($request->lang);

        $post = $this->getDetail($id);
        // có cate nè
        if (!$post) {
            return false;
        }
        $params = [
            'views' => $request->views,
            'hot' => $request->hot,
            'category_id' => $request->category_id
        ];
        $this->update($id, $params);
        $dataTranslate = $this->findDataTranslate($id, $lang);
        if (!$dataTranslate) {
            $request['lang_id'] = $lang;
            $request['post_id'] = $id;
            return !!$this->createPostTranslate($request->all());
        }
        return !!$this->repo->updateForTranslate($id, $request);
    }
}
