<?php

require_once 'vendor/autoload.php';
$faker = Faker\Factory::create('id_ID');


// Connect to DB
$db = new PDO('mysql:host=localhost;dbname=go-mart', 'root', '');
$db->query("DELETE FROM store");
$db->query("ALTER TABLE store AUTO_INCREMENT = 1");

// Data Store Name
$json = file_get_contents("store_name.json");
$storeName = json_decode($json, true);

$address_id = [];
for ($i=1; $i<=150; $i++) {
    $address_id[$i-1] = $i;
}
$shuffle = shuffle($address_id);

for ($i=0; $i<150; $i++) {
    $name = $storeName[$i];
    $phone_number = $faker->unique()->phoneNumber;
    $email = $faker->unique()->freeEmail;
    $gopay = rand(0, 10000000);
    $gopay_coins = rand(0, 50000);

    $minutes = ['30', '00', '15', '45'];
    $rand_open = rand(6, 9);
    $open = "0{$rand_open}:{$minutes[array_rand($minutes)]}:00";
    $rand_closing = rand(18, 21);
    $closing = "{$rand_closing}:{$minutes[array_rand($minutes)]}:00";

    $address = $address_id[$i];

    $db->query("INSERT INTO store
    (role, name, phone_number, email, balance_gopay, balance_gopay_coins, opening_time, closing_time, address_id)
    VALUES ('store', '{$name}', '{$phone_number}', '{$email}', '{$gopay}', '{$gopay_coins}', '{$open}', '{$closing}', '{$address}')
    ");
}

