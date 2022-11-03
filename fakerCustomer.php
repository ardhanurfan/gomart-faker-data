<?php

require_once 'vendor/autoload.php';
$faker = Faker\Factory::create('id_ID');


# Connect to DB
$db = new PDO('mysql:host=localhost;dbname=go-mart', 'root', '');
$db->query("DELETE FROM customer");
$db->query("ALTER TABLE customer AUTO_INCREMENT = 1");

for ($i=0; $i<300; $i++) {
    $name = $faker->unique()->name;
    $phone_number = $faker->unique()->phoneNumber;
    $email = $faker->unique()->freeEmail;
    $gopay = rand(0, 1000000);
    $gopay_coins = rand(0, 50000);
    $clubxp = rand(0, 50);
    $db->query("INSERT INTO customer
    (role, name, phone_number, email, balance_gopay, balance_gopay_coins, GoClubXP)
    VALUES ('customer', '{$name}', '{$phone_number}', '{$email}', '{$gopay}', '{$gopay_coins}', '{$clubxp}')
    ");
}