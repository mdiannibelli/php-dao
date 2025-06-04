<?php
require_once(__DIR__ . "/../../config/connection.php");
require_once(__DIR__ . "/../model/data/Dao.php");

class PdoDaoImpl extends DAO
{
    private $pdo;
    private $table;

    public function __construct($table)
    {
        $this->pdo = getPDO();
        $this->table = $table;
    }

    public function getAll()
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error at get all registers: " . $e->getMessage());
        }
    }

    public function getById($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                throw new Exception("Register with id {$id} not found.");
            }
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error at get register by id: " . $e->getMessage());
        }
    }

    public function create($entity)
    {
        try {
            $keys = array_keys($entity);
            $fields = implode(", ", $keys);
            $placeholders = implode(", ", array_fill(0, count($keys), '?'));

            $stmt = $this->pdo->prepare("INSERT INTO {$this->table} ($fields) VALUES ($placeholders)");
            $stmt->execute(array_values($entity));

            $entity['id'] = $this->pdo->lastInsertId();
            return $entity;
        } catch (PDOException $e) {
            throw new Exception("Error at creating register: " . $e->getMessage());
        }
    }

    public function update($id, $entity)
    {
        try {
            $fields = array_keys($entity);
            $setString = implode(", ", array_map(fn($f) => "$f = ?", $fields));

            $stmt = $this->pdo->prepare("UPDATE {$this->table} SET $setString WHERE id = ?");
            $success = $stmt->execute([...array_values($entity), $id]);

            if (!$success) {
                throw new Exception("Register with id {$id} can not update.");
            }

            return true;
        } catch (PDOException $e) {
            throw new Exception("Error at updating register: " . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
            $success = $stmt->execute([$id]);

            if (!$success || $stmt->rowCount() === 0) {
                throw new Exception("Register with id {$id} not found to delete.");
            }

            return true;
        } catch (PDOException $e) {
            throw new Exception("Error at deleting register: " . $e->getMessage());
        }
    }
}
?>