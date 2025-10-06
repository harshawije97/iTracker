<?php

function login($username, $password)
{
    session_start();
    $_SESSION['user_id'] = 1;
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;


    return [
        'success' => true,
        'message' => 'Login successful',
        'data' => [
            'user_id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'password' => $_SESSION['password']
        ]
    ];
}
