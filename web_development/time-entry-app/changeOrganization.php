<?php
include( 'config.php' );

$template = new Template(TEMPLATE_ROOT . 'index.php');
$template->set('page_title', 'Change Organization');

ob_start();

//grabbing list of all organizations employee belongs to
$sql = get_sql('getEmployeesOrganizations');
$params = array(
    'username' => $employee->username
);
$organizations = $database->query($sql, $params);

//defining $orgNames as associative array 
//organizationID as the key and organizationName as the value
$orgNames = array();
foreach ($organizations as $key => $value) {
    $orgNames[$value['organizationID']] = $value['organizationName'];
}

//process changeOrganization submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $newOrganizationID = $_POST['organization'];
    $EOID = getEOID($employee->username, $newOrganizationID);
    $_SESSION['employee']->EOID = $EOID;
    $_SESSION['employee']->organizationID = $newOrganizationID;
    $_SESSION['employee']->organizationName = $orgNames[$newOrganizationID];
    header('Location: index.php');
}

include('views/changeOrganization.php');
$content = ob_get_clean();
$template->set('content', $content);
echo $template->fetch();