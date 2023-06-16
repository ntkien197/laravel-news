<?php

namespace App\Repositories\Post;

use App\Helpers\GlobalHelper;
use App\Models\Post;
use App\Models\PostTranslate;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function getModel(): string
    {
        return Post::class;
    }

    public function getList($query)
    {
        // format lại
        $lang = GlobalHelper::formatLocale(app()->getLocale());

        $users = $this->model
            ->with([
                'postTranslate' => function ($builder) use ($query, $lang) {
                    $builder->where('lang_id', $lang);
                },
                'category' => function ($builder) use ($query, $lang) {
                    $builder->with([
                        'categoryTranslate' => function ($builder) use ($query, $lang) {
                            $builder->where('lang_id', $lang)->get();
                        },
                    ]);
                },
            ])
            ->paginate($query['perpage'], ['*'], 'page', $query['page']);

        return [
            'data' => $users->items(),
            'paginate' => [
                'total' => $users->total(),
                'currentPage' => $users->currentPage(),
                'perPage' => $users->perPage(),
                'pages' => $users->lastPage(),
            ]
        ];
    }

    public function createPostTranslate($params) {
        return PostTranslate::create($params);

    }
    public function getDetail($id)
    {
        // TODO: Implement getDetail() method.
        $lang = GlobalHelper::formatLocale(app()->getLocale());

        return $this->model->whereId($id)
            ->with([
                'postTranslate' => function ($builder) use($id, $lang) {
                    $builder->where('post_id',$id)->where('lang_id',$lang);
                },
            ])->first();
    }
    public function findDataTranslate($id, $lang)
    {
        return PostTranslate::where('post_id', $id)->where('lang_id', $lang)->first();
    }

    public function updateForTranslate($id, $params)
    {
        $lang = GlobalHelper::formatLocale($params->lang);
        $data = [
            'name' => $params->name,
            'title' => $params->title,
            'sub_title' => $params->sub_title,
            'content' => $params->content,
            'post_id' => $id
        ];
        return PostTranslate::where('post_id', $id)->where('lang_id', $lang)->update($data);
    }

}
