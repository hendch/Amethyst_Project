<?php
require '../Config.php';
class UserController
{
    public function listUser()
    {
        $sql = "SELECT * FROM users";
        $db = Config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e){
            die('Error:' . $e->getMessage());
        }
    }
    public function addUser($user) {
    

        $db = Config::getConnexion(); 
        $sql = "INSERT INTO users (fname, lname, age) VALUES (:fname, :lname, :age)";
        error_log($user);

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'fname' => $user->getFirstname(),
                'lname' => $user->getLastname(),
                'age' => $user->getAge()
            ]);


        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


}
?>