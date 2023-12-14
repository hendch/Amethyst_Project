<?php
require 'Config.php';

class PE_Controller
{
    public function display_PE()
    {
        $sql = "SELECT * FROM product_event"; // Adjust table name if needed
        $db = Config::getConnexion(); // Assuming Config.php contains the database configuration

        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e){
            die('Error:' . $e->getMessage());
        }
    }

    public function addProductEvent($productEvent)
    {
        $db = Config::getConnexion();
        $sql = "INSERT INTO product_event (name, price, artistName, description, comments, image) 
                VALUES (:name, :price, :artistName, :description, :comments, :image)";

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'name' => $productEvent->getName(),
                'price' => $productEvent->getPrice(),
                'artistName' => $productEvent->getArtistName(),
                'description' => $productEvent->getDescription(),
                'comments' => $productEvent->getComments(),
                'image' => $productEvent->getImage(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
?>
