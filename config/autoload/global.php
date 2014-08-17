<?php
return array(
	'dcm-import' => array(
		'password' => '',
		'url' => '',
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
