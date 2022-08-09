<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


try {
    include_once '../mappers/productMapper.php';

    $mapper = new ProductMapper();

    $getResult = $mapper->getProducts();

     
    echo json_encode($getResult);

    http_response_code(200); 

    
} catch (Exception $e) {
    echo 'Message: ' .$e->getMessage();
}
