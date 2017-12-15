<?php

    $test = "----- Résultat brute -----<br />".implode($_POST)."<br>----- End Résultat brute -----<br />";

    //Payment date
    $vadsTransDate = verifVadsTransDate(!empty($_POST['vads_trans_date']) ? $_POST['vads_trans_date'] : 'ERRORDATE');
    $vadsTransDate = '<h3 style="margin-bottom: 3px;margin-top: 1px;">Transaction du '.$vadsTransDate.'</h3>';

    //ID or Number of Transaction
    $vadsOrderId = !empty($_POST['vads_order_id']) ? $_POST['vads_order_id'] : '<p style="margin-top:1px;">Erreur vads_order_id</p>';
    $vadsOrderId = '<h3 style="margin-bottom: 3px;margin-top: 1px;">Identifiant de la commande</h3>'.$vadsOrderId;

    //status of payment
    $vadsTransStatus = verifVadsStatus(!empty($_POST['vads_trans_status']) ? $_POST['vads_trans_status'] : 'ERRORSTATUS');
    $vadsTransStatus = '<h3 style="margin-bottom: 3px;margin-top: 1px;">Résultat du paiement transmis</h3>'.$vadsTransStatus;

    //Operation type
    $vadsOperationType = verifvadsOperationType(!empty($_POST['vads_operation_type']) ? $_POST['vads_operation_type'] : 'ERRORTYPE');
    $vadsOperationType = '<h3 style="margin-bottom: 3px;margin-top: 1px;">Type d\'opération</h3>'.$vadsOperationType;

    /* Message content */
    $message =  $test.'<br />'.$vadsTransDate.'<br />'.$vadsOperationType.'<br />'.$vadsOrderId.'<br />'.$vadsTransStatus;

    /*
     ----- Mail send -----
    */

     $sujet = 'Test paiement';
     $destinataire = 'samuel.etheve@regie.re';
     $headers = "From: \"testpaiement\"<testpaiement@itctropicar.re>\n";
     $headers .= "Reply-To: testpaiement@itctropicar.re\n";
     $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
     if ( mail($destinataire,$sujet,$message,$headers) )
     {
             echo "L'email a bien été envoyé.";
             //return $_POST;
     }
     else
     {
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
            return strftime('%d-%m-%Y',strtotime($dateData)); //convert date Us YYYYMMJJ to Fr JJMMYYYY
        }
     }


?>