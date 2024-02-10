<?php
    require_once('../core/init.php');
    include('simple_html_dom.php');
    if(isset($_GET['remarks']) && isset($_GET['emoji_id'])){
        $remarks = $_GET['remarks'];
        $emoji_id = $_GET['emoji_id'];
    }
    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );  
    $htmlContent = file_get_html("https://emojipedia.org/" .$remarks, false, stream_context_create($arrContextOptions));

    $dom = new DOMDocument();
    @$dom->loadHTML($htmlContent);
    $xpath = new DOMXPath($dom);
    // Example: Extract all the 'p' tags
    $nodes = $xpath->query('//p');
    

    $data = [];
    foreach ($nodes as $node) {
        $data[] = trim($node->nodeValue);
    }
    $scraped_remarks = mysqli_real_escape_string($conn, $data[0]. ' ' .$data[1]);

    echo $scraped_remarks;
    
    $sql = "UPDATE emoji SET remarks = '$scraped_remarks' WHERE emoji_id = $emoji_id";
    mysqli_query($conn, $sql);