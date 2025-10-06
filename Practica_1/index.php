
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 1 - Anderson Perez</title>
    <link rel="stylesheet" href="estils.css">
</head>
<body>
    <?php
        session_start();
        $mensaje = "";
        // Mostrar missatges d'error o èxit i netejar la sessió
        if (isset($_SESSION['error_name_empty'])) {
            $mensaje .= $_SESSION['error_name_empty'] . "<br>";
            unset($_SESSION['error_name_empty']);
        } 

        if (isset($_SESSION['error_email_empty'])) {
            $mensaje .= $_SESSION['error_email_empty'] . "<br>";
            unset($_SESSION['error_email_empty']);
        }

        if (isset($_SESSION['error_message_empty'])) {
            $mensaje .= $_SESSION['error_message_empty'] . "<br>";
            unset($_SESSION['error_message_empty']);
        }

        if (isset($_SESSION['error_email_validate'])) {
            $mensaje .= $_SESSION['error_email_validate'] . "<br>";
            unset($_SESSION['error_email_validate']);
        }
        
        if (isset($_SESSION['success_message'])) {
            $mensaje .= $_SESSION['success_message'] . "<br>";
            unset($_SESSION['success_message']);
        }
        if (isset($_SESSION['error_sending'])) {
            $mensaje .= $_SESSION['error_sending'] . "<br>";
            unset($_SESSION['error_sending']);
        }
        echo $mensaje;
    ?>
    
    <form action="controlador.php" method="POST">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_SESSION['name']) ?? ""; ?>">

        <label for="email">Adreça de correu:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']) ?? ""; ?>">

        <label for="message">Missatge:</label>
        <textarea id="message" name="message"><?php echo htmlspecialchars($_SESSION['message']) ?? ""; ?></textarea>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>


