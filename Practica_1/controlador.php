<?php
    session_start();

    // Recull i sanititza les dades del formulari
    $nom = htmlspecialchars($_POST["name"]);
    $correo = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $missatge = htmlspecialchars($_POST["message"]);

    // Desa les dades a la sessió per mantenir-les en cas d'error
    $_SESSION['email'] = $correo; 
    $_SESSION['name'] = $nom;
    $_SESSION['message'] = $missatge;

    // Verifica que la sol·licitud és POST, això assegura que 
    // accedeixes a l'script a través del formulari i no directament
    if (!($_SERVER["REQUEST_METHOD"] == "POST")) { 
        header("Location: index.php");
        exit();
    }

    // Validar camps buits del nom, correu i missatge
    if (empty($nom) || empty($correo) || empty($missatge)) {
        if (empty($nom)) {$_SESSION['error_name_empty'] = 'Error: El camp "Nom" és obligatori.';}
        if (empty($correo)) {$_SESSION['error_email_empty'] = 'Error: El camp "Adreça de correu" és obligatori.';}
        if (empty($missatge)) {$_SESSION['error_message_empty'] = 'Error: El camp "Missatge" és obligatori.';}
        
        header("Location: index.php");
        exit();
    }

    // Validar format del correu electrònic
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_email_validate'] = 'Error: Correu electrònic no vàlid.';
        header("Location: index.php");
        exit();
    }

    // Incloure l'arxiu que conté la funció per enviar el correu
    // ho poso des d'aquí perquè no és necessari carregar-lo si hi ha errors previs
    require_once 'phpmailer.php';
    
    // Enviar el correu i gestionar el resultat
    $resultado = sendMail($nom, $correo, $missatge);
    if ($resultado === "Mensaje Enviado") {
        $_SESSION['success_message'] = 'Missatge enviat correctament!';
        session_destroy();
        header("Location: index.php");
    } else {
        $_SESSION['error_sending'] = 'Error: No s\'ha pogut enviar el missatge.';
        header("Location: index.php");
    }
    exit();
?>
