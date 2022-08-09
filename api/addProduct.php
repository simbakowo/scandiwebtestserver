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
include_once '../models/dvd.php';
include_once '../models/furniture.php';
include_once '../models/book.php';


// TODO: category checker
$category = "";


$data = json_decode(file_get_contents("php://input"));

$availableProductTypes = [
    "DVD"=> new DVD(),
    "Book"=> new Book(),
    "Furniture"=> new Furniture(),
];

$prod = $availableProductTypes[$data->category] ;

// Uses the magic setter
$prod->sku = $data->sku;
$prod->price = $data->price;
$prod->name = $data->name;
//$prod->category = $data->category;
$prod->attributeName = $data->attributeName;
$prod->attributeValue = $data->attributeValue;

$productMapper = new ProductMapper();

if($productMapper->addProduct($prod)){         
    http_response_code(201);         
    echo json_encode(array("created" => true));
} else{         
    http_response_code(503);        
    echo json_encode(array("message" => "Unable to create product."));
}


// TODO: Check SKU