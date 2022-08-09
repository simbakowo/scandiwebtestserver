<?php

// Headers, not here
// header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');

// MySQL logic should be handled by objects with 
// properties instead of direct column values. 
// Please use setters and getters for achieving this ?? 

include_once '../config/Database.php';
include_once '../models/product.php';

// consider extending Database
class ProductMapper extends Database {

    
    private $productsTable = "products1"; 

    public function __construct(){
        $this->connect();
    }	


    public function getProducts(){

        // Create query
        $query = "SELECT * FROM {$this->productsTable}";
        

        $stmt = $this->conn->query($query);
        
        $data = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
            $data[] = $row;
        }
        
        return $data;

    
        //return $products;
    }

    /**
     * If data is returned, it means a product with that sku already exits
     *
     * @param string   $sku  Product sku
     */ 
    public function getProductBySKU(string $sku){
        
        // Create query
        $query = "SELECT * 
                  FROM ".$this->productsTable."
                  WHERE sku = '{$sku}'";

        

        $stmt = $this->conn->query($query);

        

        $data = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
            $data[] = $row;
        }
        
        return empty($data);
    }

    public function addProduct(Product $prod){
        $query = "
        INSERT 
        INTO 
        Store.products1  
        (`sku`, `price`, `name`, `category`, `attributeName`, `attributeValue`) 
        VALUES 
        ('{$prod->sku}', '{$prod->price}', '{$prod->name}', '{$prod->category}', '{$prod->attributeName}', '{$prod->attributeValue}')";

        


    
        try {
            $stmt = $this->conn->prepare($query);
        } catch (Exception $e) {
            http_response_code(503); 

            echo 'Message: ' .$e->getMessage();
        }

    

        if($stmt->execute()){
            
            return true;
        }
        
        return false;
            
    }

    public function deleteProducts($products){
        $skus = str_replace(array('[',']'),'',$products);
        $query = "
        DELETE 
        FROM 
        Store.products1  
        WHERE sku
        IN ({$skus})";

        try {
            $stmt = $this->conn->prepare($query);
        } catch (Exception $e) {
            http_response_code(503); 

            echo 'Message: ' .$e->getMessage();
        }

        if($stmt->execute()){
            
            return true;
        }
        echo "Statement NOT executed";
        return false;
    }

}