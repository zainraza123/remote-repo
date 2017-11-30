<?php

include('config.php');

//send student away if navigating here
//Employee::checkPrivileges();

//set template
$template = new Template(TEMPLATE_ROOT . 'index.php');
$template->set('page_title', 'Employees');

//Retrieve any and all get variables
$action = get('action');
$id = get('id');

ob_start();

switch ($action) {
    default:
        $template->set('page_title', 'Schedules');
        $sql = get_sql('getEmployeesSchedules');
        $params = array(
            'organizationID' => $employee->organizationID
        );
        $rawSchedules = $database->query($sql, $params);
        $schedules = array();

        foreach ($rawSchedules as $rawSchedule) {
            $schedules[$rawSchedule['employeeID']]['employeeID'] = $rawSchedule['employeeID'];
            $schedules[$rawSchedule['employeeID']]['employeeName'] = $rawSchedule['firstName'] . " " . $rawSchedule['lastName'];
            $schedules[$rawSchedule['employeeID']]['schedule'][$rawSchedule['day']][] = array(
                'startTime' => $rawSchedule['startTime'],
                'endTime' => $rawSchedule['endTime']
            );
        }

        include('views/student/schedules.php');
        break;
}

$content = ob_get_clean();
$template->set('content', $content);
echo $template->fetch();
