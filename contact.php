<?php

//Charger l'autoloader pour que les dépendances soient accessibles
require_once 'vendor/autoload.php';

use Mailjet\Resources;

$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];

$env = parse_ini_file(__DIR__ . "/env");

$mj = new \Mailjet\Client($env['mailjet_user'], $env['mailjet_password'], true, ['version' => 'v3.1']);

$body = [
    'Messages' => [
        [
            'From' => [
                'Email' => "contact@remimichel.fr",
                'Name' => "Rémi Michel"
            ],
            'To' => [
                [
                    'Email' => "remi@rwigo.com",
                    'Name' => "Rémi Michel"
                ]
            ],
            'Subject' => "My first Mailjet Email!",
            'TextPart' => "Greetings from Mailjet!",
            'HTMLPart' => "<h3>Dear " . $firstName . " passenger 1, welcome to <a href=\"https://www.mailjet.com/\">Mailjet</a>!</h3>
            <br />May the delivery force be with you!"
        ]
    ]
];

// All resources are located in the Resources class

$response = $mj->post(Resources::$Email, ['body' => $body]);

// Read the response

$response->success() && var_dump($response->getData());


