<?php
    $sender_mail = 'laetronaz@gmail.com';
    $sender_password = 'Laetronaz1234';

    $config = array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => $sender_mail,
        'smtp_pass' => $sender_password,
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'newline' => "\r\n",
        'smtp_timeout' => 7
    );