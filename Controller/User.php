<?php
require '../Config.php';
class Users
{
    public function listUsers()
    {
        $sql="SELECT * FROM usertest";
        $db = config::getConnexion();
        try 
        {
            $list = $db->query($sql);
            return $list;
        }
        catch (Exception $e)
        {
            die('Error:' . $e->getMessage());
        }
    }

// Update the deleteuser method in the Users class
    /* public function deleteuser($phoneNumber)
{
    try {
        $stmt = $this->conn->prepare("DELETE FROM your_table_name WHERE PhoneNumber = :phoneNumber");
        $stmt->bindParam(':phoneNumber', $phoneNumber);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} */

    function deleteuser($ide)
{
    $sql = "DELETE* FROM usertest WHERE PhoneNumber = :id";
    $db = config::getConnexion();
    $req = $db->prepare($sql);
    $req->bindValue(':id', $ide);

    try {
        $req->execute();
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}

    function addUser($User) 
    {
        $sql = "INSERT INTO usertest(FirstName,LastName, PhoneNumber,Email,UserName)
         VALUES (:Fname,:Lname,:phone,:email,:username)";
        $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
            $query->execute([
                'Fname'=> $User->getfname(),
                'Lname'=>$User->getlname(),
                'phone'=>$User->getPhone(),
                'email'=>$User->getEmail(),
                'username'=>$User->getuser()
            ]);
        } catch(Exception $e){
            echo 'Error: ' .$e->getMessage();
        }
    }

    function showUser($id)
    {
        $sql = "SELECT * from usertest";
        $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
            $query->execute();
            $usertest = $query->fetch();
            return $usertest;
        } catch (Exception $e){
            die('Error:' . $e->getMessage());
        }
    }

    function updateuser($User,$id)
    {
        try{
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE User SET
                User Name=:username
                First Name=:Fname
                Last Name=:Lname
                Email=:email
                Phone Number=phone
                WHERE user_id=:iduser'
            );
            $query->execute([
                'Fname'=> $User->getFirstName(),
                'Lname'=>$User->getLastName(),
                'email'=>$User->getEmail(),
                'phone'=>$User->getPhoneNumber(),
                'username'=>$User->getUserName(),
            ]);
            echo $query->rowCount() . "records UPDATED succesfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    
    
    public function searchUsers($searchTerm) {
        $db = config::getConnexion();
        $stmt = $db->prepare("SELECT * FROM usertest WHERE FirstName LIKE :searchTerm OR LastName LIKE :searchTerm OR UserName LIKE :searchTerm");
        
        // Use bindValue instead of bindParam
        $stmt->bindValue(':searchTerm', "%$searchTerm%", PDO::PARAM_STR);
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function getUsersWithPagination($page, $perPage) {
        $offset = max(0, ($page - 1) * $perPage); // Ensure the offset is non-negative
        $sql = "SELECT * FROM usertest LIMIT $offset, $perPage";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

        public function getTotalUsers() {
            $db = config::getConnexion();
            $stmt = $db->query("SELECT COUNT(*) FROM usertest");
            return $stmt->fetchColumn();
        }
    
        public function rateUser($PhoneNumber, $rating) {
            $db = config::getConnexion();
            $stmt = $db->prepare("UPDATE usertest SET Rating = :rating WHERE PhoneNumber = :PhoneNumber");
            $stmt->bindParam(':rating', $rating);
            $stmt->bindParam(':PhoneNumber', $PhoneNumber);
            $stmt->execute();
        }
    
        public function getUserRating($PhoneNumber) {
            $db = config::getConnexion();
            $stmt = $db->prepare("SELECT Rating FROM usertest WHERE PhoneNumber = :PhoneNumber");
            $stmt->bindParam(':PhoneNumber', $PhoneNumber);
            $stmt->execute();
            return $stmt->fetchColumn();
        }
    }
    
