<?php

if(isset($_POST['email'])) {



    // EDIT THE 2 LINES BELOW AS REQUIRED

    $email_to = "j.baileypolyga@gmail.com";

    $email_subject = "Nachricht von OBS Praktikum :";








    // validation expected data exists

    if(!isset($_POST['first_name']) ||

        !isset($_POST['last_name']) ||

        !isset($_POST['email']) ||

        !isset($_POST['telephone']) ||

        !isset($_POST['comments'])) {

        died('We are sorry, but there appears to be a problem with the form you submitted.');

    }



    $first_name = $_POST['first_name']; // required

    $last_name = $_POST['last_name']; // required

    $email_from = $_POST['email']; // required

    $telephone = $_POST['telephone']; // not required

    $comments = $_POST['comments']; // required


    $error_message = "";

    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email_from)) {

    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';

  }

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$first_name)) {

    $error_message .= 'The First Name you entered does not appear to be valid.<br />';

  }

  if(!preg_match($string_exp,$last_name)) {

    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';

  }

  if(strlen($comments) < 2) {

    $error_message .= 'The Comments you entered do not appear to be valid.<br />';

  }

  if(strlen($error_message) > 0) {

    died($error_message);

  }

    $email_message = "Nachricht von OBS Praktikum \n\n";



    function clean_string($string) {

      $bad = array("content-type","bcc:","to:","cc:","href");

      return str_replace($bad,"",$string);

    }



    $email_message .= "Vorname: ".clean_string($first_name)."\n";

    $email_message .= "Nachname: ".clean_string($last_name)."\n";

    $email_message .= "Email-Adresse: ".clean_string($email_from)."\n";

    $email_message .= "Telefonnummer : ".clean_string($telephone)."\n";

    $email_message .= "Nachricht: ".clean_string($comments)."\n";





// create email headers

$headers = 'From: '.$email_from."\r\n".

'Reply-To: '.$email_from."\r\n" .

'X-Mailer: PHP/' . phpversion();

@mail($email_to, $email_subject, $email_message, $headers);

?>



<!-- include your own success html here -->



Wir werden so schnell es möglich ist ihre Frage beantworten!


<?php

}

?>
