<?php


	class ConnectionORM {
            
                function __construct() 
                {
                    $this->dbname = "parque";
                    $this->host = 'localhost';
                    $this->port = "5432";
                    $this->charset = "utf8";
                    $this->dsn = "pgsql:dbname=".$this->dbname.";host=".$this->host.";port=".$this->port;  
                    $this->username = 'postgres';
                    $this->password = '123456';
                    
                }            
		public function getConnect($connect = ''){
				
                    $connection = new PDO($this->dsn,$this->username, $this->password,array(PDO::ATTR_PERSISTENT => true));
                    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                    $connection->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
                    $connect = new NotORM($connection);
			
		return $connect;                    
                    
                    
	
		}
		
		
		
		
	}
