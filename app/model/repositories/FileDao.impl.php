<?php
require_once(__DIR__ . "/../interfaces/Dao.interface.php");
require_once(__DIR__ . "/../data/Dao.php");

class FileDaoImpl extends DAO
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;

        if (!file_exists($this->file)) {
            if (file_put_contents($this->file, json_encode([])) === false) {
                throw new Exception("File can not be created: {$this->file}");
            }
        }
    }

    private function readData()
    {
        try {
            $contents = file_get_contents($this->file);

            if ($contents === false) {
                throw new Exception("File can not be readed: {$this->file}");
            }

            $data = json_decode($contents, true);
            if (!is_array($data)) {
                throw new Exception("Invalid JSON format: {$this->file}");
            }

            return $data;
        } catch (Exception $e) {
            throw new Exception("Error at reading data: " . $e->getMessage());
        }
    }

    private function writeData($data)
    {
        try {
            $json = json_encode($data, JSON_PRETTY_PRINT);
            if ($json === false) {
                throw new Exception("Error at encode data in JSON.");
            }

            if (file_put_contents($this->file, $json) === false) {
                throw new Exception("Could not write to file: {$this->file}");
            }
        } catch (Exception $e) {
            throw new Exception("Error at writing data: " . $e->getMessage());
        }
    }

    // Métodos públicos (DAO)
    public function getAll()
    {
        return $this->readData();
    }

    public function getById($id)
    {
        $data = $this->readData();
        foreach ($data as $item) {
            if ($item['id'] === $id) {
                return $item;
            }
        }
        throw new Exception("Register with id {$id} not found.");
    }

    public function create($entity)
    {
        $data = $this->readData();
        $entity['id'] = uniqid();
        $data[] = $entity;
        $this->writeData($data);
        return $entity;
    }

    public function update($id, $entity)
    {
        $data = $this->readData();
        foreach ($data as $index => $item) {
            if ($item['id'] === $id) {
                $entity['id'] = $id;
                $data[$index] = $entity;
                $this->writeData($data);
                return $entity;
            }
        }
        throw new Exception("Register with id {$id} not found to update.");
    }

    public function delete($id)
    {
        $data = $this->readData();
        foreach ($data as $index => $item) {
            if ($item['id'] === $id) {
                array_splice($data, $index, 1);
                $this->writeData($data);
                return true;
            }
        }
        throw new Exception("Register with id {$id} not found to delete.");
    }
}
?>