<?php

class AuthorValidator
{
    public static function validateAuthor(Author $author)
    {
        $errors = [];

        if (empty($author->getName())) {
            $errors[] = "Name required";
        }

        return $errors;
    }
}

?>