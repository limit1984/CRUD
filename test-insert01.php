<?php

require __DIR__ . '/parts/connect_db.php';

$postData = [
    'name' => "陳小華's 愛犬",
    'email' => "wawa@ttt.com",
    'mobile' => "0935123777",
    'birthday' => '1998-05-06',
    'address' => '台東市',
];

// 錯誤的寫法

$sql = sprintf(
    "INSERT INTO `address_book`(
    `name`,`email`,`mobile`,`birthday`,`address`,`created_at`)  VALUES(
    %s,'%s','%s','%s','%s',NOW()
    )",
    $pdo->quote($postData['name']),
    $postData['email'],
    $postData['mobile'],
    $postData['birthday'],
    $postData['address']
);

