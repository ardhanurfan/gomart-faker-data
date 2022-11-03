<?php

require_once 'vendor/autoload.php';
$faker = Faker\Factory::create('id_ID');


// Connect to DB
$db = new PDO('mysql:host=localhost;dbname=go-mart', 'root', '');
$db->query("DELETE FROM driver");
$db->query("ALTER TABLE driver AUTO_INCREMENT = 1");

// Plat Nomor Foreign Key
$json = file_get_contents("vehicle.json");
$vehicle = json_decode($json, true)['vehicle'];
$shuffle = shuffle($vehicle);

for ($i=0; $i<300; $i++) {
    $name = $faker->unique()->name;
    $phone_number = $faker->unique()->phoneNumber;
    $email = $faker->unique()->freeEmail;
    $gopay = rand(0, 1000000);
    $gopay_coins = rand(0, 50000);
    $peformance = rand(0, 5);
    $poin = rand(0, 100);
    $income =  rand(100000, 3000000);
    $license_plate = $vehicle[$i]['license_plate'];

    $db->query("INSERT INTO driver
    (role, name, phone_number, email, balance_gopay, balance_gopay_coins, peformance, point, income, license_plate)
    VALUES ('driver', '{$name}', '{$phone_number}', '{$email}', '{$gopay}', '{$gopay_coins}', '{$peformance}', '{$poin}', '{$income}', '{$license_plate}')
    ");
}

