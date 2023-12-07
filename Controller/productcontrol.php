<?php

require '../config.php';

class productC
{

    public function listproducts()
    {
        $sql = "SELECT * FROM product";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteproduct($ide)
    {
        $sql = "DELETE FROM product WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addproduct($product)
    {
        $sql = "INSERT INTO product(id, name, price, quantity, category,region ,description)
        VALUES (:id, :name, :price,:quantity, :category,:region ,:description)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' =>$product->getid(),
                'name' =>$product->getname(),
                'price' =>$product->getprice(),
                'quantity' =>$product->getquantity(),
                'category' =>$product->getcategory(),
                'region' => $product->getregion(),
                'description' =>$product->getdescription(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showproduct($id)
    {
        $sql = "SELECT * from product where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $product = $query->fetch();
            return $product;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateproduct($product, $id)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE product SET 
                    name= :name, 
                    price = :price, 
                    quantity = :quantity, 
                    category = :category
                    region=:region;
                    description=:description;
                WHERE id= :id'
            );
            
            $query->execute([
                'id' => $id,
                'name' => $product->getname(),
                'price' => $product->getprice(),
                'quantity' => $product->geyquantity(),
                'category' => $product->getcategory(),
                'region' => $product->getregion(),
                'description' => $product->getdescription(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}