<?php
class User
{
    private string $FirstName; 
    private string $LastName;
    private int $PhoneNumber; 
    private string $Email ;
    private string $UserName; 


    public function __construct(string $Fname,string $Lname,int $phone,string $email,string $username)
    {
        $this->FirstName = $Fname;
        $this->LastName = $Lname;
        $this->PhoneNumber = $phone;
        $this->Email = $email;
        $this->UserName = $username;
    }
    public function getuser()
    {
        return $this->UserName;
    }

    public function setuser($username)
    {
        $this->UserName = $username;

        return $this;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getlname()
    {
        return $this->LastName;
    }

    public function setlname($Lname)
    {
        $this->LastName = $Lname;

        return $this;
    }
    public function getfname()
    {
        return $this->FirstName;
    }

    public function setfname($Fname)
    {
        $this->FirstName = $Fname;

        return $this;
    }

    public function getPhone()
    {
        return $this->PhoneNumber;
    }

    public function setPhone($phone)
    {
        $this->PhoneNumber = $phone;

        return $this;
    }





}