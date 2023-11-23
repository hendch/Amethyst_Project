<?php
require "C:/xampp/htdocs/WProjectART/config.php";

class servicecontroller
{

    public function list_reuqests()
    {
        $sql = "SELECT * FROM customerservices";
        $db = config::getConnexion();
        try {
            $list = $this->db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function create_request($customerservices)
    {
        $sql = "INSERT INTO customerservices 
        VALUES (:Req_type, :Req_date, :Servicestatus)";
        $db = config::getConnexion();
        try {
            $query = $this->db->prepare($sql);
            $query->execute([
                'Req_type' => $customerservices->getReq_type(),
                'Req_date' => $customerservices->getReq_date(),
                'Servicestatus' => $customerservices->getServicestatus()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function delete_request($Userid, $Productid)
    {
        $sql = "DELETE FROM customerservices WHERE id = :id";
        
        try {
            $query = $this->db->prepare($sql);
            $query->execute(['id' => $Userid]);

            if ($query->rowCount() > 0) {
                return true; 
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function show_requests($Userid, $Productid)
    {
        $sql = "SELECT * from customerservices where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $joueur = $query->fetch();
            return $customerservices;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function update_request_status($customerservices, $Userid, $Productid)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE customerservices SET 
                    Servicestatus = :Servicestatus, 
                WHERE id= :userid'
            );
            
            $query->execute([
                'Servicestatus' => $customerservices->getServicestatus(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
?>