<?php
namespace App\Services;
use App\Repositories\UserRepositoryInterface;

class UserService{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function create(array $data){
       return  $this->userRepository->create($data);
    }
}