<?php

require_once __DIR__ . '/../config.php';

class blogs
{

    public function listblog()
    {
        $sql = "SELECT * FROM blog";
        $db = config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addblog($blog)
    {
        $sql = "INSERT INTO blog (postcat, blogtitle, descriptionb) VALUES (:postcat, :blogtitle, :descriptionb)";
        $db = config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'postcat' => $blog->getpostcat(),
                'blogtitle' => $blog->getblogtitle(),
                'descriptionb' => $blog->getdescriptionb()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function showblog($blogid)
    {
        $db = config::getConnexion();
        $query = $db->prepare('SELECT * FROM blog WHERE blogid = :blogid');
        $query->bindParam(':blogid', $blogid, PDO::PARAM_INT);
        $query->execute();
    
        $blogData = $query->fetch(PDO::FETCH_ASSOC);
    
        if ($blogData) {
            return new blog(
                $blogData['blogid'],
                $blogData['postcat'],
                $blogData['blogtitle'],
                $blogData['descriptionb']
            );
        } else {
            return null;
        }
    }
    
    

    public function deleteblog($ide)
    {
        $sql = "DELETE FROM blog WHERE blogid = :blogid";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':blogid', $ide, PDO::PARAM_INT);
    
        try {
            $req->execute();
    

        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    public function updateblog($blog, $blogid)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE blog SET 
                    postcat = :postcat, 
                    blogtitle = :blogtitle, 
                    descriptionb = :descriptionb 
                 WHERE blogid = :blogid'
            );
    
            $query->bindParam(':blogid', $blogid, PDO::PARAM_INT);
            $query->bindParam(':postcat', $blog->getpostcat());
            $query->bindParam(':blogtitle', $blog->getblogtitle());
            $query->bindParam(':descriptionb', $blog->getdescriptionb());
    
            $query->execute();
    
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error updating blog: ' . $e->getMessage();
        }
    }
    
}

