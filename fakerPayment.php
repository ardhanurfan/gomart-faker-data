<?php

// Connect to DB
$db = new PDO('mysql:host=localhost;dbname=go-mart', 'root', '');
$db->query("DELETE FROM payment");
$db->query("ALTER TABLE payment AUTO_INCREMENT = 1");

$json = file_get_contents("payment.json");
$payment = json_decode($json, true);

for ($i=0; $i<200; $i++) {
    $account_number = $payment[$i]['account_number'];

    $db->query("INSERT INTO payment
    (account_number)
    VALUES ('{$account_number}')
    ");
}

