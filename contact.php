<?php
   // Test fonction mail();
   $to    = "contact@anastasia-vasina-langues.com";
   // adresse MAIL OVH liée à l’hébergement.
   $from  = "contact@anastasia-vasina-langues.com";
   // *** Laisser tel quel
   $JOUR  = date("Y-m-d");
   $HEURE = date("H:i");
   $Subject = $_POST['need'];
   $Message = $_POST['message'];
   $mailClient = $_POST['email'];
   $name = $_POST['name'];
   $surname = $_POST['surname'];
   $okMessage = 'Le formulaire de contact a été soumis avec succès, je vous recontacterai bientôt !';
   $errorMessage = 'Il y a eu une erreur lors de l\'envoi du formulaire. Veuillez réessayer plus tard.';

   $mail_Data = "";
   $mail_Data .= "<html> \n";
   $mail_Data .= "<head> \n";
   $mail_Data .= "<title> Subject </title> \n";
   $mail_Data .= "</head> \n";
   $mail_Data .= "<body> \n";
   $mail_Data .= "Demande client : <b>$Subject </b> <br> \n";
   $mail_Data .= "<br> \n";
   $mail_Data .= "Mail client : $mailClient <br> \n";
   $mail_Data .= "<br> \n";
   $mail_Data .= "Nom, Prenom client : $name $surname <br> \n";
   $mail_Data .= "<br> \n";
   $mail_Data .= "Message client : $Message <br> \n";
   $mail_Data .= "Etc.<br> \n";
   $mail_Data .= "</body> \n";
   $mail_Data .= "</HTML> \n";
   $headers  = "MIME-Version: 1.0 \n";
   $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
   $headers .= "From: $from  \n";
   $headers .= "Disposition-Notification-To: $from  \n";
   // Message de Priorité haute
   // -------------------------
   $headers .= "X-Priority: 1  \n";
   $headers .= "X-MSMail-Priority: High \n";
   $CR_Mail = TRUE;
   $CR_Mail = @mail ($to, $Subject, $mail_Data, $headers);
   // if ($CR_Mail === FALSE)
   //    {
   //     echo " ### CR_Mail=$CR_Mail - Erreur envoi mail <br> \n";
   //    }
   // else
   //    {
   //    echo " *** CR_Mail=$CR_Mail - Mail envoyé<br> \n";
   //    }

  if ($CR_Mail === FALSE){
    $responseArray = array('type' => 'success', 'message' => $okMessage);
  }else{
    $responseArray = array('type' => 'danger', 'message' => $e->getMessage());
  }

   // if requested by AJAX request return JSON response
   if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
   $encoded = json_encode($responseArray);

   header('Content-Type: application/json');

   echo $encoded;
   }
   // else just display the message
   else {
   echo $responseArray['message'];
   }

?>
