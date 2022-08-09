<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
//header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
    header("HTTP/1.1 200 OK");
    die();
}

include_once '../mappers/productMapper.php';

$data = json_decode(file_get_contents("php://input"));

$productMapper = new ProductMapper();

if($productMapper->getProductBySKU($data->sku)){         
    http_response_code(201);         
    echo json_encode(array("exists" => false));
} elseif (!$productMapper->getProductBySKU($data->sku)){
    http_response_code(201);         
    echo json_encode(array("exists" => true));
}
else{         
    http_response_code(503);        
    echo json_encode(array("message" => "Something went wrong"));
}


// TODO: Check SKU