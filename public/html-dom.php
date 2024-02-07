<?php
    include('simple_html_dom.php');

    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );  
    $html = file_get_html("https://kt.ijs.si/data/Emoji_sentiment_ranking/?emoji", false, stream_context_create($arrContextOptions));

    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPATH($dom);

    // Get column names from the first row
    $columnNames = [];
    $firstRow = $xpath->query('//table/thead/tr/th');
    foreach ($firstRow as $th) {
        $columnNames[] = trim($th->nodeValue);
    }

    // Map specific column names
    $columnMapping = array(
        'column13' => 'Unicode name',
        'column14' => 'Unicode block',
    );

    $nodes = $xpath->query('//table/tbody/tr');

    $data = array("emoji" => array());

    foreach ($nodes as $rowIndex => $row) {
        $rowData = array();
        foreach ($row->childNodes as $cellIndex => $cell) {
            $columnName = isset($columnNames[$cellIndex]) ? $columnNames[$cellIndex] : "column" . ($cellIndex + 1);
            $cellValue = trim($cell->nodeValue);

            // Check if the column has a non-empty value before adding to the array
            if ($cellValue !== "") {
                // Use the mapped column name if it exists
                $columnName = isset($columnMapping[$columnName]) ? $columnMapping[$columnName] : $columnName;
                $rowData[$columnName] = $cellValue;
            }
        }

        // Check if $rowData has non-empty values before adding it to the final array
        if (!empty($rowData)) {
            $data["emoji"]["emoji" . ($rowIndex + 1)] = $rowData;
        }
    }

    $json_data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('emoji.json', $json_data);
    echo $json_data;
?>