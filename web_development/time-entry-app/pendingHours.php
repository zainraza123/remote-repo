<?php
include( 'config.php' );

$template = new Template(TEMPLATE_ROOT . 'index.php');
$template->set('page_title', 'Pending Hours');

ob_start();

$action = get('action');

if (!empty($action)) {
    switch ($action) {
        case 'approve':
            $sql = get_sql('approveHours');
            $params = array(
                'projectID' => get('project'),
                'EOID' => $employee->EOID
            );
            $database->executeQuery($sql, $params);
            die();
            break;
        case 'getStudentView':
            $sql = get_sql('projectHoursByManagerByPerson');
            $params = array(
                'managerEOID' => $employee->EOID
            );
            $pendingHours = $database->query($sql, $params);
            $projectHoursByStudent = array();
        
            foreach ($pendingHours as $pending) {
                $projectHoursByStudent[$pending['employeeID']]['employeeName'] = $pending['employeeName'];
                $projectHoursByStudent[$pending['employeeID']]['projects'][] = array(
                    'project' => $pending['project'],
                    'projectName' => $pending['projectName'],
                    'projectHours' => $pending['projectHours'],
                    'startDay' => $pending['startDay'],
                    'endDay' => $pending['endDay']
                );
            }
            include('views/manager/pendingHours/pendingHoursByPerson.php');
            die();
            break;
        case 'getProjectView':
            $sql = get_sql('getPendingHoursByWeek');
            $params = array(
                'organizationID' => $employee->organizationID
            );
            $pendingHours = $database->query($sql, $params);
            
            $pendingHoursByProject = array();
            
            foreach ($pendingHours as $pending) {
                $pendingHoursByProject[$pending['projectID']]['hours'][] = $pending;
                $pendingHoursByProject[$pending['projectID']]['projectName'] = $pending['projectName'] . " (" . $pending['project'] . ")";
                $pendingHoursByProject[$pending['projectID']]['currentlyApproved'] = $pending['currentlyApproved'];
                $pendingHoursByProject[$pending['projectID']]['estimatedTotal'] = $pending['estimatedTotal'];
                $pendingHoursByProject[$pending['projectID']]['projectCap'] = $pending['projectCap'];
                $pendingHoursByProject[$pending['projectID']]['pastDue'] = $pending['pastDue'];
                $pendingHoursByProject[$pending['projectID']]['notes'] = $pending['notes'];
            }

            include('views/manager/pendingHours/pendingHoursByProject.php');
            die();
            break;
    }
}

include('views/manager/pendingHours/pendingHours.php');

$content = ob_get_clean();
$template->set('content', $content);
echo $template->fetch();
