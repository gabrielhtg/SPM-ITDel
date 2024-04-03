<?php

namespace App\Models;

class RoleTree {

    public $id;
    public $data;
    public $children = null;

    public function __construct($id, $data, $children)
    {
        $this->id = $id;
        $this->data = $data;
        $this->children = $children;
    }

}
