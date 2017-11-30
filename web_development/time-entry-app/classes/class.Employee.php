<?php

class Employee
{
    
    function __construct($employeeID = 0)
    {
        //global $database;
        //$this->database = $database;
    }
    
    static function addNewEmployee($username, $password)
    {
        global $database;
        // Hash a new password for storing in the database.
        // The function automatically generates a cryptographically safe salt.
        $hashToStoreInDB = password_hash($password, PASSWORD_BCRYPT);
        
        $sql = get_sql('addNewEmployee');
        $params = array('username' => $username, 'password' => $hashToStoreInDB);
        $database->executeQuery($sql, $params);
    }
    
    static function removeEmployee($id)
    {
        global $database;
        $sql = get_sql('removeEmployee');
        $params = array('id' => $id);
        $database->executeQuery($sql, $params);
    }
    
    static function activateEmployee($EOID)
    {
        global $database;
        $sql = get_sql('activateEmployee');
        $params = array (
            'EOID' => $EOID
        );
        $database->executeQuery($sql, $params);
    }
    
    static function deactivateEmployee($EOID)
    {
        global $database;
        $sql = get_sql('deactivateEmployee');
        $params = array(
            'EOID' => $EOID
        );
        $database->executeQuery($sql, $params);
    }
    
    static function checkPrivileges()
    {
        if ($_SESSION['employee']->role == 'Student') {
            header('Location: index.php');
        }
    }
}
