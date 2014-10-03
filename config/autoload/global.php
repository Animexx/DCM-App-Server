<?php
return array(
	'dcm-import' => array(
		'password' => '',
		'url' => '',
	),
	'dcm-users' => array(
		'htpasswd' => __DIR__ . "/../../data/htpasswd",
	),
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
