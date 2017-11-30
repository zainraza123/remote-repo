<?php
include( 'config.php' );

$template = new Template(TEMPLATE_ROOT . 'index.php');
$template->set('page_title', 'Reports');

ob_start();

$sql = get_sql('getPayPeriods');
$payPeriods = $database->query($sql);

if (!isset($_GET['action'])) {
    include('views/invoicing/invoicingLanding.php');
} else {
    $report = $_GET['action'];
    
    $startDate = get('startDate');
    $startDateObject = new DateTime(get('startDate'));
    $endDate = get('endDate');
    $endDateObject = new DateTime(get('endDate'));
    
    switch ($report) {
        case 'daysPastDue':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $projects = $_POST['daysPastDue'];
                
                $sql = get_sql('updateDaysPastDue');
                $database->prepare($sql);

                foreach ($projects as $projectID => $project) {
                    $params = array(
                        'daysPastDue' => $project['daysPastDue'],
                        'projectID' => $projectID
                    );
                    $database->queryPrepared($params);
                }
            }

            $template->set('page_title', 'Days Past Due');
            $sql = get_sql('report.DaysPastDue');
            $params = array(
                'organizationID' => $employee->organizationID
            );
            $projects = $database->query($sql, $params);
            
            include('views/invoicing/daysPastDue.php');
            break;
        case 'invoicingReport':
            $sql = get_sql('report.InvoiceByWeek');
            $params = array(
                    'organizationID' => $employee->organizationID,
                    'startDate' => $startDate,
                    'endDate' => $endDate
                );
            $results = $database->query($sql, $params);

            $projects = [];
            foreach ($results as $result)
            {
                $projectID = $result['projectID'];
                $projectName = $result['projectName'];
                $payPeriod = $result['payPeriod'];
                $employee = $result['firstName'] . ' ' . $result['lastName'];

                $projects[$projectID]['projectName'] = $projectName;
                if (!isset($projects[$projectID]['projectTotalHours']))
                {
                    $projects[$projectID]['projectTotalHours'] = 0;
                }
                $projects[$projectID]['projectTotalHours'] += $result['totalHours'];
                $projects[$projectID]['payPeriods'][$payPeriod][$employee] = $result['totalHours'];
            }
            include('views/invoicing/invoiceReport.php');
            break;
        default:
            include('views/invoicing/invoicingLanding.php');
    }
}

$content = ob_get_clean();
$template->set('content', $content);
echo $template->fetch();
