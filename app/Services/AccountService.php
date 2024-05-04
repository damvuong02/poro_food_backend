<?php

namespace App\Services;

use App\Repositories\AccountRepository;
use Illuminate\Support\Facades\Hash;

class AccountService{
    protected $accountRepo;

    /**
     * Class constructor.
     */
    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepo = $accountRepository;
    }

    
    function getAllAccount(){
        return $this->accountRepo->getAll();
    }

    function createAccount($data){
        return $this->accountRepo->create($data);
    }

    function updateAccount($data, $id){
        return $this->accountRepo->update($data, $id);
    }

    function deleteAccount($id){
        return $this->accountRepo->delete($id);
    }

    function searchAccountByAccountName($name){
        return $this->accountRepo->search('user_name', $name);
    }

}
