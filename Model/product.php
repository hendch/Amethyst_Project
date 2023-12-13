<?php
class product {
    private ?int $id=null;
    private string $name;
    private int $price;
    private int $quantity;
    private int $category;
    private string $region;
    private string $description;
    private ?string $img=null;
    public function __construct( string $name, int $price, int $quantity, int $category, string $region, string $description,string $img )
    {
        $this->id=null;
        $this->name=$name;
        $this->price=$price;
        $this->quantity=$quantity;
        $this->category=$category;
        $this->region=$region;
        $this->description=$description;
        $this->img=$img;
    }
    public function getid()
    {
        return $this->id;
    }
    
    public function getname()
    {
        return $this->name;
    }
    public function setname($name)
    {
        return $this->name=$name;   
    }
    public function getquantity()
    {
        return $this->quantity;
    }
    public function setquantity($quantity)
    {
        return $this->quantity=$quantity;
    }
    public function getprice()
    {
        return $this->price;
    }
    public function setprice($price)
    {
        return $this->price=$price;
    }
    public function getcategory()
    {
        return $this->category;
    }
    public function setcategory($category)
    {
        return $this->category=$category;
    }
    public function getregion()
    {
        return $this->region;
    }
    public function setregion($region)
    {
        return $this->region=$region;
    }
    public function getdescription()
    {
        return $this->description;
    }
    public function setdescription($description)
    {
        return $this->description=$description;   
    }
    public function getimg()
    {
        return $this->img;
    }
    public function setimg($img)
    {
        return $this->img=$img;   
    }
}