<?php

$container->loadFromExtension('framework', [
    'serializer' => [
        'enabled' => false,
    ],
    'messenger' => [
        'serializer' => 'messenger.transport.symfony_serializer',
        'transports' => [
            'default' => 'amqp://localhost/%2f/messages',
        ],
    ],
]);
