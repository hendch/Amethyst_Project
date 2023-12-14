<?php
class blog
{
    private ?int $blogid;
    private string $postcat;
    private string $blogtitle;
    private string $descriptionb;
   
    public function __construct(?int $blogid, string $postcat, string $blogtitle, string $descriptionb)
    {
        $this->blogid = $blogid;
        $this->postcat = $postcat;
        $this->blogtitle = $blogtitle;
        $this->descriptionb = $descriptionb;
    }


    public function getblogid()
    {
        return $this->blogid;
    }

    public function setblogid($blogid)
    {
        $this->blogid = $blogid;

        return $this;
    }

    public function getpostcat()
    {
        return $this->postcat;
    }


    public function setpostcat($postcat)
    {
        $this->postcat = $postcat;

        return $this;
    }

    public function getblogtitle()
    {
        return $this->blogtitle;
    }


    public function setblogtitle($blogtitle)
    {
        $this->blogtitle = $blogtitle;

        return $this;
    }


    public function getdescriptionb()
    {
        return $this->descriptionb;
    }


    public function setdescriptionb($descriptionb)
    {
        $this->descriptionb = $descriptionb;

        return $this;
    }

}