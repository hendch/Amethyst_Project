<?php
require 'Config.php';
class MYSTERYBOXController
{
    public function display_MB()
    {
        $sql = "SELECT * FROM MYSTERYBOX";
        $db = config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e){
            die('Error:' . $e->getMessage());
        }
    }
    public function getMYSTERYBOXCount()
    {
        $sql = "SELECT COUNT(*) as mysterybox_count FROM MYSTERYBOX";
        $db = Config::getConnexion();

        try {
            $result = $db->query($sql);

            if ($result) {
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $mysteryboxCount = $row['mysterybox_count'];
                return $mysteryboxCount;
            } else {
                // Handle the error, log, or return a default value
                return 0;
            }
        } catch (Exception $e) {
            // Handle the exception, log, or return a default value
            return 0;
        }
    }
    public function addMYSTERYBOX($MYSTERYBOX) {
        $db = config::getConnexion(); 
        $sql = "INSERT INTO mysterybox (name, price, items, sold, image) VALUES (:name, :price, :items, :sold, :image)";
    
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'name' => $MYSTERYBOX->getName(),
                'price' => $MYSTERYBOX->getPrice(),
                'items' => $MYSTERYBOX->getItems(),
                'sold' => $MYSTERYBOX->getSold(),
                'image' => $MYSTERYBOX->getImage()
            ]);
            // Add log to verify if data is being passed correctly
            error_log('Inserted MYSTERYBOX: ' . $MYSTERYBOX->getName() . ', Price: ' . $MYSTERYBOX->getPrice() . ', Items: ' . $MYSTERYBOX->getItems());
    
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function deleteMYSTERYBOX($mysteryboxId)
    {
        $db = Config::getConnexion(); // Ensure the correct case for Config
        $sql = "DELETE FROM mysterybox WHERE id = :id"; // Assuming id is the primary key column name
        
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $mysteryboxId]);

            // Check if any rows were affected
            if ($query->rowCount() > 0) {
                return true; // Deletion successful
            } else {
                return false; // No rows affected, possibly ID doesn't exist
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false; // Return false on error
        }
    }
    
}
?>