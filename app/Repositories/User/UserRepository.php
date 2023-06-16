<?php

namespace App\Repositories\User;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel(): string
    {
        return User::class;
    }

    public function getList($query)
    {
        $users = $this->model
            ->orderBy($query['column'], $query['sort'])
            ->paginate($query['perpage']);

        return [
            'data'    => $users->items(),
            'paginate' => [
                'total'       => $users->total(),
                'currentPage' => $users->currentPage(),
                'perPage'     => $users->perPage(),
                'pages'       => $users->lastPage(),
            ]
        ];
    }

    public function getByEmail($email) {
        return $this->model->where('email', $email)->first();
    }
    public function getById($id) {
        return $this->model->where('id', $id)->first();
    }
}
