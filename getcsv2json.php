<?php

function csvToJson($csvUrl) {
    $csvData = [];

    if (($handle = fopen($csvUrl, 'r')) !== false) {
        while (($row = fgetcsv($handle)) !== false) {
            $csvData[] = $row;
        }
        fclose($handle);
    }

    // Assuming the first row of the CSV contains the column headers
    $headers = array_shift($csvData);

    $jsonArray = [];

    foreach ($csvData as $row) {
        $jsonArrayItem = [];

        foreach ($row as $i => $value) {
            $jsonArrayItem[$headers[$i]] = $value;
        }

        $jsonArray[] = $jsonArrayItem;
    }

    return json_encode($jsonArray);
}

$csvUrl = 'https://razinthirafi.alwaysdata.net/UTS-Alpro2/getcsv2json.php';
$jsonData = csvToJson($csvUrl);

// Set the content type to JSON
header('Content-Type: application/json');

// Output the JSON data
echo $jsonData;
?>







