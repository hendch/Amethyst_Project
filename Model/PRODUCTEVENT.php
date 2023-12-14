<?php
require '../Config.php';

class ProductEvent
{
    private $name;
    private $image;
    private $price;
    private $artistName;
    private $description;
    private $comments;

    // Constructor
    public function __construct($name, $image, $price, $artistName, $description, $comments)
    {
        $this->name = $name;
        $this->image = $image;
        $this->price = $price;
        $this->artistName = $artistName;
        $this->description = $description;
        $this->comments = $comments;
    }

    // Getters and Setters for each attribute
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getArtistName()
    {
        return $this->artistName;
    }

    public function setArtistName($artistName)
    {
        $this->artistName = $artistName;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function setComments($comments)
    {
        $this->comments = $comments;
    }
}
?>