<?php
require_once(__DIR__ . "/app/controllers/BookController.php");
require_once(__DIR__ . "/app/controllers/AuthorController.php");

$bookController = new BookController('file');
$authorController = new AuthorController('file');

$authorResult = $authorController->createAuthor([
    "name" => "Marcos",
    "nationality" => "Argentina papá"
]);

$bookResult = $bookController->createBook([
    "title" => "El principito",
    "isbn" => "1234567891234",
    "authorId" => "1"
]);


print_r($authorResult);
print_r($bookResult);

?>