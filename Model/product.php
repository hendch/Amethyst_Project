<?php
class product {
    private string $id;
    private string $name;
    private int $quantity;
    private int $price;
    private string $category;
    private string $region;
    private string $description;
    public function __construct(string $id, string $name, int $quantity, int $price, string $category, string $region, string $description )
    {
        $this->id=null;
        $this->name=$name;
        $this->quantity=$q;
        $this->price=$p;
        $this->$category=$cat;
        $this->$region=$r;
        $this->description=$description;
    }
    public function getid()
    {
        return $this->id;
    }
    public function setid($id)
    {
        return $this->id=$id;   
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
}