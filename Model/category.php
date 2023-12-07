<?php
class category {
    private string $catid;
    private string $abbr;
    private string $catname;
    public function __construct(string $catid, string $abbr, string $catname){
        $this->catid=$catid;
        $this->abbr=$abbr;
        $this->catname=$catname;
    }
    public function getcatid()
    {
        return $this->catid;
    }
    public function setcatid($catid)
    {
        return $this->catid=$catid;   
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