<?php
require_once(__DIR__ . "/Model.php");

class Author extends Model
{
    private $name;
    private $nationality;

    public function __construct($id, $name, $nationality = null)
    {
        parent::__construct($id);
        $this->name = $name;
        $this->nationality = $nationality;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNationality()
    {
        return $this->nationality;
    }
}

?>