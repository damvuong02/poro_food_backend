<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService{
    protected $userRepo;

    /**
     * Class constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    function getAllUser(){
        return $this->userRepo->getAll();
    }

    function createUser($data){
        return $this->userRepo->create($data);
    }

}
