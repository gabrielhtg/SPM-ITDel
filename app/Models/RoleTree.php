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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return null
     */
    public function getChildren()
    {
        return $this->children;
    }

    public function addChild(RoleTree $newChild)
    {
        $this->children[] = $newChild;
    }

    /**
     * @param null $children
     */
    public function setChildren($children): void
    {
        $this->children = $children;
    }
}
