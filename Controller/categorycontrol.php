<?php

require 'Config.php';

class categoryC
{
    public function listproducts($catid) {
        try {
            $pdo = Config::getConnexion();
            $query = $pdo->prepare("SELECT * FROM product WHERE category = :id");
            $query->execute(['id' => $catid]);
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function listcategory()
    {
        $sql = "SELECT * FROM category";
        $db = Config::getConnexion();
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
        $db = Config::getConnexion();
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
        $db = Config::getConnexion();
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
        $db = Config::getConnexion();
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
            $db = Config::getConnexion();
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