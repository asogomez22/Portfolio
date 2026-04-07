<?php

function redirect_to(string $location): void
{
    header("Location: " . $location, true, 303);
    exit;
}

if (($_SERVER["REQUEST_METHOD"] ?? "GET") !== "POST") {
    redirect_to("/");
}

$to = "asogomez22@gmail.com";
$error_redirect = "/?status=error#contacto";
$success_redirect = "/?status=success#contacto";

$name = strip_tags(trim($_POST["name"] ?? ""));
$email = filter_var(trim($_POST["email"] ?? ""), FILTER_SANITIZE_EMAIL);
$subject = strip_tags(trim($_POST["subject"] ?? ""));
$message = trim($_POST["message"] ?? "");

if (
    $name === "" ||
    $subject === "" ||
    $message === "" ||
    !filter_var($email, FILTER_VALIDATE_EMAIL)
) {
    redirect_to($error_redirect);
}

$clean_name = str_replace(["\r", "\n"], " ", $name);
$clean_email = str_replace(["\r", "\n"], "", $email);
$clean_subject = str_replace(["\r", "\n"], " ", $subject);

$host = preg_replace('/:\d+$/', "", $_SERVER["HTTP_HOST"] ?? "asogom.es");
$mail_domain = filter_var($host, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)
    ? $host
    : "asogom.es";
$from_email = "no-reply@" . $mail_domain;
$from_name = "Portfolio Alejandro Sopena";

$email_content = "Nombre: " . $clean_name . "\r\n";
$email_content .= "Email: " . $clean_email . "\r\n";
$email_content .= "Asunto: " . $clean_subject . "\r\n\r\n";
$email_content .= "Mensaje:\r\n" . $message . "\r\n";

$encoded_subject = "=?UTF-8?B?" . base64_encode($clean_subject) . "?=";
$encoded_from_name = "=?UTF-8?B?" . base64_encode($from_name) . "?=";

$headers = [
    "MIME-Version: 1.0",
    "Content-Type: text/plain; charset=UTF-8",
    "From: " . $encoded_from_name . " <" . $from_email . ">",
    "Reply-To: " . $clean_name . " <" . $clean_email . ">",
    "X-Mailer: PHP/" . phpversion(),
];

$mail_sent = mail(
    $to,
    $encoded_subject,
    $email_content,
    implode("\r\n", $headers)
);

redirect_to($mail_sent ? $success_redirect : $error_redirect);
