<?php

namespace App\Repositories;

use App\Models\Account;
use App\Repositories\BaseRepository;

class AccountRepository extends BaseRepository
{

    function getModel()
    {
        return Account::class;
    }

    

}