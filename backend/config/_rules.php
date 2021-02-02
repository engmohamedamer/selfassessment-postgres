<?php
return [
    [
        'controllers' => ['sign-in'],
        'allow' => true,
        'roles' => ['?'],
        'actions' => ['login','reset-password','request-password-reset'],
    ],
    [
        'controllers' => ['sign-in'],
        'allow' => true,
        'roles' => ['@'],
        'actions' => ['logout'],
    ],
    [
        'controllers' => ['site'],
        'allow' => true,
        'roles' => ['?', '@'],
        'actions' => ['error'],
    ],
    [
        'controllers' => ['debug/default'],
        'allow' => true,
        'roles' => ['?'],
    ],


    [
        'controllers' => ['user'],
        'allow' => true,
        'roles' => ['administrator'],
    ],

    [
        'controllers' => ['user'],
        'allow' => true,
        'actions' => ['profile','account','organization-admins','update','create-organization-admin'],

        'roles' => ['manager'],
    ],
    [
        'controllers' => ['user'],
        'allow' => false,
    ],

    [
        'allow' => true,
        'roles' => ['manager', 'administrator'],
    ],



    /**  *-------------------------------- Moe Admin  --------------------------------------------   **/




];
?>
