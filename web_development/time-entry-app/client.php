<?php

include('config.php');

//send student away if navigating here
Employee::checkPrivileges();

//set template
$template = new Template(TEMPLATE_ROOT . 'index.php');
$template->set('page_title', 'Clients');

//Retrieve any and all get variables
$action = get('action');
$id = get('id');

ob_start();

switch ($action) {
    case 'add':
        $action = 'Add';
        $client = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sql = get_sql('insertResearchAgreement');
            $params = array(
                'research_agreement' => post('research_agreement'),
                'companyName' => post('companyName'),
                'organizationID' => $employee->organizationID
            );
            $database->executeQuery($sql, $params);
            setMessage('success', 'You have successfully added a client.');
            header('location: client.php');
            die();
        }

        include('views/manager/clientForm.php');
        break;
    case 'edit':
        $RAID = get('RAID');
        $action = 'Edit';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sql = get_sql('updateResearchAgreement');
            $params = array(
                'research_agreement' => post('research_agreement'),
                'companyName' => post('companyName'),
                'RAID' => $RAID
            );
            $database->executeQuery($sql, $params);
            setMessage('success', 'You have successfully updated a client.');
            header('location: client.php');
            die();
        }

        $sql = get_sql('getClient');
        $params = array(
            'RAID' => $RAID
        );
        $clients = $database->query($sql, $params);
        $client = $clients[0];

        include('views/manager/clientForm.php');
        break;
    default:
        //Get all employees for table
        $sql = get_sql('getClients');
        $params = array(
            'organizationID' => $employee->organizationID
        );
        $clients = $database->query($sql, $params);
        include('views/manager/allClients.php');
}

$content = ob_get_clean();
$template->set('content', $content);
echo $template->fetch();
