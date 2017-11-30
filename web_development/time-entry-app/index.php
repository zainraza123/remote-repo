<?php
include( 'config.php' );

$template = new Template(TEMPLATE_ROOT . 'index.php');
$template->set('page_title', 'Time Entry');

//creating arrays of numbers for the time option
$hoursArray = array ('01', '02', '03', '04', '05', '06', '08', '09', '10', '11', '12');
$minutesArray = array ('0' => '00', '.25' => '15', '.5' => '30', '.75' => '45');
$daysArray = array ('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
$militaryTimeArray = array ('07'=>'07:00', '07.25'=>'07:15', '07.5'=>'07:30', '07.75'=>'07:45', '08'=>'08:00', '08.25'=>'08:15', '08.5'=>'08:30', '08.75'=>'08:45', '09'=>'09:00', '09.25'=>'09:15', '09.5'=>'09:30', '09.75'=>'09:45', '10'=>'10:00', '10.25'=>'10:15', '10.5'=>'10:30', '10.75'=>'10:45', '11'=>'11:00', '11.25'=>'11:15', '11.5'=>'11:30', '11.75'=>'11:45', '12'=>'12:00', '12.25'=>'12:15', '12.5'=>'12:30', '12.75'=>'12:45', '13'=>'13:00', '13.25'=>'13:15', '13.5'=>'13:30', '13.75'=>'13:45', '14'=>'14:00', '14.25'=>'14:15', '14.5'=>'14:30', '14.75'=>'14:45', '15'=>'15:00', '15.25'=>'15:15', '15.5'=>'15:30', '15.75'=>'15:45', '16'=>'16:00', '16.25'=>'16:15', '16.5'=>'16:30', '16.75'=>'16:45', '17'=>'17:00', '17.25'=>'17:15', '17.5'=>'17:30', '17.75'=>'17:45', '18'=>'18:00', '18.25'=>'18:15', '18.5'=>'18:30', '18.75'=>'18:45', '19'=>'19:00', '19.25'=>'19:15', '19.5'=>'19:30', '19.75'=>'19:45', '20'=>'20:00', '20.25'=>'20:15', '20.5'=>'20:30', '20.75'=>'20:45', '21'=>'21:00', '21.25'=>'21:15', '21.5'=>'21:30', '21.75'=>'21:45', '22'=>'22:00');

// Get current date
$currentDate = new DateTime();
$currentDateTimestamp = $currentDate->format('Y-m-d');

// Creating date objects
$date_passed = get('date_passed');

if (empty( $date_passed )) {
    $sundayDate = new DateTime();
} elseif ($date_passed > $currentDateTimestamp) {
    header('Location: index.php');
} else {
    $sundayDate = new DateTime($date_passed);
}

if ($sundayDate->format('l') == "Sunday") {
    // Already a Sunday
} else {
    $sundayDate->modify('last sunday');
}

$sundayTimestamp = $sundayDate->format('Y-m-d');

$saturdayDate = clone $sundayDate;
$saturdayDate->modify('next saturday');
$saturdayTimestamp = $saturdayDate->format('Y-m-d');

// figuring
$maxDate = clone $currentDate;
$maxDate->modify('saturday this week');
$inCurrentWeek = false;
if ($maxDate <= $saturdayDate) {
    $inCurrentWeek = true;
}

$scheduleDate = clone $sundayDate;

$previousWeekDate = clone $sundayDate;
$previousWeekDate->modify('last sunday');
$previousWeekTimestamp = $previousWeekDate->format('Y-m-d');

$nextWeekDate = clone $sundayDate;
$nextWeekDate->modify('next sunday');
$nextWeekTimestamp = $nextWeekDate->format('Y-m-d');

// Ensure week exists in the database
$sql = get_sql('ensureWeekExists');
$params = array(
    'startDay' => $sundayTimestamp,
    'endDay' => $saturdayTimestamp
);
$database->executeQuery($sql, $params);

// Get week ID
$sql = get_sql('getWeek');
$params = array(
    'startDay' => $sundayTimestamp,
    'endDay' => $saturdayTimestamp
);
$weekID = $database->query($sql, $params);
$weekID = $weekID[0]['weekID'];

// Handle form submission if it occurred.
$formSuccess = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $startTimes = isset($_POST['startTime']) ? $_POST['startTime'] : array();
    $endTimes = isset($_POST['endTime']) ? $_POST['endTime'] : array();
    $projects = isset($_POST['project']) ? $_POST['project'] : array();
    $projectHours = isset($_POST['projectHours']) ? $_POST['projectHours'] : array();
    
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
    
    // Combine two parrallel arrays into one nice one
    $projectHoursByProject = array();
    for ($i = 0; $i < count($projects); $i++) {
        $projectHoursByProject[] = array(
            'projectID' => $projects[$i],
            'hours' => $projectHours[$i]
        );
    }
    
    /*if ($formType == 'add') {
        $sql = get_sql('insertWorkedHour');
        $database->prepare($sql);
        foreach ($workShifts as $day => $dayShifts) {
            $shiftsDate = clone $sundayDate;
            $shiftsDate->modify("next $day");
            $shiftsTimestamp = $shiftsDate->format('Y-m-d');
            
            foreach ($dayShifts as $shift) {
                $params = array(
                    'EOID' => $employee->EOID,
                    'workedDate' => $shiftsTimestamp,
                    'startTime' => $shift['startTime'],
                    'endTime' => $shift['endTime'],
                    'weekID' => $weekID
                );
                $database->queryPrepared($params);
            }
        }
        
        $sql = get_sql('insertProjectHour');
        $database->prepare($sql);
        foreach ($projectHoursByProject as $project) {
            $params = array(
                'EOID' => $employee->EOID,
                'projectID' => $project['projectID'],
                'projectHours' => $project['hours'],
                'weekID' => $weekID
            );
            $database->queryPrepared($params);
        }
    } elseif ($formType == 'edit') {*/
        $sql = get_sql('deleteWorkedHour');
        $params = array(
            'EOID' => $employee->EOID,
            'weekID' => $weekID
        );
        $database->executeQuery($sql, $params);
        
        $sql = get_sql('insertWorkedHour');
        $database->prepare($sql);

        foreach ($workShifts as $day => $dayShifts) {
            $shiftsDate = clone $sundayDate;
            $shiftsDate->modify("next $day");
            $shiftsTimestamp = $shiftsDate->format('Y-m-d');
            
            foreach ($dayShifts as $shift) {
                $params = array(
                    'EOID' => $employee->EOID,
                    'workedDate' => $shiftsTimestamp,
                    'startTime' => $shift['startTime'],
                    'endTime' => $shift['endTime'],
                    'weekID' => $weekID
                );
                $database->queryPrepared($params);
            }
        }
        
        $sql = get_sql('deleteProjectHour');
        $params = array(
            'EOID' => $employee->EOID,
            'weekID' => $weekID,
        );
        $database->executeQuery($sql, $params);
        
        $sql = get_sql('insertProjectHour');
        $database->prepare($sql);
        foreach ($projectHoursByProject as $project) {
            $params = array(
                'EOID' => $employee->EOID,
                'projectID' => $project['projectID'],
                'projectHours' => $project['hours'],
                'weekID' => $weekID
            );
            $database->queryPrepared($params);
        }
    /*}*/
    
    $formSuccess = true;
}

