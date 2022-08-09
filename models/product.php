<?php



abstract class Product {

    protected int $id;
    protected string $sku;
    protected $price;
    protected string $name;
    protected string $category;
    protected string $attributeName;
    protected string $attributeValue; //string, LxWxH or double 2.2 (MB/ Kg)
    

    
    // magic  setter
    function __set ($property, $value){
        //echo "Setter called in product";
        //echo "{$property} : {$value} \n";
        $this->$property = $value;
    }

    // magic getter
    function __get($propName){

        
        $vars = array("id","sku", "name", "price", "category", "attributeName", "attributeValue");

        if (in_array($propName, $vars))
        {
            return $this->$propName;
        }else {
            return "No such variable!";
        }
    }

    

}