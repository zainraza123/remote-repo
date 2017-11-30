<?php
include '../config.php';

if (($handle = fopen("SalesByCustomer.csv", "r")) !== false) {
    //Get the header columns to be able to use named columns instead of accessing by index
    $head = fgetcsv($handle, 1000, ",");

    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        //Should use the column headers to make the array
        $newProjectHours = array_combine($head, $data);

        $sql = get_sql('import.getProjectByResearchAgreementAndProjectNumber');

        $project = explode('-', $newProjectHours["Project"]);
        $params = array(
            'research_agreement' => $project[0],
            'project' => $project[1]
        );

        $projectID = $database->query($sql, $params);

        if (!empty($projectID))
        {
            $projectHours = round($newProjectHours["Total Invoiced"] / $projectID[0]['rate'], 2);

            $sql = get_sql('import.FinancialData');
            $params = array(
                'projectID' => $projectID[0]['projectID'],
                'projectHours' => $projectHours
            );
            $database->executeQuery($sql, $params);
        }
    }
    fclose($handle);
}
echo "Import Finished";