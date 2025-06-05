<?php
require_once(__DIR__ . "/Model.php");

class Book extends Model
{
    private $title;
    private $isbn;
    private $publishDate;
    private $authorId;

    public function __construct($id, $title, $isbn, $publishDate = null, $authorId)
    {
        parent::__construct($id);
        $this->title = $title;
        $this->isbn = $isbn;
        $this->publishDate = $publishDate;
        $this->authorId = $authorId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getISBN()
    {
        return $this->isbn;
    }

    public function getPublishDate()
    {
        return $this->publishDate;
    }

    public function getAuthor()
    {
        return $this->authorId;
    }
}

?>