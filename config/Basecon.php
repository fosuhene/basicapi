<?php
    class Database {
        //DB Params
        private $host = "localhost";
        private $dbuser= "root";
        private $dbpass = "";
        private $dbname = "api_myblog";

        private $conn;

        //DB Connect
        public function connect(){

            $this->conn = null;

            try {
                //code...
                $this->conn = new PDO('mysql:host='. $this->host. ';dbname='. $this->dbname, $this->dbuser, $this->dbpass);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                //throw $th;
                echo 'Connection Error: ' .$e->getMessage();
            }

            return $this->conn;
        }
         

    }
?>