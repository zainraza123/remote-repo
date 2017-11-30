<?php

include('config.php');

$action = get('action');

switch ($action) {
    case 'lagList':
        $currentDate = new DateTime();
        
        // Beginning of pay period
        $startDate = clone $currentDate;
        $startDate->modify('2 sunday ago');
        $startDateTimestamp = $startDate->format('Y-m-d');

        // End of pay period
        $endDate = clone $currentDate;
        $endDate->modify('next saturday');
        $endDateTimestamp = $endDate->format('Y-m-d');

        $sql = get_sql('getOrganizations');
        $organizations = $database->query($sql);

        foreach ($organizations as $organization) {
            $sql = get_sql('report.MissingHours');
            $params = array(
                'organizationID' => $organization['organizationID'],
                'startDate' => $startDateTimestamp,
                'endDate' => $endDateTimestamp
            );
            $lateEmployees = $database->query($sql, $params);

            // Generate manager lag list
            $subject = "Time Entry: Missing Time (" . $startDate->format('m/d/Y') . ' - ' . $endDate->format('m/d/Y') .")";
            
            ob_start();
            include('views/email/managerLagList.php');
            $content = ob_get_clean();

            $sql = get_sql('getManagers');
            $params = array(
                'organizationID' => $organization['organizationID'],
            );
            $managers = $database->query($sql, $params);
            $managerAddresses = array();

            foreach ($managers as $manager) {
                $managerAddresses[] = $manager['email'];
            }
            
            send_email($subject, $content, $managerAddresses);
            
            $lateEmployees = array(
                array(
                    'email' => 'hockenburj1@nku.edu'
                )
            );
            foreach ($lateEmployees as $lateEmployee) {
                $subject = "Time Entry: Missing Time (" . $startDate->format('m/d/Y') . ' - ' . $endDate->format('m/d/Y') .")";
                ob_start();
                include('views/email/individualLateNotification.php');
                $content = ob_get_clean();
                $addresses = array(
                    $lateEmployee['email']
                );
       
                //send_email($subject, $content, $addresses);
            }
        }
}
