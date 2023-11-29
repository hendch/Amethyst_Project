<?php

require '../config.php';

class requestcontroller
{
    public function listrequest()
    {
        $sql = "SELECT * FROM customerservices";
        $db = config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function showrequests($userid)
    {
        $sql = "SELECT * from customerservices where userid = $userid";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $customerservices = $query->fetch();
            return $customerservices;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function createrequest($request)
    {
        $sql = "INSERT INTO customerservices (userid, reqtype, reqdate, servicestatus) 
        VALUES (:userid, :reqtype, :reqdate, :servicestatus)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'userid' => $request->getuserid(),
                'reqtype' => $request->getreqtype(),
                'reqdate' => $request->getreqdate(),
                'servicestatus' => $request->getservicestatus()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    function delete_request($userid)
    {
        $sql = "DELETE FROM customerservices WHERE userid = :userid";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':userid', $userid);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function updaterequest($request)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE customerservices SET
                    reqtype = :reqtype, 
                    reqdate = :reqdate,
                    servicestatus = :servicestatus 
                WHERE userid = :userid'
            );
    
            $query->execute([
                'userid' => $request->getuserid(),
                'reqtype' => $request->getreqtype(),
                'reqdate' => $request->getreqdate(),
                'servicestatus' => $request->getservicestatus()
            ]);
    
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
}
?>