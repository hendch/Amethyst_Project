<?php
class User
{
protected string $username;
protected string $email;
protected string $password;
protected string $registration_date;
public function __construct(string $username, string $email, string $password, string $registration_date)
{
$this->username = $username;
$this->email = $email;
$this->password = $password;
$this->registration_date = $registration_date;
}
// Getters and setters for each property
public function getUsername()
{
return $this->username;
}
public function setUsername($username)
{
$this->username = $username;
}
public function getEmail()
{
return $this->email;
}
public function setEmail($email)
{
$this->email = $email;
}
public function getPassword()
{
return $this->password;
}
public function setPassword($password)
{
$this->password = $password;
}
public function getRegistrationDate()
{
return $this->registration_date;
}
public function setRegistrationDate($registration_date)
{
$this->registration_date = $registration_date;
}
}