//getting current list of available projects and their names and ids
$sql = get_sql('getAllProjects');
$params = array(
    'organizationID' => $employee->organizationID
);
$projects = $database->query($sql, $params);

$sql = get_sql('getRecentProjects');
$params = array(
    'EOID' => $employee->EOID
);
$recentProjects = $database->query($sql, $params);

// Determine if hours previously submitted
$sql = get_sql('previouslySubmittedWeekSchedule');
$params = array(
    'weekID' => $weekID,
    'EOID' => $employee->EOID
);
$schedule = $database->query($sql, $params);
$isDefaultSchedule = false;

// Determine if project hours previously submitted
$sql = get_sql('previouslySubmittedProjectHours');
$params = array(
    'weekID' => $weekID,
    'EOID' => $employee->EOID
);
$previousProjectHours = $database->query($sql, $params);

// if previously worked shifts is empty get default schedule
if (empty($schedule)) {
    $sql = get_sql('getEmployeeSchedule');
    $params = array(
        'EOID' => $employee->EOID
    );
    $schedule = $database->query($sql, $params);
    $isDefaultSchedule = true;
}

// Organize schedule array by day
$scheduleByDay = array();
foreach ($schedule as $scheduleRow) {
    $scheduleRow['startTime'] = date('H:i', strtotime($scheduleRow['startTime']));
    $scheduleRow['endTime'] = date('H:i', strtotime($scheduleRow['endTime']));
    $scheduleByDay[$scheduleRow['day']][] = $scheduleRow;
}

// Get list of holidays
$sql = get_sql('getHolidays');
$holidays = $database->query($sql);

$holidays_dates = array();
foreach($holidays as $holiday) {
    $holidays_dates[] = $holiday['holidayDate'];
}

ob_start();
include('views/student/weeklyPeriodForm.php');
$content = ob_get_clean();
$template->set('content', $content);
echo $template->fetch();