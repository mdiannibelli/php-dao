<?php

class BookValidator
{
    public static function validateBook(Book $book, array $existingBooks)
    {
        $errors = [];

        if (empty($book->getTitle())) {
            $errors[] = "Title required";
        }

        if (empty($book->getISBN())) {
            $errors[] = "ISBN required";
        }

        if (empty($book->getAuthor())) {
            $errors[] = "Author required";
        }

        if (!preg_match('/^\d{13}$/', $book->getISBN())) {
            $errors[] = 'ISBN must contain 13 digits';
        }

        if (is_nan($book->getAuthor())) {
            $errors[] = 'Author must be an id of type number';
        }

        foreach ($existingBooks as $existing) {
            if ($existing['isbn'] === $book->getISBN() && $existing['id'] !== $book->getId()) {
                $errors[] = "ISBN is already registered.";
                break;
            }
        }

        return $errors;
    }
}

?>