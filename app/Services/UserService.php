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

    function updateUser($data, $id){
        return $this->userRepo->update($data, $id);
    }

    function deleteUser($id){
        return $this->userRepo->delete($id);
    }

    function searchUserByUserName($name){
        return $this->userRepo->search('user_name', $name);
    }

}
