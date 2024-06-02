<?php

namespace App\Repositories;

use App\Models\Food;
use App\Repositories\BaseRepository;

class FoodRepository extends BaseRepository
{

    public function getModel()
    {
        return Food::class;
    }
    public function getAll()
    {
        return $this->model->latest()->get()->load('category');
    }

    public function create($data = [])
    {
        $result = $this->model->create($data);
        if ($result) {
            return $result->load('category');
        }
        return false;
    }

    public function update($data = [], $id)
    {
        $result = $this->model->find($id);
        if ($result) {
            $result->update($data);
            return $result->load('category');
        }
        return false;
    }

    public function updateSoldQuantity($quantity, $id)
    {
        $result = $this->model->find($id);
        if ($result) {
            $result->update($result->quantity_sold + $quantity);
            return true;
        }
        return false;
    }

    public function searchFood(string $value, int $category_id)
    {
        if ($category_id == null) {

            $result = $this->model->where('food_name', 'like', '%' . $value . '%')->with('category')->paginate(10000);
            return $result;
        } else {
            $result = $this->model->where('food_name', 'like', '%' . $value . '%')->where('category_id', $category_id)->with('category')->paginate(10000);
            return $result;
        }
    }

    public function getTopFoodQuantitySold()
    {
        $topFoods = Food::orderByDesc('quantity_sold')->take(5)->get()->load('category');
        return $topFoods;
    }
    public function updateBeginOrder($data)
    {
        foreach ($data as $value) {
            $a = $this->model->find($value['food_id']);
            if ($a) {
                $b = $a->quantity;
                return $b;
                $a->quantity = $b + 6;
                $a->quantity_sold = 3;
                $a->save();
            }
        }
    }

}
