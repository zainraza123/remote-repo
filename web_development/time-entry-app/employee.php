<?php

include('config.php');

//send student away if navigating here
Employee::checkPrivileges();

//set template
$template = new Template(TEMPLATE_ROOT . 'index.php');
$template->set('page_title', 'Employees');

//Retrieve any and all get variables
$action = get('action');
$id = get('id');

ob_start();

switch ($action) {
    case 'addNewEmployee':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = post('username');
            $employeeID = post('employeeID');
            $organizationID = $employee->organizationID;
            $newUser = 0;
            $messageType = 'danger';

            // Does user exist in local database
            $sql = get_sql('doesUserExist');
            $params = array(
                'username' => $username
            );
            $employees = $database->query($sql, $params);

            // if can't be found in active directory
            if (!$ADdata = getUserFromAD($username)) {
                setMessage('danger', "Username doesn't exist in active directory");
                header('location: employee.php');
                break;
            }

            // employee doesn't exist in local database, create user
            if (empty($employees)) {
                $sql = get_sql('addNewEmployee');
                $params = array(
                    'firstName' => $ADdata['firstName'],
                    'lastName' => $ADdata['lastName'],
                    'email' => $ADdata['mail'],
                    'username' => $ADdata['cn']
                );
                $database->executeQuery($sql, $params);
                $newUser = 1;
            }

            // if user already in organization
            $sql = get_sql('organizationIsExistingEmployee');
            $params = array(
                'employeeID' => $employeeID,
                'organizationID' => $organizationID
            );
            $isExisting = $database->query($sql, $params);
            if (!empty($isExisting)) {
                setMessage('danger', "User already a member of the organization");
                header('location: employee.php');
                break;
            }

            // Add user to organization
            $sql = get_sql('organizationAddExistingEmployee');
            $params = array(
                'employeeID' => $employeeID,
                'organizationID' => $employee->organizationID,
                'roleID' => 1,
                'isDefault' => $newUser
            );
            $database->executeQuery($sql, $params);

            // Get employee information for the e-mail
            $sql = get_sql('getEmployee');
            $params = array ('username' => $username);
            $employees = $database->query($sql, $params);
            $addedEmployee = $employees[0];

            $email = $ADdata['mail'];
            $subject = 'CAI Time Entry Invite';
            ob_start();
            include('views/email/addToOrganization.php');
            $email_content = ob_get_clean();
            $addresses = array(
                $addedEmployee['firstName'] . " " . $addedEmployee['lastName'] => $email
            );
            send_email($subject, $email_content, $addresses);
            setMessage('success', 'User successfully added to organization.');
            header('Location: employee.php');
        }
        break;
    case 'deactivateEmployee':
        //send back if no id passed
        if (!isset($_GET['EOID'])) {
            header('Location: employee.php');
        }
        //deactivate employee in database
        Employee::deactivateEmployee($_GET['EOID']);
        setMessage('success', 'Employee successfully deactivated');
        header('Location: employee.php');
        die();
        break;
    case 'activateEmployee':
        //send back if no id passed
        if (!isset($_GET['EOID'])) {
            header('Location: employee.php');
        }
        //activate employee in database
        Employee::activateEmployee($_GET['EOID']);
        setMessage('success', 'Employee successfully activated');
        header('Location: employee.php');
        die();
        break;
    case 'editEmployee':
        //check if values being submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //currently only updating roles for employees
            //likely will be expanded at later date
            
            $managers = $_POST['managers'];
            $sql = get_sql('updateEmployeeRole');
            $params = array (
                'roleID' => post('role'),
                'EOID' => post('EOID')
            );
            $database->executeQuery($sql, $params);

            $sql = get_sql('deleteEmployeeManagers');
            $params = array (
                'employeeEOID' => post('EOID')
            );
            $database->executeQuery($sql, $params);

            if (isset($_POST['managers']))
            {
                $sql = get_sql('insertEmployeeManagers');
                $database->prepare($sql);
                foreach ($_POST['managers'] as $manager)
                {
                    $params = array (
                        'employeeEOID' => post('EOID'),
                        'managerEOID' => $manager
                    );
                    $database->queryPrepared($params);
                }
            }
            setMessage('success', 'Employee updated successfully');
            header('Location: employee.php');
            die();
        }
        
        //check if employee id was passed
        $EOID = get('EOID');
        if (empty($EOID)) {
            setMessage('danger', 'Error retrieving employee information');
            header('Location: employee.php?');
            die();
        }

        //grab employee info from DB
        $sql = get_sql('getOrganizationEmployee');
        $params = array(
            'EOID' => $EOID
        );
        $employees = $database->query($sql, $params);
        $organizationEmployee = $employees[0];

        $sql = get_sql('getEmployee');
        $params = array (
            'username' => $organizationEmployee['username']
        );
        $employeeInfo = $database->query($sql, $params)[0];

        $sql = get_sql('getRoles');
        $roles = $database->query($sql);

        $sql = get_sql('getManagers');
        $params = array(
            'organizationID' => $employee->organizationID
        );
        $managers = $database->query($sql, $params);

        $sql = get_sql('getEmployeeManagers');
        $params = array(
            'employeeEOID' => $EOID
        );
        $employeeManagersResults = $database->query($sql, $params);
        $employeeManagers = array();
        foreach ($employeeManagersResults as $employeeManager)
        {
            $employeeManagers[] = $employeeManager['managerEOID'];
        }
        unset($employeeManager);

        include('views/manager/editOrganizationEmployee.php');
        break;
    case 'setMessage':
        setMessage('danger', 'You have an error!');
        break;
    default:
        //Get all employees for table
        $sql = get_sql('getAllEmployees');
        $params = array(
            'organizationID' => $employee->organizationID
        );
        $employees = $database->query($sql, $params);
        
        //insert all employees view
        include('views/manager/allEmployees.php');
}

$content = ob_get_clean();
$template->set('content', $content);
echo $template->fetch();
