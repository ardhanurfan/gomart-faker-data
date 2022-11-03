<?php


// Connect to DB
$db = new PDO('mysql:host=localhost;dbname=go-mart', 'root', '');
$db->query("DELETE FROM payment_method");
$db->query("ALTER TABLE payment_method AUTO_INCREMENT = 1");

$json = file_get_contents("payment_method.json");
$payment_method = json_decode($json, true);

for ($i=0; $i<200; $i++) {
    $payment_id = $payment_method[$i]['payment_id'];
    $type = $payment_method[$i]['type'];

    $db->query("INSERT INTO payment_method
    (payment_id, type)
    VALUES ('{$payment_id}', '{$type}')
    ");
}

