<?php

namespace App\Repositories;

use App\Models\Table;
use App\Repositories\BaseRepository;

class TableRepository extends BaseRepository
{

    function getModel()
    {
        return Table::class;
    }

    public function findByTableStatus($table_status) {
        $result = $this->model->where('table_status', $table_status)->paginate(10000);
        if($result){
            return $result;
        }
        return false;
    }
    
}