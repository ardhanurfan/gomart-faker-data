<?php

// Connect to DB
$db = new PDO('mysql:host=localhost;dbname=go-mart', 'root', '');
$db->query("DELETE FROM category");
$db->query("ALTER TABLE category AUTO_INCREMENT = 1");

$json = file_get_contents("category.json");
$category_arr = json_decode($json, true);

for ($i=0; $i<count($category_arr); $i++) {
    $item_id = $category_arr[$i]['item_id'];
    $category = $category_arr[$i]['category'];

    $db->query("INSERT INTO category
    (item_id, category)
    VALUES ('{$item_id}', '{$category}')
    ");
}

