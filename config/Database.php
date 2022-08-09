<?php 
  abstract class Database {
    // DB Params
    private $host = '127.0.0.1';
    private $db_name = 'Store';
    private $username = 'simbakowo';
    private $password = 'password';
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;

      $options = [
          PDO::ATTR_EMULATE_PREPARES => false,
          PDO::ATTR_STRINGIFY_FETCHES => false
      ];

      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password, $options);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn; // no need if extending
    }

    // magic getter
    function __get($propName){

      
      $vars = array("conn");

      if (in_array($propName, $vars))
      {
          return $this->$propName;
      }else {
          return "No such variable!";
      }
  }
  }