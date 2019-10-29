<?php
   namespace core;
   use PDO;
   class DBManager{
      private $connection;
      public function __construct($host, $dbname, $user, $password){
          try{
              $this->connection = new PDO("mysql:host=".$host.";dbname=".$dbname,$user,$password);
          }catch (Exception $e) {
              echo "Error!: " . $e->getMessage() . "<br/>";
          }
      }
      public function getConnection(){
         return $this->connection;
      }
   }
?>