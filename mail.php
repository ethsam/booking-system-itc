<?php

    $test = implode("----- Résultat brute -----<br />",$_POST)."<br>----- End Résultat brute -----";

    //ID or Number of Transaction
    $vadsOrderId = !empty($_POST['vads_order_id']) ? $_POST['vads_order_id'] : 'Erreur vads_order_id';
    $vadsOrderId = '<br /> Identifiant de la commande : '.$vadsOrderId;

    //status of payment
    $vadsTransStatus = verifVadsStatus(!empty($_POST['vads_trans_status']) ? $_POST['vads_trans_status'] : 'ERRORSTATUS');
    $vadsTransStatus = '<br /> Résultat du paiement transmis : '.$vadsTransStatus;

    //Operation type
    $vadsOperationType = verifvadsOperationType(!empty($_POST['vads_operation_type']) ? $_POST['vads_operation_type'] : 'ERRORTYPE');
    $vadsOperationType = '<br /> Type d\'opération : '.$vadsOperationType;

    /* Message content */
    $message =  $test.'<br />'.$vadsOperationType.'<br />'.$vadsOrderId.'<br />'.$vadsTransStatus;

    /*
     ----- Mail send -----
    */
     $sujet = 'Test paiement';
     $destinataire = 'samuel.etheve@regie.re';
     $headers = "From: \"testpaiement\"<testpaiement@itctropicar.re>\n";
     $headers .= "Reply-To: testpaiement@itctropicar.re\n";
     $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
     if(mail($destinataire,$sujet,$message,$headers))
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
            return "En attente de remise : La transaction est acceptée et sera remise en banque automatiquement à la date prévue.<br />";
            break;

        case "ABANDONED":
            return "Abandonné : Le paiement a été abandonné par l’acheteur.<br />";
            break;

        case "AUTHORISED_TO_VALIDATE":
            return "A valider : La transaction, créée en validation manuelle, est autorisée. <br />
                    Le marchand doit valider manuellement la transaction afin qu'elle soit remise en banque.<br />
                    La transaction peut être validée tant que la date de remise n’est pas dépassée.<br />
                    Si cette date est dépassée alors le paiement prend le statut EXPIRED.<br />
                    Le statut Expiré est définitif.<br />";
            break;

        case "CANCELLED":
            return "Annulée : La transaction est annulée par le marchand.<br />";
            break;

        case "CAPTURED":
            return "Remisée : La transaction est remise en banque.<br />";
            break;

        case "CAPTURE_FAILED":
            return "Erreur remise : La remise de la transaction a échoué.<br />
                    Contactez le Support.<br />";
            break;
        
        case "EXPIRED":
            return "Expirée : La date de remise est atteinte et le marchand n’a pas validé la transaction.<br />";
            break;
        
        case "NOT_CREATED":
            return "Transaction non créée : La transaction n'est pas créée et n'est pas visible dans le Back Office.<br />";
            break;

        case "REFUSED":
            return "Refusée : La transaction est refusée.<br />";
            break;
        
        case "UNDER_VERIFICATION":
            return "Vérification PayPal en cours : En attente de vérification par PayPal.<br /> 
                    PayPal retient la transaction pour suspicion de fraude.<br /> 
                    Le paiement est dans l’onglet Transactions en cours dans votre backoffice.<br />";
            break;

        case "WAITING_AUTHORISATION":
            return "En attente d’autorisation : Le délai de remise en banque est supérieur à la durée de validité de l'autorisation.<br />
                    Une autorisation d’un euro est réalisée et acceptée par la banque émettrice.<br />
                    La demande d’autorisation sera déclenchée automatiquement à J-1 avant la date de remise en banque.<br />
                    Le paiement pourra être accepté ou refusé.<br />
                    La remise en banque est automatique.<br />";
            break;
        
        case "WAITING_AUTHORISATION_TO_VALIDATE":
            return "A valider et autoriser : Le délai de remise en banque est supérieur à la durée de validité de l'autorisation.<br />
                    Une autorisation d’un euro a été acceptée.<br />
                    Le marchand doit valider manuellement la transaction afin que la demande d’autorisation et la remise aient lieu.<br />";
            break;
        
        case "ERRORSTATUS":
            return "Erreur verifVadsStatus() le paiement n'à pu aboutir erreur de status.";
            break;

        }
     }


     //Function operation type - String $data
     function verifVadsOperationType($data) {

        switch ($data) {

        case "DEBIT":
            return "Opération de débit.<br />";
            break;

        case "CREDIT":
            return "Opération de remboursement.<br />";
            break;

        case "ERRORTYPE":
            return "Erreur verifVadsOperationType() type non défini.<br />";
            break;

        }
     }



    /* 
     ----- End Logic function -----
    */

?>