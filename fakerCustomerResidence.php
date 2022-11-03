<?php

require_once 'vendor/autoload.php';
$faker = Faker\Factory::create('id_ID');


// Connect to DB
$db = new PDO('mysql:host=localhost;dbname=go-mart', 'root', '');
$db->query("DELETE FROM customer_residence");
$db->query("ALTER TABLE customer_residence AUTO_INCREMENT = 1");

$customer_id = [];
for ($i=1; $i<=300; $i++) {
    $customer_id[$i-1] = $i;
}
$shuffle = shuffle($customer_id);

$address_id = [];
for ($i=151; $i<=450; $i++) {
    $address_id[$i-151] = $i;
}

for ($i=0; $i<300; $i++) {
    $customer = (int)$customer_id[$i];
    $address = $address_id[$i];
    $db->query("INSERT INTO customer_residence
    (customer_id, address_id)
    VALUES ('{$customer}', '{$address}')
    ");
}

$address_id = [];
for ($i=451; $i<=500; $i++) {
    $address_id[$i-451] = $i;
}

for ($i=0; $i<50; $i++) {
    $customer = rand(1, 300);
    $address = $address_id[$i];
    $db->query("INSERT INTO customer_residence
    (customer_id, address_id)
    VALUES ('{$customer}', '{$address}')
    ");
}
