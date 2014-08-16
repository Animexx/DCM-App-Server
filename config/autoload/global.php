<?php
return array(
    'zf-mvc-auth' => array(
        'authentication' => array(
            'http' => array(
                'accept_schemes' => array(
                    0 => 'basic',
                ),
                'realm' => 'DCM',
            ),
        ),
    ),
    'db' => array(
        'adapters' => array(
            'DCM-App' => array(),
        ),
    ),
);
