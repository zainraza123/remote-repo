<?php 

/**
* MySQL is a class for creating a MySQL connection.
*
* $database = new MySQL();
*
* @package  Essential
* @author   Jesse Hockenbury <hockenburj1@nku.edu>
* @version  $Revision: 1.3 $
* @access   public
* @see      http://www.php.net/
*/

Class MySQL {
	private $connection;
        
        /**
         * MySQL is a class for creating a MySQL connection.
         *
         * @param String $host Database Host
         * @param String $user Database User
         * @param String $password Database Password
         * @param String $name Database Name
         */
	function __construct ($host, $user, $password, $name) {
            try {
    		$this->connection = new PDO("mysql:host=$host;dbname=$name", $user, $password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } 
		
            catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
	}
        
        function get_instance() {
            return $this->connection;
        }
        
        function executeQuery($sql, $params = array()) {  
            try {
                $sth = $this->connection->prepare($sql);
                $sth->execute($params);
            }
            
            catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
        
        function query($sql, $params = array()) { 
            
            try {
                $sth = $this->connection->prepare($sql);
                $sth->execute($params);

                $results = array();
                while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                    $results[] = $row;
                }
                return $results;
            }
            
            catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
        
        function queryObject($class, $sql, $params = array()) { 
            
            try {
                $sth = $this->connection->prepare($sql);
                $sth->execute($params);

                $results = $sth->fetchAll(PDO::FETCH_CLASS, $class);
                return $results;
            }
            
            catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
        
        function insert($table, $params) {
            if (empty($params)) {
                return;
            }
            
            $columns = "(" . implode(", ", array_keys($params)) . ")";
            $values = "('" . implode("', '", array_values($params)) . "')";
            
            $sql = "INSERT INTO $table $columns VALUES $values";
            
            try {
                $sth = $this->connection->prepare($sql);
                $sth->execute();
            }
            
            catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
        
        function close() {
            $this->connection = null;
        }
        
        function last_insert_id() {
            return $this->connection->lastInsertId();
        }
    
        function prepare($sql) {
            $preparedStatement = $this->connection->prepare($sql);
            $this->preparedStatement = $preparedStatement;
        }
    
        function queryPrepared($params = array()) {
            try {
                $this->preparedStatement->execute($params);
            }
            
            catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        static function clean($tring){
            strip_tags($tring);
        }
}


