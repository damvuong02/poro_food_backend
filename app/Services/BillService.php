<?php

namespace App\Services;

use App\Repositories\BillRepository;

class BillService{
    protected $billRepo;

    /**
     * Class constructor.
     */
    public function __construct(BillRepository $billRepository)
    {
        $this->billRepo = $billRepository;
    }
    
    function getAllBill(){
        return $this->billRepo->getAll();
    }

    function createBill($data){
        return $this->billRepo->create($data);
    }

    function updateBill($data, $id){
        return $this->billRepo->update($data, $id);
    }

    function deleteBill($id){
        return $this->billRepo->delete($id);
    }
    
    function findById($id){
        return $this->billRepo->findById($id);
    }

    function getBillsToday(){
        return $this->billRepo->getBillsToday();
    }

    function getRevenueByDayInWeek(){
        return $this->billRepo->getRevenueByDayInWeek();
    }

    function getRevenueByMonthInYear(){
        return $this->billRepo->getRevenueByMonthInYear();
    }
    
}
