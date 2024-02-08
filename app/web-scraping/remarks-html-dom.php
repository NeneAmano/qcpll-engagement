<?php
    include('simple_html_dom.php');
    if(isset($_GET['remarks'])){
        $remarks = $_GET['remarks'];
    }
    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );  
    $html = file_get_html("https://emojipedia.org/" .$remarks, false, stream_context_create($arrContextOptions));

    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPATH($dom);

    $dom = new DOMDocument();
    @$dom->loadHTML($htmlContent);
    $xpath = new DOMXPath($dom);
    // Example: Extract all the 'p' tags
    $nodes = $xpath->query('//p');

    $data = [];
    foreach ($nodes as $node) {
        $data[] = trim($node->nodeValue);
    }
    echo $data;
    // $json_data = json_encode($data, JSON_PRETTY_PRINT);
    // file_put_contents('emoji.json', $json_data);
    // echo $json_data;