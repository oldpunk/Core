<?php

return [
    'name' => 'Core',

    'multi_language' => false,

    'admin' => [
        'prefix' => 'admin',
        'middleware' => ['web', 'auth']
    ]
];
