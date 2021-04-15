<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

include 'secret.php'; //Здесь я задаю две переменные: почту и пароль ($my_login, $my_password). Файл добавлен в gitignore.

// Формирование самого письма
$title = "Результаты теста";
$body = '<h2>Вы заполнили тест. И вот результат...</h2>'.$message;

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.yandex.ru'; // SMTP сервера вашей почты
    $mail->Username   = $my_login; // Логин на почте
    $mail->Password   = $my_password; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom($my_login, 'РОБОТ Матюха'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress($email);  

    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;

    // Проверяем отравленность сообщения
    if ($mail->send()) {$email_result = "success";} 
    else {$email_result = "error";}

} catch (Exception $e) {
    $email_result = "error";
}