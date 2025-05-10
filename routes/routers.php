<?php
$routes = [
    '/' => [
        'controller' => 'HomeControllers',
        'action' => 'index'
    ],
    '/client/register' => [
        'controller' => 'ClientControllers',
        'action' => 'register'
    ],
    '/client/store' => [
        'controller' => 'ClientControllers',
        'action' => 'store'
    ],
    '/client/login' => [
        'controller' => 'ClientControllers',
        'action' => 'login'
    ],
    '/client/logout' => [
        'controller' => 'ClientControllers',
        'action' => 'logout'
    ],
    '/client/authenticate' => [
        'controller' => 'ClientControllers',
        'action' => 'authenticate'
    ],
    '/client/dashboard' => [
        'controller' => 'ClientControllers',
        'action' => 'dashboard'
    ],
    '/client/properties' => [
        'controller' => 'ClientControllers',
        'action' => 'properties'
    ],
    '/client/favorites' => [
        'controller' => 'ClientControllers',
        'action' => 'favorites'
    ],
    '/client/appointment' => [
        'controller' => 'ClientControllers',
        'action' => 'appointment'
    ],
];
