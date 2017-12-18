<?php

    // $test = "----- Résultat brute -----<br />".implode($_POST,'<br />')."<br>----- End Résultat brute -----<br />";
    
    /* FOR DEBUG MODE (display:none; on mail body) */
    $vads_cust_first_name = !empty($_POST['vads_cust_first_name']) ? $_POST['vads_cust_first_name'] : 'Empty';
    $vads_cust_last_name = !empty($_POST['vads_cust_last_name']) ? $_POST['vads_cust_last_name'] : 'Empty';
    $vads_cust_phone = !empty($_POST['vads_cust_phone']) ? $_POST['vads_cust_phone'] : 'Empty';
    $vads_amount = !empty($_POST['vads_amount']) ? $_POST['vads_amount'] : 'Empty';
    $vads_auth_number = !empty($_POST['vads_auth_number']) ? $_POST['vads_auth_number'] : 'Empty';
    $vads_auth_result = !empty($_POST['vads_auth_result']) ? $_POST['vads_auth_result'] : 'Empty';
    $vads_capture_delay = !empty($_POST['vads_capture_delay']) ? $_POST['vads_capture_delay'] : 'Empty';
    $vads_card_brand = !empty($_POST['vads_card_brand']) ? $_POST['vads_card_brand'] : 'Empty';
    $vads_card_number = !empty($_POST['vads_card_number']) ? $_POST['vads_card_number'] : 'Empty';
    $vads_payment_certificate = !empty($_POST['vads_payment_certificate']) ? $_POST['vads_payment_certificate'] : 'Empty';
    $vads_ctx_mode = !empty($_POST['vads_ctx_mode']) ? $_POST['vads_ctx_mode'] : 'Empty';
    $vads_currency = !empty($_POST['vads_currency']) ? $_POST['vads_currency'] : 'Empty';
    $vads_effective_amount = !empty($_POST['vads_effective_amount']) ? $_POST['vads_effective_amount'] : 'Empty';
    $vads_site_id = !empty($_POST['vads_site_id']) ? $_POST['vads_site_id'] : 'Empty';
    $vads_trans_date = !empty($_POST['vads_trans_date']) ? $_POST['vads_trans_date'] : 'Empty';
    $vads_trans_id = !empty($_POST['vads_trans_id']) ? $_POST['vads_trans_id'] : 'Empty';
    $vads_validation_mode = !empty($_POST['vads_validation_mode']) ? $_POST['vads_validation_mode'] : 'Empty';
    $vads_version = !empty($_POST['vads_version']) ? $_POST['vads_version'] : 'Empty';
    $vads_warranty_result = !empty($_POST['vads_warranty_result']) ? $_POST['vads_warranty_result'] : 'Empty';
    $vads_payment_src = !empty($_POST['vads_payment_src']) ? $_POST['vads_payment_src'] : 'Empty';
    $vads_sequence_number = !empty($_POST['vads_sequence_number']) ? $_POST['vads_sequence_number'] : 'Empty';
    $vads_contract_used = !empty($_POST['vads_contract_used']) ? $_POST['vads_contract_used'] : 'Empty';
    $vads_trans_status = !empty($_POST['vads_trans_status']) ? $_POST['vads_trans_status'] : 'Empty';
    $vads_expiry_month = !empty($_POST['vads_expiry_month']) ? $_POST['vads_expiry_month'] : 'Empty';
    $vads_expiry_year = !empty($_POST['vads_expiry_year']) ? $_POST['vads_expiry_year'] : 'Empty';
    $vads_bank_code = !empty($_POST['vads_bank_code']) ? $_POST['vads_bank_code'] : 'Empty';
    $vads_bank_product = !empty($_POST['vads_bank_product']) ? $_POST['vads_bank_product'] : 'Empty';
    $vads_pays_ip = !empty($_POST['vads_pays_ip']) ? $_POST['vads_pays_ip'] : 'Empty';
    $vads_presentation_date = !empty($_POST['vads_presentation_date']) ? $_POST['vads_presentation_date'] : 'Empty';
    $vads_effective_creation_date = !empty($_POST['vads_effective_creation_date']) ? $_POST['vads_effective_creation_date'] : 'Empty';
    $vads_operation_type = !empty($_POST['vads_operation_type']) ? $_POST['vads_operation_type'] : 'Empty';
    $vads_threeds_enrolled = !empty($_POST['vads_threeds_enrolled']) ? $_POST['vads_threeds_enrolled'] : 'Empty';
    $vads_threeds_cavv = !empty($_POST['vads_threeds_cavv']) ? $_POST['vads_threeds_cavv'] : 'Empty';
    $vads_threeds_eci = !empty($_POST['vads_threeds_eci']) ? $_POST['vads_threeds_eci'] : 'Empty';
    $vads_threeds_xid = !empty($_POST['vads_threeds_xid']) ? $_POST['vads_threeds_xid'] : 'Empty';
    $vads_threeds_cavvAlgorithm = !empty($_POST['vads_threeds_cavvAlgorithm']) ? $_POST['vads_threeds_cavvAlgorithm'] : 'Empty';
    $vads_threeds_status = !empty($_POST['vads_threeds_status']) ? $_POST['vads_threeds_status'] : 'Empty';
    $vads_threeds_sign_valid = !empty($_POST['vads_threeds_sign_valid']) ? $_POST['vads_threeds_sign_valid'] : 'Empty';
    $vads_threeds_error_code = !empty($_POST['vads_threeds_error_code']) ? $_POST['vads_threeds_error_code'] : 'Empty';
    $vads_threeds_exit_status = !empty($_POST['vads_threeds_exit_status']) ? $_POST['vads_threeds_exit_status'] : 'Empty';
    $vads_risk_control = !empty($_POST['vads_risk_control']) ? $_POST['vads_risk_control'] : 'Empty';
    $vads_result = !empty($_POST['vads_result']) ? $_POST['vads_result'] : 'Empty';
    $vads_extra_result = !empty($_POST['vads_extra_result']) ? $_POST['vads_extra_result'] : 'Empty';
    $vads_card_country = !empty($_POST['vads_card_country']) ? $_POST['vads_card_country'] : 'Empty';
    $vads_language = !empty($_POST['vads_language']) ? $_POST['vads_language'] : 'Empty';
    $vads_hash = !empty($_POST['vads_hash']) ? $_POST['vads_hash'] : 'Empty';
    $vads_url_check_src = !empty($_POST['vads_url_check_src']) ? $_POST['vads_url_check_src'] : 'Empty';
    $vads_action_mode = !empty($_POST['vads_action_mode']) ? $_POST['vads_action_mode'] : 'Empty';
    $vads_payment_config = !empty($_POST['vads_payment_config']) ? $_POST['vads_payment_config'] : 'Empty';
    $vads_page_action = !empty($_POST['vads_page_action']) ? $_POST['vads_page_action'] : 'Empty';
    $signature = !empty($_POST['signature']) ? $_POST['signature'] : 'Empty';

        $test = '<div style="display:none;">
            <h3>---INFOS DEBUG---</h3>
            <p>$vads_cust_first_name = '.$_POST['vads_cust_first_name'].'</p>
            <p>$vads_cust_last_name = '.$_POST['vads_cust_last_name'].'</p>
            <p>$vads_cust_phone = '.$_POST['vads_cust_phone'].'</p>
            <p>$vads_amount = '.$_POST['vads_amount'].'</p>
            <p>$vads_auth_mode = '.$_POST['vads_auth_mode'].'</p>
            <p>$vads_auth_number = '.$vads_auth_number.'</p>
            <p>$vads_auth_result = '.$vads_auth_result.'</p>
            <p>$vads_capture_delay = '.$vads_capture_delay.'</p>
            <p>$vads_card_brand = '.$vads_card_brand.'</p>
            <p>$vads_card_number = '.$vads_card_number.'</p>
            <p>$vads_payment_certificate = '.$vads_payment_certificate.'</p>
            <p>$vads_ctx_mode = '.$vads_ctx_mode.'</p>
            <p>$vads_currency = '.$vads_currency.'</p>
            <p>$vads_effective_amount = '.$vads_effective_amount.'</p>
            <p>$vads_site_id = '.$vads_site_id.'</p>
            <p>$vads_trans_date = '.$vads_trans_date.'</p>
            <p>$vads_trans_id = '.$vads_trans_id.'</p>
            <p>$vads_validation_mode = '.$vads_validation_mode.'</p>
            <p>$vads_version = '.$vads_version.'</p>
            <p>$vads_warranty_result = '.$vads_warranty_result.'</p>
            <p>$vads_payment_src = '.$vads_payment_src.'</p>
            <p>$vads_sequence_number = '.$vads_sequence_number.'</p>
            <p>$vads_contract_used = '.$vads_contract_used.'</p>
            <p>$vads_trans_status = '.$vads_trans_status.'</p>
            <p>$vads_expiry_month = '.$vads_expiry_month.'</p>
            <p>$vads_expiry_year = '.$vads_expiry_year.'</p>
            <p>$vads_bank_code = '.$vads_bank_code.'</p>
            <p>$vads_bank_product = '.$vads_bank_product.'</p>
            <p>$vads_pays_ip = '.$vads_pays_ip.'</p>
            <p>$vads_presentation_date = '.$vads_presentation_date.'</p>
            <p>$vads_effective_creation_date = '.$vads_effective_creation_date.'</p>
            <p>$vads_operation_type = '.$vads_operation_type.'</p>
            <p>$vads_threeds_enrolled = '.$vads_threeds_enrolled.'</p>
            <p>$vads_threeds_cavv = '.$vads_threeds_cavv.'</p>
            <p>$vads_threeds_eci = '.$vads_threeds_eci.'</p>
            <p>$vads_threeds_xid = '.$vads_threeds_xid.'</p>
            <p>$vads_threeds_cavvAlgorithm = '.$vads_threeds_cavvAlgorithm.'</p>
            <p>$vads_threeds_status = '.$vads_threeds_status.'</p>
            <p>$vads_threeds_sign_valid = '.$vads_threeds_sign_valid.'</p>
            <p>$vads_threeds_error_code = '.$vads_threeds_error_code.'</p>
            <p>$vads_threeds_exit_status = '.$vads_threeds_exit_status.'</p>
            <p>$vads_risk_control = '.$vads_risk_control.'</p>
            <p>$vads_result = '.$vads_result.'</p>
            <p>$vads_extra_result = '.$vads_extra_result.'</p>
            <p>$vads_card_country = '.$vads_card_country.'</p>
            <p>$vads_language = '.$vads_language.'</p>
            <p>$vads_hash = '.$vads_hash.'</p>
            <p>$vads_url_check_src = '.$vads_url_check_src.'</p>
            <p>$vads_action_mode = '.$vads_action_mode.'</p>
            <p>$vads_payment_config = '.$vads_payment_config.'</p>
            <p>$vads_page_action = '.$vads_page_action.'</p>
            <p>$signature = '.$signature.'</p>
            </div>';
    /* END DEBUG MODE (display:none; on mail body) */

    //Customer informations
        //Name and Lastname
    $vadsCustFirstName = !empty($_POST['vads_cust_first_name']) ? $_POST['vads_cust_first_name'] : 'ERRORFIRSTNAME';
    $vadsCustLastName = !empty($_POST['vads_cust_last_name']) ? $_POST['vads_cust_last_name'] : 'ERRORLASTNAME';
    $vadsCustName = '<h3 style="margin-bottom: 3px;margin-top: 1px;">Client : '.$vadsCustFirstName.' '.$vadsCustLastName;
        //Phone Number
    $vadsCustPhone = !empty($_POST['vads_cust_phone']) ? $_POST['vads_cust_phone'] : 'ERRORPHONE';
    $vadsCustPhone = '<h3 style="margin-bottom: 3px;margin-top: 1px;">Téléphone : '.$vadsCustPhone.'<br />';

    //Payment date
    $vadsTransDate = verifVadsTransDate(!empty($_POST['vads_trans_date']) ? $_POST['vads_trans_date'] : 'ERRORDATE');
    $vadsTransDate = '<h3 style="margin-bottom: 3px;margin-top: 1px;">Transaction du '.$vadsTransDate;

    //Total payment amount
    $vadsAmount = verifVadsAmount(!empty($_POST['vads_amount']) ? $_POST['vads_amount'] : 'ERRORAMOUNT');
    $vadsAmount = 'pour un total de '.$vadsAmount.' €';

    //Transaction numbers
    $vadsTransId = verifVadsTransId(!empty($_POST['vads_trans_id']) ? $_POST['vads_trans_id'] : 'ERRORTRANSID');
    $vadsTransId = 'réservation N° '.$vadsTransId;

    //Payment date + amount text
    $vadsDateAndAmountTxt = $vadsTransDate.' '.$vadsAmount.' '.$vadsTransId.'</h3>';

    //ID or Number of Transaction
    $vadsOrderId = !empty($_POST['vads_order_id']) ? $_POST['vads_order_id'] : '<p style="margin-top:1px;">Erreur vads_order_id</p>';
    $vadsOrderId = '<h3 style="margin-bottom: 3px;margin-top: 1px;">Identifiant de la commande</h3>'.$vadsOrderId;

    //status of payment
    $vadsTransStatus = verifVadsStatus(!empty($_POST['vads_trans_status']) ? $_POST['vads_trans_status'] : 'ERRORSTATUS');
    $vadsTransStatus = '<h3 style="margin-bottom: 3px;margin-top: 1px;">Résultat du paiement transmis</h3>'.$vadsTransStatus;

    //Operation type
    $vadsOperationType = verifVadsOperationType(!empty($_POST['vads_operation_type']) ? $_POST['vads_operation_type'] : 'ERRORTYPE');
    $vadsOperationType = '<h3 style="margin-bottom: 3px;margin-top: 1px;">Type d\'opération</h3>'.$vadsOperationType;

    //Request authorization result
    $vadsAuthResult = verifVadsAuthResult(!empty($_POST['vads_auth_result']) ? $_POST['vads_auth_result'] : 'ERRORAUTH');
    $vadsAuthResult = '<h3 style="margin-bottom: 3px;margin-top: 1px;">Résultat d\'authorisation</h3>'.$vadsAuthResult;


    /* Message content */
    $message =  $vadsDateAndAmountTxt.'<br />'.$vadsCustName.'<br />'.$vadsCustPhone.'<br />'.$vadsAuthResult.'<br />'.$vadsOperationType.'<br />'.$vadsOrderId.'<br />'.$vadsTransStatus.'<br />'.$test;

    /*
     ----- Mail send -----
    */

     $sujet = 'Test paiement';
     $destinataire = 'samuel.etheve@regie.re';
     $headers = "From: \"testpaiement\"<testpaiement@itctropicar.re>\n";
     $headers .= "Reply-To: testpaiement@itctropicar.re\n";
     $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
     if ( mail($destinataire,$sujet,$message,$headers) ) {
             echo "L'email a bien été envoyé.";
             //return $_POST;
        } else {
             echo "Une erreur c'est produite lors de l'envois de l'email.";
             print_r(error_get_last());
     }

    /*
     ----- End Mail send -----
    */


     /* 
     ----- Logic function -----
     */

     //Function for verification status of payment - String $data
     function verifVadsStatus($data) {
         switch ($data) {

        case "AUTHORISED":
            return '<p style="margin-top:1px;">En attente de remise : La transaction est acceptée et sera remise en banque automatiquement à la date prévue.</p>';
            break;

        case "ABANDONED":
            return '<p style="margin-top:1px;">Abandonné : Le paiement a été abandonné par l\’acheteur.</p>';
            break;

        case "AUTHORISED_TO_VALIDATE":
            return '<p style="margin-top:1px;">A valider : La transaction, créée en validation manuelle, est autorisée.</p>
                    <p style="margin-top:1px;">Le marchand doit valider manuellement la transaction afin qu\'elle soit remise en banque.</p>
                    <p style="margin-top:1px;">La transaction peut être validée tant que la date de remise n’est pas dépassée.</p>
                    <p style="margin-top:1px;">Si cette date est dépassée alors le paiement prend le statut EXPIRED.</p>
                    <p style="margin-top:1px;">Le statut Expiré est définitif.</p>';
            break;

        case "CANCELLED":
            return '<p style="margin-top:1px;">Annulée : La transaction est annulée par le marchand.</p>';
            break;

        case "CAPTURED":
            return '<p style="margin-top:1px;">Remisée : La transaction est remise en banque.</p>';
            break;

        case "CAPTURE_FAILED":
            return '<p style="margin-top:1px;">Erreur remise : La remise de la transaction a échoué.<br />
                    Contactez le Support.</p>';
            break;
        
        case "EXPIRED":
            return '<p style="margin-top:1px;">Expirée : La date de remise est atteinte et le marchand n\’a pas validé la transaction.</p>';
            break;
        
        case "NOT_CREATED":
            return '<p style="margin-top:1px;">Transaction non créée : La transaction n\'est pas créée et n\'est pas visible dans le Back Office.</p>';
            break;

        case "REFUSED":
            return '<p style="margin-top:1px;">Refusée : La transaction est refusée.</p>';
            break;
        
        case "UNDER_VERIFICATION":
            return '<p style="margin-top:1px;">Vérification PayPal en cours : En attente de vérification par PayPal.</p> 
                    <p style="margin-top:1px;">PayPal retient la transaction pour suspicion de fraude.</p> 
                    <p style="margin-top:1px;">Le paiement est dans l’onglet Transactions en cours dans votre backoffice.</p>';
            break;

        case "WAITING_AUTHORISATION":
            return '<p style="margin-top:1px;">En attente d’autorisation : Le délai de remise en banque est supérieur à la durée de validité de l\'autorisation.</p>
                    <p style="margin-top:1px;">Une autorisation d\’un euro est réalisée et acceptée par la banque émettrice.</p>
                    <p style="margin-top:1px;">La demande d\’autorisation sera déclenchée automatiquement à J-1 avant la date de remise en banque.</p>
                    <p style="margin-top:1px;">Le paiement pourra être accepté ou refusé.</p>
                    <p style="margin-top:1px;">La remise en banque est automatique.</p>';
            break;
        
        case "WAITING_AUTHORISATION_TO_VALIDATE":
            return '<p style="margin-top:1px;">A valider et autoriser : Le délai de remise en banque est supérieur à la durée de validité de l\'autorisation.</p>
                    <p style="margin-top:1px;">Une autorisation d\’un euro a été acceptée.</p>
                    <p style="margin-top:1px;">Le marchand doit valider manuellement la transaction afin que la demande d’autorisation et la remise aient lieu.</p>';
            break;
        
        case "ERRORSTATUS":
            return '<p style="margin-top:1px;">Erreur verifVadsStatus() le paiement n\'à pu aboutir erreur de status.</p>';
            break;

        }
     }

     //Function operation type - String $data
     function verifVadsOperationType($data) {

        switch ($data) {

        case "DEBIT":
            return '<p style="margin-top:1px;">Opération de débit.</p>';
            break;

        case "CREDIT":
            return '<p style="margin-top:1px;">Opération de remboursement.</p>';
            break;

        case "ERRORTYPE":
            return '<p style="margin-top:1px;">Erreur verifVadsOperationType() type non défini.</p>';
            break;

        }
     }

     //Function date - String $data
     function verifVadsTransDate($dateData) {
        if ( $dateData == "ERRORDATE") {
            return '<p style="margin-top:1px;">Erreur verifVadsTransDate()</p>';
        } else {
            return strftime('%d/%m/%Y',strtotime($dateData)); //convert date Us YYYYMMJJ to Fr JJ/MM/YYYY
        }
     }

     //Function request result auth - String $data
     function verifVadsAuthResult($data) {
        
        switch ($data) {

        case "03":
            return '<p style="margin-top:1px;">Accepteur invalide - Ce code est émis par la banque du marchand.</p>
                    <p style="margin-top:1px;">Il correspond à un problème de configuration sur les serveurs d’autorisation.</p>
                    <p style="margin-top:1px;">(ex: contrat clos, mauvais code MCC déclaré, etc..).</p>';
            break;
        
        case "00":
            return '<p style="margin-top:1px;color:green;"><b>Transaction approuvée ou traitée avec succès</b></p>';
            break;

        case "05":
            return '<p style="margin-top:1px;">Ne pas honorer - Ce code est émis par la banque émettrice de la carte.</p>
                    <p style="margin-top:1px;">Il peut être obtenu en général dans les cas suivants :</p>
                    <p style="margin-top:1px;">Date d’expiration invalide, CVV invalide, crédit dépassé, solde insuffisant (etc.)</p>
                    <p style="margin-top:1px;">Pour connaître la raison précise du refus, l’acheteur doit contacter sa banque.</p>';
            break;

        case "51":
            return '<p style="margin-top:1px;">Provision insuffisante ou crédit dépassé</p>
                    <p style="margin-top:1px;">Ce code est émis par la banque émettrice de la carte.</p>
                    <p style="margin-top:1px;">Il peut être obtenu si l’acheteur ne dispose pas d’un solde suffisant pour réaliser son achat.</p>
                    <p style="margin-top:1px;">Pour connaître la raison précise du refus, l’acheteur doit contacter sa banque.</p>';
            break;

        case "56":
            return '<p style="margin-top:1px;">Carte absente du fichier - Ce code est émis par la banque émettrice de la carte.</p>
                    <p style="margin-top:1px;">Le numéro de carte saisi est erroné ou le couple numéro de carte + date d\'expiration n\'existe pas..</p>';
            break;
        
        case "57":
            return '<p style="margin-top:1px;">Transaction non permise à ce porteur - Ce code est émis par la banque émettrice de la carte.</p>
                    <p style="margin-top:1px;">Il peut être obtenu en général dans les cas suivants :</p>
                    <p style="margin-top:1px;">L’acheteur tente d’effectuer un paiement sur internet avec une carte de retrait.</p>
                    <p style="margin-top:1px;">Le plafond d’autorisation de la carte est dépassé.</p>
                    <p style="margin-top:1px;">Pour connaître la raison précise du refus, l’acheteur doit contacter sa banque.</p>';
            break;
        
        case "59":
            return '<p style="margin-top:1px;">Suspicion de fraude - Ce code est émis par la banque émettrice de la carte.</p>
                    <p style="margin-top:1px;">Il peut être obtenu en général suite à une saisie répétée de CVV ou de date d’expiration erronée.</p>
                    <p style="margin-top:1px;">Pour connaître la raison précise du refus, l’acheteur doit contacter sa banque.</p>';
            break;
        
        case "60":
            return '<p style="margin-top:1px;">L’accepteur de carte doit contacter l’acquéreur</p>
                    <p style="margin-top:1px;">Ce code est émis par la banque du marchand. </p>
                    <p style="margin-top:1px;">Il correspond à un problème de configuration sur les serveurs d’autorisation.</p>
                    <p style="margin-top:1px;">Il est émis en général lorsque le contrat commerçant ne correspond pas au canal de vente utilisé.</p>
                    <p style="margin-top:1px;">(ex : une transaction e-commerce avec un contrat VAD-saisie manuelle).</p>
                    <p style="margin-top:1px;">Contactez le service client pour régulariser la situation.</p>';
            break;
             
        case "07":
            return '<p style="margin-top:1px;">Conserver la carte, conditions spéciales</p>';
            break;
             
        case "08":
            return '<p style="margin-top:1px;">Approuver après identification</p>';
            break;
             
        case "12":
            return '<p style="margin-top:1px;">Transaction invalide</p>';
            break;
             
        case "13":
            return '<p style="margin-top:1px;">Montant invalide</p>';
            break;
             
        case "14":
            return '<p style="margin-top:1px;">Numéro de porteur invalide</p>';
            break;
             
        case "15":
            return '<p style="margin-top:1px;">Emetteur de carte inconnu</p>';
            break;
             
        case "17":
            return '<p style="margin-top:1px;">Annulation acheteur</p>';
            break;
             
        case "19":
            return '<p style="margin-top:1px;">Répéter la transaction ultérieurement</p>';
            break;
             
        case "20":
            return '<p style="margin-top:1px;">Réponse erronée (erreur dans le domaine serveur)</p>';
            break;
             
        case "24":
            return '<p style="margin-top:1px;">Mise à jour de fichier non supportée</p>';
            break;
             
        case "25":
            return '<p style="margin-top:1px;">Impossible de localiser l’enregistrement dans le fichier</p>';
            break;
             
        case "26":
            return '<p style="margin-top:1px;">Enregistrement dupliqué, ancien enregistrement remplacé</p>';
            break;
             
        case "27":
            return '<p style="margin-top:1px;">Erreur en « edit » sur champ de liste à jour fichier</p>';
            break;
             
        case "28":
            return '<p style="margin-top:1px;">Accès interdit au fichier</p>';
            break;
             
        case "29":
            return '<p style="margin-top:1px;">Mise à jour impossible</p>';
            break;
             
        case "30":
            return '<p style="margin-top:1px;">Erreur de format</p>';
            break;
             
        case "31":
            return '<p style="margin-top:1px;">Identifiant de l’organisme acquéreur inconnu</p>';
            break;
             
        case "33":
            return '<p style="margin-top:1px;">Date de validité de la carte dépassée</p>';
            break;
             
        case "34":
            return '<p style="margin-top:1px;">Suspicion de fraude</p>';
            break;
             
        case "38":
            return '<p style="margin-top:1px;">Date de validité de la carte dépassée</p>';
            break;
             
        case "41":
            return '<p style="margin-top:1px;">Carte perdue</p>';
            break;
             
        case "43":
            return '<p style="margin-top:1px;">Carte volée</p>';
            break;
             
        case "54":
            return '<p style="margin-top:1px;">Date de validité de la carte dépassée</p>';
            break;
             
        case "55":
            return '<p style="margin-top:1px;">Code confidentiel erroné</p>';
            break;
             
        case "58":
            return '<p style="margin-top:1px;">Transaction non permise à ce porteur</p>';
            break;
             
        case "61":
            return '<p style="margin-top:1px;">Montant de retrait hors limite</p>';
            break;
             
        case "63":
            return '<p style="margin-top:1px;">Règles de sécurité non respectées</p>';
            break;
             
        case "68":
            return '<p style="margin-top:1px;">Réponse non parvenue ou reçue trop tard</p>';
            break;
             
        case "75":
            return '<p style="margin-top:1px;">Nombre d’essais code confidentiel dépassé</p>';
            break;
             
        case "76":
            return '<p style="margin-top:1px;">Porteur déjà en opposition, ancien enregistrement conservé</p>';
            break;
             
        case "90":
            return '<p style="margin-top:1px;">Arrêt momentané du système</p>';
            break;
             
        case "91":
            return '<p style="margin-top:1px;">Émetteur de cartes inaccessible</p>';
            break;
             
        case "94":
            return '<p style="margin-top:1px;">Transaction dupliquée</p>';
            break;
             
        case "96":
            return '<p style="margin-top:1px;">Mauvais fonctionnement du système</p>';
            break;
             
        case "97":
            return '<p style="margin-top:1px;">Échéance de la temporisation de surveillance globale</p>';
            break;
             
        case "98":
            return '<p style="margin-top:1px;">Serveur indisponible routage réseau demandé à nouveau</p>';
            break;
        
        case "99":
            return '<p style="margin-top:1px;">Incident domaine initiateur</p>';
            break;

        case "ERRORTYPE":
            return '<p style="margin-top:1px;">Erreur verifVadsOperationType() type non défini.</p>';
            break;

        default;
            return 'Erreur '.$data;
            break;

        }

     }

     //Function convert amount euros cents to euros
     function verifVadsAmount($data) {
         $amountTotal = $data / 100;
         return $amountTotal;
     }

     //Function transaction numbers
     function verifVadsTransId($data) {
        
        switch ($data) {

        case "ERRORTRANSID":
            return 'Erreur numero de réservation';
            break;

        default;
            return $data;
            break;

        }
     }


?>