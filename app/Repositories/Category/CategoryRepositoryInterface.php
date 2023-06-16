<?php

namespace App\Repositories\Category;

use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getList($query);

    public function createCategoryTranslate($params);

    public function getDetail($id);

    public function findDataTranslate($id, $lang);

    public function updateForTranslate($id, $params);
}
