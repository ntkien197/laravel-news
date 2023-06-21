<?php

namespace App\Services;

use App\Repositories\Comment\CommentRepository;

class CommentService
{
    public function __construct(
        protected CommentRepository $repo
    )
    {
    }
    public function create($param) {
        return $this->repo->create($param);
    }
    public function getCommentByIdPost($query,$id) {
        return $this->repo->getCommentByIdPost($query,$id);
    }
}
