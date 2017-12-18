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
    /* END CONFIG */


        /*  -----------------
            START $_POST traitement
            ----------------- */
        // $vads_amount = $booking->priceTotal();
        // $vads_card_number = $booking->cardNumber;
        // $vads_cvv = $booking->cardCryptogram;
        // $vads_expiry_month = extractExpireMonth( $booking->cardExpiration );
        // $vads_expiry_year = extractExpireYear( $booking->cardExpiration );
        // $vads_payment_cards = vads_payment_cards( $booking->cardType );
        // $vads_trans_date = vads_trans_date();
        // $vads_cust_first_name = extractFirstName( $booking->getUserFullName() );
        // $vads_cust_last_name = extractLastName( $booking->getUserFullName() );
        // $vads_cust_phone = $booking->getUserPhone();
        // $vads_trans_id = $pdf->booking->number;
        /*  -----------------
            END $_POST traitement
            ----------------- */


    /* INFOS CB */
    $vads_amount = vadsAmount("300"); //convertion float to int float (cents euros)
    $vads_card_number = "5970100300000034"; // card numbers
    $vads_cvv = "123"; //Cryptogramme
    $vads_expiry_month = "06"; //month expiration
    $vads_expiry_year = "2018"; //year expiration
    $vads_payment_cards = vads_payment_cards("1"); //function return card type
    $vads_trans_date = vads_trans_date(); //function return date
    /* END INFOS CB */

    /* INFOS BOOKING */
    $vads_cust_first_name = "Samuel"; //customer firstname
    $vads_cust_last_name = "Etheve"; //customer lastname
    $vads_cust_phone = "0262331111"; //customer phonenumber
    $vads_trans_id = "000016"; //booking number
    $vads_order_id = $vads_trans_id; //booking number custom (i choice the same number)
    /* END BOOKING */

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
                "vads_version" => $vads_version,
                "vads_cust_first_name" => $vads_cust_first_name,
                "vads_cust_last_name" => $vads_cust_last_name,
                "vads_order_id" => $vads_order_id,
                "vads_cust_phone" => $vads_cust_phone
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
                "vads_cust_first_name" => "$vads_cust_first_name", //customer firstname
                "vads_cust_last_name" => "$vads_cust_last_name", //customer lastname
                "vads_cust_phone" => "$vads_cust_phone", //customer phone number
                "vads_order_id" => "$vads_order_id",
                "signature" => getSignature($dataBrute, $key) //Function return signature
            );


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://paiement.systempay.fr/vads-payment/");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);

    if ($server_output == "") {
        echo 'formulaire envoyé';
    } else {
        $message = 'Erreur causé par un duplicate ID sur vads_trans_id ou erreur serveur banque <br /> Client : '.$vads_cust_first_name.' '.$vads_cust_last_name.'<br />Téléphone : '.$vads_cust_phone;
        $sujet = 'Erreur formulaire paiement '.$vads_trans_id;
        $destinataire = 'samuel.etheve@regie.re';
        $headers = "From: \"testpaiement\"<testpaiement@itctropicar.re>\n";
        $headers .= "Reply-To: testpaiement@itctropicar.re\n";
        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
        if ( mail($destinataire,$sujet,$message,$headers) ) {
                echo 'Une erreur c\'est produite les infos sont envoyé à '.$destinataire;
            } else {
                echo "Une erreur impossible de continuer verifier votre serveur mail php.";
                print_r(error_get_last());
        }
    }

    // curl_close ($ch);
    // var_dump($server_output);


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