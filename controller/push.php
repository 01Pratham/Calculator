<?php
$URL = "https://swayatta.esds.co.in:31199/mobile_crm/opportunity/create_quotation.php";
// $URL = "http://115.124.127.130/~crmesdsdev/mobile_crm/opportunity/create_quotation.php";

if (isset($_POST['action']) && $_POST['action'] == 'push') {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => base64_decode($_POST['data']),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: text/plain'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $arrResp = json_decode($response,true);
    

    // $arr = json_decode($str, true);

    // if(!empty($arrResp) || $arrResp["result"]["status"]){
    //     echo ($arrResp["result"]["message"]);
    // }else{
    //     echo ("Error");
    // }

            
    print_r($response);

}
else{
    echo "Error";
}
?>

