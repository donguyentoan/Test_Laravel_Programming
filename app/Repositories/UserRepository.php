<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class  UserRepository implements UserRepositoryInterface {
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function create(array $data)
    {
        return $this->model->create( $data );
    }

}