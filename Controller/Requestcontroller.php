<?php

require 'Config.php';


class requestcontroller
{
    public function listrequest()
    {
        $sql = "SELECT * FROM requests";
        $db = config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    /*public function listrequest()
    {
        $db = config::getConnexion();
        $sql = "SELECT * FROM customerservices";
        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }*/

    function showrequests($userid)
    {
        $sql = "SELECT * from requests where userid = $userid";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $requests = $query->fetch();
            return $requests;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function createrequest($request)
<<<<<<< HEAD
{
    $sql = "INSERT INTO requests (userid, reqtype, reqdate, servicestatus) 
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

        if ($query) {
            echo 'Request added successfully'; // Optional message indicating successful insertion
        } else {
            echo 'Error: Failed to add request'; // Error message for failed insertion
=======
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
                'servicestatus' => $request->getservicestatus(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
>>>>>>> dec5554de1f437b414be2187aad53904b16b7634
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage(); // Output error message if an exception occurs
    }
}

    function delete_request($userid)
    {
        $sql = "DELETE FROM requests WHERE userid = :userid";
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
                'UPDATE requests SET
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

<<<<<<< HEAD
=======
    public function pagination(){
        $page = isset($_GET['page']) ? (int)$_GET['page'] :1;
        $perpage = isset($_GET['perpage']) ? (int)$_GET['perpage'] :3;
        $db=config::getConnexion();
        $customerservices=$db->prepare("SELECT userid, reqtype, reqdate, servicestatus FROM customerservices LIMIT 0,5");
        $customerservices=execute();
        $customerservices=$customerservices->fetchAll(PDO::FETCH_ASSOC);
    }
>>>>>>> dec5554de1f437b414be2187aad53904b16b7634
}
?>