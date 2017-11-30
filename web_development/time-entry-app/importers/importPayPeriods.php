<?php
include '../config.php';

if (($handle = fopen("payrolls.csv", "r")) !== FALSE)
{
    $sql = get_sql('insertPayPeriod');
    $database->prepare($sql);
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
    {
        $startDate = new DateTime($data[0]);
        $endDate = new DateTime($data[1]);
        $sapNumber = $data[2];
        
        $params = array
        (
            'startDate' => $startDate->format("Y-m-d"),
            'endDate' => $endDate->format("Y-m-d"),
            'sapNumber' => $sapNumber
        );
        $database->queryPrepared($params);
    }
    fclose($handle);
}
echo "done";
?>
