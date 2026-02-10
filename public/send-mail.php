<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "asogomez22@gmail.com";
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: /?status=error#contacto");
        exit;
    }

    $email_content = "Nombre: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Mensaje:\n$message\n";

    $headers = "From: $name <$email>";

    if (mail($to, $subject, $email_content, $headers)) {
        header("Location: /?status=success#contacto");
    } else {
        header("Location: /?status=error#contacto");
    }
} else {
    // Not a POST request
    header("Location: /");
}
?>
