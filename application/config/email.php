<?php
    $sender_mail = 'mailsender@laetronaz.ca';
    $sender_password = 'OSD7]76rl~R%';

    $config = array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://hades.canspace.ca',
        'smtp_port' => 465,
        'smtp_user' => $sender_mail,
        'smtp_pass' => $sender_password,
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'newline' => "\r\n",
        'smtp_timeout' => 7
    );