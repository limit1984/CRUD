<?php

require __DIR__ . '/parts/connect_db.php';

$postData = [
    'name' => "陳小華's cat",
    'email' => "wawa@ttt.com",
    'mobile' => "0935123777",
    'birthday' => '1998-05-06',
    'address' => '台東市',
];

$sql = 
    "INSERT INTO `address_book`(
    `name`,`email`,`mobile`,`birthday`,`address`,`created_at`)  VALUES(
    ?,?,?,
    ?,?,NOW()
    )";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $postData['name'],
        $postData['email'],
        $postData['mobile'],
        $postData['birthday'],
        $postData['address']
    ]);

echo $stmt->rowCount();