<?php
return [
    'db' =>
    [
        'host'     => 'mysql-server',
        'username' => 'root',
        'password' => 'secret',
        'dbname'   => 'spotify'
    ],
    "mongo" => [
        "adapter" => "Client",
        "url" => "mongodb://mongo",
        "username" => "root",
        "password" => "password123",
        "dbname" => "store"
    ]
];