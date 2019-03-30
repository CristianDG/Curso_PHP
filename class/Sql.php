<?php 

class Sql extends PDO{
    
    private $conn;
    
    private $dbname = "dbphp7";
    private $usr = "root";
    private $psw = "";


    public function __construct(){

        $this->conn = new PDO("mysql:host=localhost;dbname={$this->dbname}",$this->usr,$this->psw);
    }
    

    private function setParam($statement, $key, $val){
        $statement->bindParam($key,$val);
    }

    private function setParams($statement, $parameters = array()){
        foreach ($parameters as $key => $val) {
            $this->setParam($statement,$key,$val);
        }
    }


    public function query($rawQuery, $params = array()){
        
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt,$params);

        $stmt->execute();

        return $stmt;
    }

    public function select($rawQuery, $params = array()){
    
        $stmt = $this->query($rawQuery,$params);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    
    }

}

?>