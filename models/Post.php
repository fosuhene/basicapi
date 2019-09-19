<?php

class POST {
    //DB Conn Stuffs
    private $conn;
    private $table = 'posts';

    //post properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;


    //create constructor  => method that runs automatically when the class is instantiated

    public function __construct($db)
    {
            //set the connection to the passed db object
            $this->conn = $db;
    }

    //method to GET posts
    public function read(){
         //create query
         $query = 'SELECT 
                            c.name as category_name,
                            p.id,
                            p.category_id,
                            p.title,
                            p.body,
                            p.author,
                            p.created_at
                    FROM 
                            '.$this->table .' p
                            LEFT JOIN
                            categories c ON p.category_id = c.id
                            ORDER BY
                            p.created_at DESC';

                //prepared stmt
                $stmt = $this->conn->prepare($query);

                //excute query
                $stmt->execute();

                return $stmt;
        }
  
}

?>