<?php


	class ConnectionORM {
    private $conn   = NULL;          
                function __construct() 
                {
                    $this->dbname = "parque";
                    $this->host = 'localhost';
                    $this->port = "5432";
                    $this->charset = "utf8";
                    $this->dsn = "pgsql:dbname=".$this->dbname.";host=".$this->host.";port=".$this->port;  
                    $this->username = 'postgres';
                    $this->password = '123456';
					return $this->open();
                    
                }            
		public function getConnect($connect = ''){
		
        $NotOrm = new NotORM($this->conn);
		return $NotOrm; 
           
		}
		
    public function open() {

        if (!is_resource($this->conn)){
            $this->conn = new PDO($this->dsn,$this->username,$this->password,array(PDO::ATTR_PERSISTENT => true,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        }
        return $this;
    }		
    public function close() {
		
		$this->conn = null;
    }
	public function getConn(){
		
		return $this->conn;
	}
	
		
	}
