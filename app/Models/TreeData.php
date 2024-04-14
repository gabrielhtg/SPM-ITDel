<?php

namespace App\Models;

class TreeData
{
    public $imageURL;
    public $name;
    public $role;

    public function __construct($imageURL, $name, $role)
    {
        $this->imageURL = $imageURL;
        $this->name = $name;
        $this->role = $role;
    }
}
