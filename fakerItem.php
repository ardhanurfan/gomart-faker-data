<?php

// Connect to DB
$db = new PDO('mysql:host=localhost;dbname=go-mart', 'root', '');
$db->query("DELETE FROM item");
$db->query("ALTER TABLE item AUTO_INCREMENT = 1");

$json = file_get_contents("item.json");
$item = json_decode($json, true);

for ($i=0; $i<1000; $i++) {
    $name = $item[$i]['name'];
    $description = $item[$i]['description'];
    $price = $item[$i]['price'];
    $store_id = rand(1, 145);

    $db->query("INSERT INTO item
    (name, description, price, store_id)
    VALUES ('{$name}', '{$description}', '{$price}', '{$store_id}')
    ");
}

