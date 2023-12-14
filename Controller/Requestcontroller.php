<?php

require 'Config.php';


class requestcontroller
{
    public function listrequest()
    {
        $sql = "SELECT * FROM customerservices";
        $db = Config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    /*public function listrequest()
    {
        $db = Config::getConnexion();
        $sql = "SELECT * FROM customerservices";
        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) 
            die('Error:' . $e->getMessage());
        }
    }*/

    function showrequests($userid)
    {
        $sql = "SELECT * from customerservices where userid = $userid";
        $db = Config::getConnexion();
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
    $db = Config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'userid' => $request->getuserid(),
            'reqtype' => $request->getreqtype(),
            'reqdate' => $request->getreqdate(),
            'servicestatus' => $request->getservicestatus()
        ]);

        if ($query) {
            echo 'Request added successfully'; // Optional message indicating successful insertion
        } else {
            echo 'Error: Failed to add request'; // Error message for failed insertion
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage(); // Output error message if an exception occurs
    }
}

    function delete_request($userid)
    {
        $sql = "DELETE FROM customerservices WHERE userid = :userid";
        $db = Config::getConnexion();
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
            $db = Config::getConnexion();
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