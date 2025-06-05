<?php
require_once(__DIR__ . "/../model/repositories/FileDao.impl.php");
require_once(__DIR__ . "/../model/repositories/PdoDao.impl.php");
require_once(__DIR__ . "/../model/validators/BookValidator.php");
require_once(__DIR__ . "/../model/entities/Book.php");

class BookController
{
    private $dao;

    public function __construct($storageType = 'file')
    {
        if ($storageType === 'file') {
            $this->dao = new FileDaoImpl("books.json");
        } else {
            $this->dao = new PdoDaoImpl("books");
        }
    }

    private function createNewBookFromData($data)
    {
        $book = new Book(
            null,
            $data['title'],
            $data['isbn'],
            $data['publishDate'] ?? null,
            $data['authorId']
        );
        return $book;
    }

    public function getAllBooks()
    {
        try {
            return $this->dao->getAll();
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function getBookById($id)
    {
        try {
            return $this->dao->getById($id);
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function createBook($data)
    {
        try {
            $book = $this->createNewBookFromData($data);
            $errors = BookValidator::validateBook($book, $this->dao->getAll());
            if (count($errors) > 0) {
                return ["error" => $errors];
            }

            $entity = [
                'title' => $book->getTitle(),
                'isbn' => $book->getISBN(),
                'publishedDate' => $book->getPublishDate(),
                'author' => $book->getAuthor(),
                'createdAt' => $book->getCreatedAt(),
                'updatedAt' => $book->getUpdatedAt(),
            ];
            return $this->dao->create($entity);
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function updateBook($id, $data)
    {
        try {
            $book = $this->createNewBookFromData($data);
            $errors = BookValidator::validateBook($book, $this->dao->getAll());
            if (count($errors) > 0) {
                return ["error" => $errors];
            }

            $entity = [
                'title' => $book->getTitle(),
                'isbn' => $book->getISBN(),
                'publishedDate' => $book->getPublishDate(),
                'author' => $book->getAuthor(),
                'createdAt' => $book->getCreatedAt(),
                'updatedAt' => $book->getUpdatedAt(),
            ];
            return $this->dao->update($id, $entity);
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function deleteBook($id)
    {
        try {
            return $this->dao->delete($id);
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }
}

?>