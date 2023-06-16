<?php

namespace App\Services;

use App\Repositories\User\UserRepository;

class UserService
{
    public function __construct(
        protected UserRepository $repo
    )
    {

    }

    public function getList($query)
    {
        return $this->repo->getList($query);
    }

    public function getByEmail($email)
    {
        return $this->repo->getByEmail($email);
    }

    public function create($params)
    {
        return $this->repo->create($params);
    }
    public function update($id,$data = [])
    {
        return $this->repo->update($id,$data);
    }

    public function getById($id)
    {
        return $this->repo->getById($id);
    }
}
