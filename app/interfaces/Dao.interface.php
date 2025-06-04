<?php

interface DaoInterface
{
    public function getAll();
    public function getById($id);
    public function create($entity);
    public function update($id, $entity);
    public function delete($id);

}

?>