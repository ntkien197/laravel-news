<?php

namespace App\Repositories\Post;

use App\Repositories\RepositoryInterface;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function getList($query);

    public function createPostTranslate($params);

    public function getDetail($id);

    public function findDataTranslate($id, $lang);

    public function updateForTranslate($id, $params);

}
