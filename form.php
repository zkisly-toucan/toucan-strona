<?php

$db = new SQLite3('database.sqlite');

try{
    $to      = 'biuro@toucan-systems.pl';
    $email = $_GET['mail'];
    $subject = $_GET['name'];
    $message = $_GET['message'];


    $time = time();
    $query = "insert into mails('email', 'name', 'message', 'date') values ('$email', '$subject', '$message', '$time');";
    $db->query($query);

    $headers = array(
        'From' => $email,
        'Reply-To' => $email,
        'X-Mailer' => 'PHP/' . phpversion()
    );

    $headers = implode("\r\n", $headers);

    $mail = mail($to, $subject, $message, $headers);var_dump($mail);
    if($mail === false){

        $time = time();
        $query = "insert into log('message', 'date') values ('mail not sent', '$time');";
        $rr = $db->query($query);
    }
} catch (Exception $e){
    $errorMessage = $e->getMessage();
    var_dump($errorMessage);
    $time = time();
    $query = "insert into log('message', 'date') values ('$errorMessage', '$date');";
    $db->query($query);
}
