<?php
require_once(__DIR__ . "/../interfaces/Dao.interface.php");
abstract class DAO implements DaoInterface
{
    public abstract function getAll();
    public abstract function getById($id);
    public abstract function create($entity);
    public abstract function update($id, $entity);
    public abstract function delete($id);
}

?>