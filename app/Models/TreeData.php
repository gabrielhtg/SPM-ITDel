<?php

namespace App\Models;

class TreeData
{
    public $imageURL;
    public $name;

    public function __construct($imageURL, $name)
    {
        $this->imageURL = $imageURL;
        $this->name = $name;
    }
}
