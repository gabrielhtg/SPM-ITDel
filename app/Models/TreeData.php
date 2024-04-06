<?php

namespace App\Models;

class TreeData
{
    public $imageURL;
    public $name;
    public $role;

    public function __construct($imageURL, $name)
    {
        $this->imageURL = $imageURL;
        $this->name = $name;
    }
}
