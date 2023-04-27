<?php
if (isset($_POST['Email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "juanpablosm1117@gmail.com";
    $email_subject = "Mensaje | Megabytech";

    function problem($error)
    {
        echo "Lo sentimos mucho, pero se encontraron errores con el formulario que envió. ";
        echo "Estos errores aparecen a continuación.<br><br>";
        echo $error . "<br><br>";
        echo "Vuelva atrás y corrija estos errores.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Message']) ||
		!isset($_POST['Celular'])
		
    ) {
        problem('Lo sentimos, pero parece haber un problema con el formulario que envió.');
    }

    $name = $_POST['Name']; // required
    $email = $_POST['Email']; // required
    $message = $_POST['Message']; // required
	$celular = $_POST['Celular']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'La dirección de correo electrónico que ingresó no parece ser válida.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
       $error_message .= 'El nombre que ingresó no parece ser válido.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'El mensaje que ingresó no parece ser válido..<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
   }

    $email_message = "Detalles del formulario a continuación.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";
	$email_message .= "Celular: " . clean_string($celular) . "\n";

    // create email headers
    $headers = 'From: ' . $email ;
       
    mail($email_to, $email_subject, $email_message, $headers);
?>

    <!-- include your success message below -->

    Gracias por contactarnos. Nos pondremos en contacto con usted muy pronto.

<?php
}
?>