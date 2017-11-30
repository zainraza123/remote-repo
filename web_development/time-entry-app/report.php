<?php
sleep(3);
include( 'config.php' );

$template = new Template(TEMPLATE_ROOT . 'index.php');
$template->set('page_title', 'Reports');

ob_start();

$sql = get_sql('getPayPeriods');
$payPeriods = $database->query($sql);

if (!isset($_GET['report'])) {
    include('views/manager/landing.php');
} else {
    $report = $_GET['report'];
    
    $startDate = get('startDate');
    $startDateObject = new DateTime(get('startDate'));
    $endDate = get('endDate');
    $endDateObject = new DateTime(get('endDate'));
    
    switch ($report) {
        case 'projectHours':
            $template->set('page_title', 'Project Hours');
            include('views/manager/projectHours.php');
            break;
            
        case 'projectHoursByPeriod':
            $template->set('page_title', 'Project Hours By Period');
            $sql = get_sql('report.ProjectHoursByPeriod');
            $params = array(
                'startDate' => $startDate,
                'endDate' => $endDate,
                'organizationID' => $employee->organizationID
            );
            $projects = $database->query($sql, $params);
            
            include('views/manager/projectHoursByPeriod.php');
            break;
            
        case 'projectHoursByPersonByPeriod':
            $template->set('page_title', 'Worked Hours By Period');
            $sql = get_sql('report.ProjectHoursByPersonByPeriod');
            $params = array(
                'startDate' => $startDate,
                'endDate' => $endDate,
                'organizationID' => $employee->organizationID
            );
            $workHoursByPeriod = $database->query($sql, $params);
            $projectHoursByStudent = array();
            
            foreach ($workHoursByPeriod as $row) {
                $projectHoursByStudent[$row['employeeID']]['employeeName'] = $row['employeeName'];
                $projectHoursByStudent[$row['employeeID']]['projects'][] = array(
                    'project' => $row['project'],
                    'projectName' => $row['projectName'],
                    'projectHours' => $row['projectHours']
                );
            }
            
            include('views/manager/reports/projectHoursByPersonByPeriod.php');
            break;

        case 'projectHoursByPersonByPeriodByManager':
            $template->set('page_title', 'Project Hours By Period By Person By Manager');
            $sql = get_sql('report.ProjectHoursByPersonByPeriod');
            $params = array(
                'startDate' => $startDate,
                'endDate' => $endDate,
                'organizationID' => $employee->organizationID
            );
            $projectHoursByPeriod = $database->query($sql, $params);
            $projectHoursByStudent = array();
            
            foreach ($projectHoursByPeriod as $row) {
                $projectHoursByStudent[$row['employeeID']]['employeeName'] = $row['employeeName'];
                $projectHoursByStudent[$row['employeeID']]['projects'][] = array(
                    'project' => $row['project'],
                    'projectName' => $row['projectName'],
                    'projectHours' => $row['projectHours']
                );
            }
            
            include('views/manager/reports/projectHoursByPersonByPeriodByManager.php');
            break;

        case 'projectStatus':
            $template->set('page_title', 'Project Statuses');
            $sql = get_sql('report.ProjectStatus');
            $params = array(
                'organizationID' => $employee->organizationID
            );
            $projects = $database->query($sql, $params);
            
            include('views/manager/reports/projectStatus.php');
            break;
        case 'missingTime':
            $template->set('page_title', 'Missing Time');
            $sql = get_sql('report.MissingHours');
            $params = array(
                'organizationID' => $employee->organizationID,
                'startDate' => $startDate,
                'endDate' => $endDate
            );
            $missingTimes = $database->query($sql, $params);
            
            include('views/manager/reports/missingHours.php');
            break;
        case 'workedHoursByPeriod':
            $template->set('page_title', 'Worked Hours By Period');
            $sql = get_sql('report.WorkedHoursByPeriod');
            $params = array(
                'organizationID' => $employee->organizationID,
                'startDate' => $startDate,
                'endDate' => $endDate
            );
            $rawWorkedTimes = $database->query($sql, $params);
            $workedTimes = array();

            foreach ($rawWorkedTimes as $rawWorkedTime) {
                $workedTimes[$rawWorkedTime['employeeID']]['employeeID'] = $rawWorkedTime['employeeID'];
                $workedTimes[$rawWorkedTime['employeeID']]['employeeName'] = $rawWorkedTime['firstName'] . " " . $rawWorkedTime['lastName'];
                $workedTimes[$rawWorkedTime['employeeID']]['shifts'][$rawWorkedTime['weekID']]['startDate'] = $rawWorkedTime['startDay'];
                $workedTimes[$rawWorkedTime['employeeID']]['shifts'][$rawWorkedTime['weekID']]['endDate'] = $rawWorkedTime['endDay'];
                $workedTimes[$rawWorkedTime['employeeID']]['shifts'][$rawWorkedTime['weekID']]['days'][$rawWorkedTime['day']][] = array(
                    'startTime' => $rawWorkedTime['startTime'],
                    'endTime' => $rawWorkedTime['endTime']
                );
            }

            /*echo "<pre>";
            print_r($workedTimes);
            echo "</pre>";*/
            include('views/manager/reports/workedHoursByPeriod.php');
            break;
        default:
            include('views/manager/landing.php');
    }
}

$content = ob_get_clean();
$template->set('content', $content);
echo $template->fetch();
