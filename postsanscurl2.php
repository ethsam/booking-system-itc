<?php

    /* CONFIGURATION */
    $vads_action_mode = "SILENT"; //Silent mode = no return
    $vads_capture_delay = "0"; //delay bank capture
    $vads_ctx_mode = "TEST"; // TEST or PRODUCTION mode choice
    $vads_currency = "978"; // 978 = euros '€'
    $vads_page_action = "PAYMENT"; // action is payment
    $vads_payment_config = "SINGLE"; // single payment
    $vads_site_id = "17517945"; //the shop ID
    $vads_version = "V2"; //protocol version
    $key = "6327683775105250"; //Certificat key
    /* ------------- */

    /* INFOS CB */
    $vads_amount = vadsAmount("300"); //convertion float to int float (cents euros)
    $vads_card_number = "5970100300000034"; // card numbers
    $vads_cvv = "123"; //Cryptogramme
    $vads_expiry_month = "06"; //month expiration
    $vads_expiry_year = "2018"; //year expiration
    $vads_payment_cards = vads_payment_cards("1"); //function return card type
    $vads_trans_date = vads_trans_date(); //function return date
    $vads_trans_id = "000016"; //function return number of transaction
    /* -------- */


$dataBrute = array(  "vads_action_mode" => $vads_action_mode,
                "vads_amount" => $vads_amount,
                "vads_capture_delay" => $vads_capture_delay,
                "vads_card_number" => $vads_card_number,
                "vads_ctx_mode" => $vads_ctx_mode,
                "vads_currency" => $vads_currency,
                "vads_cvv" => $vads_cvv,
                "vads_expiry_month" => $vads_expiry_month,
                "vads_expiry_year" => $vads_expiry_year,
                "vads_page_action" => $vads_page_action,
                "vads_payment_cards" => $vads_payment_cards,
                "vads_payment_config" => $vads_payment_config,
                "vads_site_id" => $vads_site_id,
                "vads_trans_date" => $vads_trans_date,
                "vads_trans_id" => $vads_trans_id,
                "vads_version" => $vads_version
            );


$data = array(  "vads_action_mode" => "$vads_action_mode", //SILENT mode
                "vads_amount" => "$vads_amount", //Total value in euro cents
                "vads_capture_delay" => "$vads_capture_delay", //on default 0
                "vads_card_number" => "$vads_card_number", //Card number
                "vads_ctx_mode" => "$vads_ctx_mode", // TEST or PROD for test or production mode
                "vads_currency" => "$vads_currency", // currency code 978 = Euros
                "vads_cvv" => "$vads_cvv", //security code on back of the card
                "vads_expiry_month" => "$vads_expiry_month", //month expiration
                "vads_expiry_year" => "$vads_expiry_year", //year expiration
                "vads_page_action" => "$vads_page_action", //Action is PAYMENT
                "vads_payment_cards" => "$vads_payment_cards", //Card Type
                "vads_payment_config" => "$vads_payment_config", //Single for single paiement
                "vads_site_id" => "$vads_site_id", //Vendor ID
                "vads_trans_date" => "$vads_trans_date", //Transaction date
                "vads_trans_id" => "$vads_trans_id", //booking recept number
                "vads_version" => "$vads_version", //protocol version
                "return_mode" => "POST",
                "signature" => getSignature($dataBrute, $key) //Function return signature
            );

$dataPost = http_build_query($data);
$content = file_get_contents(
    'https://paiement.systempay.fr/vads-payment/',
    FALSE,
    stream_context_create(
        array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-type: application/x-www-form-urlencoded\r\nContent-Length: " . strlen($dataPost) . "\r\n",
                'content' => $dataPost,
            )
        )
    )
);
var_dump($content);

/* -- Logic function -- */

//Function convert float to int euros cents
function vadsAmount($data) {  
    $total = $data * 100;
    return $total;
}

    //Function for return card type
    function vads_payment_cards($data) {
        
        switch ($data) {
        case 0:
            return("VISA");
            break;
        case 1:
            return("MASTERCARD");
            break;
        case 2:
            return("CB");
            break;
        }

    }

//Function return formatted 'YYYYMMDDHHMMSS' date
function vads_trans_date() {
    $date = date('YmdHis');
    return $date; 
}

    // Function signature calculate
    function getSignature($params, $key){
        $contenu_signature = "" ;
            // Sort fields alphabetically
        ksort($params);
            foreach ($params as $nom =>$valeur) {
                // Field vads_ 
                if (substr($nom,0,5)=='vads_') {
                // Concatenation with the separator "+"
                $contenu_signature .= $valeur."+";
            }
        }
        // + Certificat 
        $contenu_signature .= $key;
        //SHA-1 encode
        $signature = sha1($contenu_signature);
        return $signature ;
    }

/* -- /Logic function -- */

?>