<?php
include '../config.php';

//For executing good stuff
$connection = $database->get_instance();

$RAIDsql = get_sql('getRAID');
$RAIDstatement = $connection->prepare($RAIDsql);

$RAsql = get_sql('insertResearchAgreement');
$RAstatement = $connection->prepare($RAsql);

$Psql = get_sql('insertProject');
$Pstatement = $connection->prepare($Psql);


if (($handle = fopen("ApprovedRAs.csv", "r")) !== false) {
    //Get the header columns to be able to use named columns instead of accessing by index
    $head = fgetcsv($handle, 1000, ",");

    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        //Should use the column headers to make the array
        $newProject = array_combine($head, $data);

        //Sanitize data
        if ($newProject["AP Contact Name"] == "USE PRIMARY") {
            $newProject["AP Contact Name"] = $newProject["Primary Contact Name"];
        }
        if ($newProject["AP Payable Email"] == "USE PRIMARY") {
            $newProject["AP Payable Email"] = $newProject["Primary Contact Email"];
        }
        if ($newProject["Cap / Fixed Cost Budget"] == "N/A") {
            $newProject["Cap / Fixed Cost Budget"] = 0;
        }
        
        $params = array
        (
            'research_agreement' => $newProject["RA#"],
            'companyName' => $newProject["Company"],
            'organizationID' => 1
        );
        $RAIDstatement->execute($params);
        $RAIDs = $RAIDstatement->fetchAll(PDO::FETCH_ASSOC);

        //If the RA does not exist yet
        if (empty($RAIDs)) {
            $params = array
            (
                'research_agreement' => $newProject["RA#"],
                'companyName' => $newProject["Company"],
                'organizationID' => 1
            );
            $RAstatement->execute($params);
            $RAID = $connection->lastInsertId();
        }
        //If the RA does exist 
        else {
            $RAID = $RAIDs[0]["RAID"];
        }

        $startDate = new DateTime($newProject["Date Signed"]);
        $startDateTimestamp = $startDate->format("Y-m-d");

        $params = array
        (
            'project' => explode("-", $newProject["Project #"])[1],
            'projectName'=> $newProject["Project Name"],
            'startDate' => $startDateTimestamp,
            'endDate' => null,
            'oldestInvoice' => null,
            'totalInvoice' => null,
            'projectCap'=> $newProject["Cap / Fixed Cost Budget"],
            'primaryContactName'=> $newProject["Primary Contact Name"],
            'primaryContactEmail'=> $newProject["Primary Contact Email"],
            'APcontactName'=> $newProject["AP Contact Name"],
            'APcontactEmail'=> $newProject["AP Payable Email"],
            'rate'=> str_replace("$", "", str_replace("/hr", "", $newProject["Rate"])),
            'type'=> $newProject["Type"],
            'RAID'=> $RAID,
            'pastDue' => 0,
            'isActive' => 1,
            'notes' => $newProject["Notes/Terms"]
        );
        $Pstatement->execute($params);

    }
    fclose($handle);
}
echo "Import Finished";
