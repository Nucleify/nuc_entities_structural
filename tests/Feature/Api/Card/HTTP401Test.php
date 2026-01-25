<?php

if (!defined('PEST_RUNNING')) {
    return;
}

uses()->group('card-api-401');
uses()->group('api-401');

describe('401', function (): void {
    apiTestArray([
        'index api' => [
            'method' => 'GET',
            'route' => 'cards.index',
            'status' => 401,
            'structure' => ['message'],
            'fragment' => ['message' => 'Unauthenticated.'],
        ],
        'countByCreatedLastWeek api' => [
            'method' => 'GET',
            'route' => 'cards.countByCreatedLastWeek',
            'status' => 401,
            'structure' => ['message'],
            'fragment' => ['message' => 'Unauthenticated.'],
        ],
        'show api' => [
            'method' => 'SHOW',
            'route' => 'cards.show',
            'status' => 401,
            'id' => 1,
            'structure' => ['message'],
            'fragment' => ['message' => 'Unauthenticated.'],
        ],
        'store api with data' => [
            'method' => 'POST',
            'route' => 'cards.store',
            'status' => 401,
            'data' => cardData,
            'structure' => ['message'],
            'fragment' => ['message' => 'Unauthenticated.'],
        ],
        'store api empty json' => [
            'method' => 'POST',
            'route' => 'cards.store',
            'status' => 401,
            'data' => [],
            'structure' => ['message'],
            'fragment' => ['message' => 'Unauthenticated.'],
        ],
        'update api with data' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'status' => 401,
            'id' => 1,
            'data' => cardData,
            'structure' => ['message'],
            'fragment' => ['message' => 'Unauthenticated.'],
        ],
        'update api empty json' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'status' => 401,
            'id' => 1,
            'data' => [],
            'structure' => ['message'],
            'fragment' => ['message' => 'Unauthenticated.'],
        ],
        'destroy api' => [
            'method' => 'DELETE',
            'route' => 'cards.destroy',
            'status' => 401,
            'id' => 1,
            'structure' => ['message'],
            'fragment' => ['message' => 'Unauthenticated.'],
        ],
    ]);
});
