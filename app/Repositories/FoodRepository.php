<?php

namespace App\Repositories;

use App\Models\Food;
use App\Repositories\BaseRepository;

class FoodRepository extends BaseRepository
{

    function getModel()
    {
        return Food::class;
    }
    public function getAll(){
        return $this->model->latest()->get()->load('category');
    }
    public function searchFood(string $value)
    {
        $result = $this->model->where('food_name','like','%'.$value.'%')->with('category')->paginate(10000);
        return $result;
    }
    
}