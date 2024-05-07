<?php

namespace App\Services;

use App\Repositories\FoodRepository;

class FoodService{
    protected $foodRepo;

    /**
     * Class constructor.
     */
    public function __construct(FoodRepository $foodRepository)
    {
        $this->foodRepo = $foodRepository;
    }
    
    
    function getAllFood(){
        return $this->foodRepo->getAll();
    }

    function createFood($data){
        return $this->foodRepo->create($data);
    }

    function updateFood($data, $id){
        return $this->foodRepo->update($data, $id);
    }

    function deleteFood($id){
        return $this->foodRepo->delete($id);
    }
    
    function findById($id){
        return $this->foodRepo->findById($id);
    }

    function searchFood($foodName){
        return $this->foodRepo->searchFood($foodName);
    }
}
