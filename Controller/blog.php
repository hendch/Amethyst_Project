<?php

require '../config.php';

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
        $sql = "INSERT INTO blog(blogid,postcat,blogtitle,descriptionb)  
        VALUES (:blogid,:postcat,:blogtitle,:descriptionb)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'blogid' => $blog->getblogid(),
                'postcat' => $blog->getpostcat(),
                'blogtitle' => $blog->getblogtitle(),
                'description' => $blog->getdescriptionb()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function deleteblog($ide)
    {
        $sql = "DELETE FROM blog WHERE id = :blogid";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    public function showblog($id)
    {
        $sql = "SELECT * from blog where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $blog = $query->fetch();
            return $blog;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateblog($blog, $id)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE blogs SET 
                    userid = :userid, 
                    blogid = :blogid, 
                    postid = :postid, 
                WHERE id= :blogid'
            );
            
            $query->execute([
                'blogid' => $id,
                'userid' => $blogs->getuserid(),
                'postid' => $blogs->getposttid(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
