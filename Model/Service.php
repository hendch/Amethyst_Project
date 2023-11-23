<?php
include 'C:/xampp/htdocs/WProjectART/Model/product.php';
include 'C:/xampp/htdocs/WProjectART/Model/User.php';

class customerservices {

    private int $userId;
    private string $reqType;
    private string $reqDate;
    private string $serviceStatus;

    public function __construct(int $userId, string $reqType, string $reqDate, string $serviceStatus)
    {
        $this->userId = $userId;
        $this->reqType = $reqType;
        $this->reqDate = $reqDate;
        $this->serviceStatus = $serviceStatus;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    public function getReqType()
    {
        return $this->reqType;
    }

    public function setReqType($reqType)
    {
        $this->reqType = $reqType;
    }

    public function getReqDate()
    {
        return $this->reqDate;
    }

    public function setReqDate($reqDate)
    {
        $this->reqDate = $reqDate;
    }

    public function getServiceStatus()
    {
        return $this->serviceStatus;
    }

    public function setServiceStatus($serviceStatus)
    {
        $this->serviceStatus = $serviceStatus;
    }
}