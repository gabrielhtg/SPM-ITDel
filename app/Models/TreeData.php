<?php

namespace App\Models;

class TreeData
{
    public $imageURL;
    public $name;
    public $role;
    public $responsible;
    public $accountable;
    public $informable;
    public $employee;

    public function __construct($imageURL, $name, $role, $responsible, $accountable, $informable, $employee)
    {
        $this->imageURL = $imageURL;
        $this->name = $name;
        $this->role = $role;
        $this->responsible = $responsible;
        $this->accountable = $accountable;
        $this->informable = $informable;
        $this->employee = $employee;
    }
}
