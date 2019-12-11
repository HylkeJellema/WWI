<?php
include_once 'header.php';

$mollie = new \Mollie\Api\MollieApiClient();
$mollie->setApiKey("test_B9wWs47JaxUVjJVCj9ukyF8bFvvxED");

$payment = $mollie->payments->create([
    "amount" => [
        "currency" => "EUR",
        "value" => "10.00"
    ],
    "description" => "My first API payment",
    "redirectUrl" => "https://webshop.example.org/order/12345/",
    "webhookUrl"  => "https://webshop.example.org/mollie-webhook/",
]);