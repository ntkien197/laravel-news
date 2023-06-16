<?php

namespace App\Repositories\Category;

use App\Helpers\GlobalHelper;
use App\Models\Category;
use App\Models\CategoryTranslate;
use App\Repositories\BaseRepository;


class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel(): string
    {
        return Category::class;
        // TODO: Implement getModel() method.
    }

    public function getList($query)
    {
        // TODO: Implement getList() method.
        $lang = GlobalHelper::formatLocale(app()->getLocale());

        $item = $this->model
            ->with([
                'categoryTranslate' => function ($builder) use ($query, $lang) {
                    $builder->where('lang_id', $lang)->get();
                },
                'user'
            ])
            ->paginate($query['perpage'], ['*'], 'page', $query['page']);

        return [
            'data' => $item->items(),
            'paginate' => [
                'total' => $item->total(),
                'currentPage' => $item->currentPage(),
                'perPage' => $item->perPage(),
                'pages' => $item->lastPage(),
            ]
        ];
    }

    public function createCategoryTranslate($params)
    {
//        $data = [
//            'name' => $params->name,
//            'title' => $params->title,
//            'description' => $params->description,
//            'lang_id' => GlobalHelper::formatLocale($params->lang_id),
//            'category_id' => $params->id,
//        ];
        return CategoryTranslate::create($params);
    }

    public function getDetail($id)
    {
        $lang = GlobalHelper::formatLocale(app()->getLocale());
        // TODO: Implement getDetail() method.
        return $this->model->whereId($id)
            ->with([
                'categoryTranslate' => function ($builder) use ($id, $lang) {
                    $builder->where('category_id', $id)->where('lang_id', $lang);
                },
            ])->first();
    }

    public function findDataTranslate($id, $lang)
    {
        return CategoryTranslate::where('category_id', $id)->where('lang_id', $lang)->first();
    }

    public function updateForTranslate($id, $params)
    {
        $lang = GlobalHelper::formatLocale($params->lang);
        $data = [
            'name' => $params->name,
            'title' => $params->title,
            'description' => $params->description,
            'category_id' => $id
        ];
        return CategoryTranslate::where('category_id', $id)->where('lang_id', $lang)->update($data);
    }
}
