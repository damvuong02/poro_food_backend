<?php

namespace App\Services;

use App\Events\CreateDeleteNotification;
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
        $this->waiterNotificationRepo->create($data);
        $allNotification = $this->waiterNotificationRepo->getAll();
        CreateDeleteNotification::dispatch($allNotification);
        return  $allNotification;
    }

    function deleteWaiterNotification($id){
        $this->waiterNotificationRepo->delete($id);
        return $this->waiterNotificationRepo->getAll();
    }

    
    
}
