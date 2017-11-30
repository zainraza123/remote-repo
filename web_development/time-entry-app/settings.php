<?php
include( 'config.php' );

$template = new Template(TEMPLATE_ROOT . 'index.php');

$template->set('page_title', 'Settings');

$setting = !empty(get('setting')) ? get('setting') : 'Profile';
$action = get('action');

ob_start();
include('views/student/settings.php');
$content = ob_get_clean();

$formSuccess = false;

ob_start();
switch ($setting) {
    case 'Schedule':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $formSuccess = true;

            $startTimes = $_POST['startTime'];
            $endTimes = $_POST['endTime'];

            // Combine two parrallel arrays into one nice one
            $workShifts = array();
            $dayNames = array_keys($startTimes);

            foreach ($dayNames as $day) {
                $shiftNumber = 1;

                foreach ($startTimes[$day] as $shift) {
                    $workShifts[$day][$shiftNumber]['startTime'] = decimalToTime($shift);
                    $shiftNumber++;
                }

                $shiftNumber = 1;

                foreach ($endTimes[$day] as $shift) {
                    $workShifts[$day][$shiftNumber]['endTime'] = decimalToTime($shift);
                    $shiftNumber++;
                }
            }
            
            $sql = get_sql('deleteScheduleHour');
            $params = array(
                'EOID' => $employee->EOID
            );
            $database->executeQuery($sql, $params);
            
            $sql = get_sql('insertScheduleHour');
            $database->prepare($sql);
            foreach ($workShifts as $day => $shifts) {
                foreach ($shifts as $shift) {
                    $params = array(
                        'EOID' => $employee->EOID,
                        'day' => $day,
                        'startTime' => $shift['startTime'],
                        'endTime' => $shift['endTime']
                    );
                    $database->queryPrepared($params);
                }
            }
        }

        $sql = get_sql('getEmployeeSchedule');
        $params = array(
            'EOID' => $employee->EOID
        );
        $schedule = $database->query($sql, $params);

        // Organize schedule array by day
        $scheduleByDay = array();
        foreach ($schedule as $scheduleRow) {
            $scheduleRow['startTime'] = date('H:i', strtotime($scheduleRow['startTime']));
            $scheduleRow['endTime'] = date('H:i', strtotime($scheduleRow['endTime']));
            $scheduleByDay[$scheduleRow['day']][] = $scheduleRow;
        }
    
        //creating arrays of numbers for the time option
        $hoursArray = array ('01', '02', '03', '04', '05', '06', '08', '09', '10', '11', '12');
        $minutesArray = array ('0' => '00', '.25' => '15', '.5' => '30', '.75' => '45');
        $daysArray = array ('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        $militaryTimeArray = array ('07'=>'07:00', '07.25'=>'07:15', '07.5'=>'07:30', '07.75'=>'07:45', '08'=>'08:00', '08.25'=>'08:15', '08.5'=>'08:30', '08.75'=>'08:45', '09'=>'09:00', '09.25'=>'09:15', '09.5'=>'09:30', '09.75'=>'09:45', '10'=>'10:00', '10.25'=>'10:15', '10.5'=>'10:30', '10.75'=>'10:45', '11'=>'11:00', '11.25'=>'11:15', '11.5'=>'11:30', '11.75'=>'11:45', '12'=>'12:00', '12.25'=>'12:15', '12.5'=>'12:30', '12.75'=>'12:45', '13'=>'13:00', '13.25'=>'13:15', '13.5'=>'13:30', '13.75'=>'13:45', '14'=>'14:00', '14.25'=>'14:15', '14.5'=>'14:30', '14.75'=>'14:45', '15'=>'15:00', '15.25'=>'15:15', '15.5'=>'15:30', '15.75'=>'15:45', '16'=>'16:00', '16.25'=>'16:15', '16.5'=>'16:30', '16.75'=>'16:45', '17'=>'17:00', '17.25'=>'17:15', '17.5'=>'17:30', '17.75'=>'17:45', '18'=>'18:00');
    
        include('views/student/schedule.php');
        break;
    case 'Profile':
        switch ($action) {
            case 'editEmployee':
                if (!isset($_GET['username'])) {
                    header('Location: settings.php');
                }
                
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $sql = get_sql('updateEmployee');
                    $params = array (
                        'firstName' => $_POST['firstName'],
                        'lastName' => $_POST['lastName'],
                        'email' => $_POST['email'],
                        'username'=> $_POST['username']
                    );
                    $database->executeQuery($sql, $params);
                    
                    $sql = get_sql('getEmployeeInfo');
                    $params = array ('username' => $employee->username);
                    $employees = $database->queryObject('Employee', $sql, $params);
                    $_SESSION['employee'] = $employees[0];
                    
                    header('Location: settings.php');
                }

                //insert edit employee view
                include('views/manager/editEmployee.php');
                break;
            default:
                $sql = get_sql('getEmployeeSkills');
                $params = array (
                    'employeeEOID' => $employee->EOID
                );
                $skills = $database->query($sql, $params);
                
                include('views/student/profile.php');
                break;
        }
        break;
    case 'logout':
        session_destroy();
        header('Location: login.php');
        die();
        break;
}

$content .= ob_get_clean();
$template->set('content', $content);

echo $template->fetch();
