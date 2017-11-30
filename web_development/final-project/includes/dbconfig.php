<?php
    class Database
{
     
    private $host = "csweb.hh.nku.edu";
    private $db_name = "db_fall17_razaz1";
    private $username = "razaz1";
    private $password = "Qou7riad";
    public $conn;
     
    public function dbConnection()
	{
     
	    $this->conn = null;
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
}
?>