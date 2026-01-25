<?php

if (!defined('PEST_RUNNING')) {
    return;
}

uses()->group('card-api-302');
uses()->group('api-302');

beforeEach(function (): void {
    $this->createUsers();
    $this->actingAs($this->admin);
});

describe('302', function (): void {
    apiTestArray([
        'put > show api' => [
            'method' => 'PUT',
            'route' => 'cards.show',
            'status' => 302,
            'id' => 1,
            'json' => false,
        ],
        'put > update api' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'status' => 302,
            'id' => 1,
            'json' => false,
        ],
        'put > delete api' => [
            'method' => 'PUT',
            'route' => 'cards.destroy',
            'status' => 302,
            'id' => 1,
            'json' => false,
        ],
    ]);
});
