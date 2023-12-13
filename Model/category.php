<?php
class category {
    private ?int $catid=null;
    private string $abbr;
    private string $catname;
    public function __construct(string $abbr, string $catname){
        $this->catid=null;
        $this->abbr=$abbr;
        $this->catname=$catname;
    }
    public function getcatid()
    {
        return $this->catid;
    }
    public function getabbr()
    {
        return $this->abbr;
    }
    public function setabbr($abbr)
    {
        return $this->abbr=$abbr;
    }
    public function getcatname()
    {
        return $this->catname;
    }
    public function setcatname($catname)
    {
        return $this->catname=$catname;   
    }
    
}