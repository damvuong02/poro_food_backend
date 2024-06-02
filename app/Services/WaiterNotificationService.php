<?php

namespace App\Services;

use App\Repositories\WaiterNotificationRepository;

class WaiterNotificationService{
    protected $waiterNotificationRepo;

    /**
     * Class constructor.
     */
    public function __construct(WaiterNotificationRepository $waiterNotificationRepository)
    {
        $this->waiterNotificationRepo = $waiterNotificationRepository;
    }
    
    
    function getAllWaiterNotification(){
        return $this->waiterNotificationRepo->getAll();
    }

    function createWaiterNotification($data){
        return $this->waiterNotificationRepo->create($data);
    }

    function deleteWaiterNotification($id){
        $this->waiterNotificationRepo->delete($id);
        return $this->waiterNotificationRepo->getAll();
    }

    
    
}
