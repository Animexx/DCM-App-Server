<?php
return array(
    'zf-mvc-auth' => array(
        'authentication' => array(),
    ),
    'db' => array(
        'adapters' => array(
            'DCM-App' => array(
                'driver' => 'Pdo_Sqlite',
                'database' => 'data/competition.db',
                'charset' => '',
            ),
        ),
    ),
);
