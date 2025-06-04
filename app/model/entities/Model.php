<?php

abstract class Model
{
    protected $id;
    private $createdAt;
    private $updatedAt;

    public function __construct($id)
    {
        $this->id = $id;
        $this->createdAt = date("Y-m-d H:i:s");
        $this->updatedAt = $this->createdAt;
    }

    private function changeUpdatedAt()
    {
        $now = date("Y-m-d H:i:s");
        $this->setUpdatedAt($now);
    }

    public function setId($id)
    {
        $this->id = $id;
        $this->changeUpdatedAt();
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updateDate)
    {
        $this->updateAt = $updateDate;
    }
}
?>