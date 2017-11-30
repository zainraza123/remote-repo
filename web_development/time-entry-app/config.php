<?php
// Report all errors
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Database Credentials
define('DATABASE_HOST', 'nkucaiserv9.nku.edu');
define('DATABASE_USER', 'time_entry');
define('DATABASE_PASSWORD', '7enwVmtadKPswWDW');
define('DATABASE_DB', 'time_entry');

// Document Root
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/time-entry/');

// Document Root
define('BASE', 'http://localhost/time-entry/');

// Template
define('TEMPLATE_NAME', 'admin');
define('ADMIN_TEMPLATE_NAME', 'basic');
define('TEMPLATE_BASE', BASE . 'templates/' . TEMPLATE_NAME . '/');
define('TEMPLATE_ROOT', ROOT . 'templates/' . TEMPLATE_NAME . '/');

// E-Mail
define('EMAIL_HOST', 'smtp.office365.com');
define('EMAIL_USER', 'caihelpdesk@nku.edu');
define('EMAIL_PASSWORD', 'Victor2017');
define('EMAIL_PORT', 587);
define('EMAIL_FROM', 'caihelpdesk@nku.edu');

// ldap
define('LDAP_SERVER', 'ldap://hh.nku.edu');

function my_autoloader($class)
{
    include(ROOT . 'classes/class.' . $class . '.php');
}

spl_autoload_register('my_autoloader');

require(ROOT . 'functions.php');

$database = new MySQL(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DB);

session_start();

//if $_SESSION['employeeID'], then set $employee = new Employee()
//else if employeeID is not set and current page isn't login.php redirect to login.php

if (isset($_SESSION['employee'])) {
    $employee = clone $_SESSION['employee'];
    $employee->database = $database;
} elseif ((isset($_SESSION['username'])) && (basename($_SERVER['PHP_SELF']) == 'register.php')) {
    //stay at register.php
} elseif ((!isset($_SESSION['employee'])) && (basename($_SERVER['PHP_SELF']) != 'login.php')) {
    header('Location: login.php');
}

/*$_SESSION['employee']->EOID = 61;
$employee->employeeID = 6444;
echo $_SESSION['employee']->EOID;*/
