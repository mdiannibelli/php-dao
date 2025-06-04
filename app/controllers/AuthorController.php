<?php
require_once(__DIR__ . "/../repositories/FileDao.impl.php");
require_once(__DIR__ . "/../repositories/PdoDao.impl.php");
require_once(__DIR__ . "/../validators/AuthorValidator.php");
require_once(__DIR__ . "/../model/entities/Author.php");


class AuthorController
{
    private $dao;

    public function __construct($storageType = 'file')
    {
        if ($storageType === 'file') {
            $this->dao = new FileDaoImpl("authors.json");
        } else {
            $this->dao = new PdoDaoImpl("authors");
        }
    }

    private function createNewAuthorFromData($data)
    {
        $author = new Author(
            null,
            $data['name'],
            $data['nationality'] ?? null
        );
        return $author;
    }

    public function getAllAuthors()
    {
        try {
            return $this->dao->getAll();
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function getAuthorById($id)
    {
        try {
            return $this->dao->getById($id);
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function createAuthor($data)
    {
        try {
            $author = $this->createNewAuthorFromData($data);
            $errors = AuthorValidator::validateAuthor($author);
            if (count($errors) > 0) {
                return ["error" => $errors];
            }
            $entity = [
                'name' => $author->getName(),
                'nationality' => $author->getNationality(),
                'createdAt' => $author->getCreatedAt(),
                'updatedAt' => $author->getUpdatedAt(),
            ];
            return $this->dao->create($entity);

        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function updateAuthor($id, $data)
    {
        try {
            $author = $this->createNewAuthorFromData($data);
            $errors = AuthorValidator::validateAuthor($data);
            if (count($errors) > 0) {
                return ["error" => $errors];
            }
            $entity = [
                'name' => $author->getName(),
                'nationality' => $author->getNationality(),
                'createdAt' => $author->getCreatedAt(),
                'updatedAt' => $author->getUpdatedAt(),
            ];
            return $this->dao->update($id, $entity);
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function deleteAuthor($id)
    {
        try {
            return $this->dao->delete($id);
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }
}

?>