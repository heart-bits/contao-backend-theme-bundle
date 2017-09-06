<?php

/**
 * Back end modules
 */

array_insert($GLOBALS['BE_MOD'], 99, array(
    'heartbits' => array(
        'handbook' => array(
            'callback'        => 'Heartbits\ContaoBackendTheme\Handbook',
        ),
    )
));
