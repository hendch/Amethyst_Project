<?php

require '../config.php';

class categoryC
{

    public function listcategory()
    {
        $sql = "SELECT * FROM category";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deletecategory($catid)
    {
        $sql = "DELETE FROM category WHERE catid = :catid";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':catid', $catid);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addcategory($category)
    {
        $sql = "INSERT INTO category( catid,abbr, catname)
        VALUES (:catid, :abbr, :catname)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'catid' =>$category->getcatid(),
                'abbr' =>$category->getabbr(),
                'catname' =>$category->getcatname(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showcategory($catid)
    {
        $sql = "SELECT * from category where catid = $catid";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $category = $query->fetch();
            return $category;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updatecategory($category)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE category SET 
                    abbr = :abbr, 
                    catname = :catname
                WHERE catid= :catid'
            );
            
            $query->execute([
                'catid' => $category->getcatid(),
                'abbr' => $category->getabbr(),
                'catname' => $category->getcatname(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}