<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Models\Post;
use App\Repositories\BaseRepository;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function getModel(): string
    {
        // TODO: Implement getModel() method.
        return Comment::class;
    }
    public function getCommentByIdPost($query,$id) {
        $item = $this->model->where('post_id',$id)
            ->with([
                'user:id,name as username,email,avatar',
//                'user' => function($builder) {
//                    $builder->select('id','name as user_name')->get();
//                },
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

}
