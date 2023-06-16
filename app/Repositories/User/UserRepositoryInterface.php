<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getList($query);

    public function getByEmail($email);

    public function getById($id);
}
