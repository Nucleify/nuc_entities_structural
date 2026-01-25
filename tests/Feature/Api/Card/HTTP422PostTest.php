<?php

if (!defined('PEST_RUNNING')) {
    return;
}

uses()->group('card-api-422');
uses()->group('card-api-422-post');
uses()->group('api-422');
uses()->group('api-422-post');

beforeEach(function (): void {
    $this->createUsers();
    $this->actingAs($this->admin);
});

describe('422 > POST', function (): void {
    apiTestArray([
        // SRC TESTS
        'src > empty' => [
            'method' => 'POST',
            'route' => 'cards.store',
            'data' => array_merge(cardData, ['src' => '']),
            'structure' => ['errors' => ['src']],
            'fragment' => ['errors' => ['src' => ['The src field is required.']]],
        ],
        'src > integer' => [
            'method' => 'POST',
            'route' => 'cards.store',
            'data' => array_merge(cardData, ['src' => 12345]),
            'structure' => ['errors' => ['src']],
            'fragment' => ['errors' => ['src' => ['The src field must be a string.']]],
        ],
        'src > false' => [
            'method' => 'POST',
            'route' => 'cards.store',
            'data' => array_merge(cardData, ['src' => false]),
            'structure' => ['errors' => ['src']],
            'fragment' => ['errors' => ['src' => ['The src field must be a string.']]],
        ],

        // TITLE TESTS
        'title > empty' => [
            'method' => 'POST',
            'route' => 'cards.store',
            'data' => array_merge(cardData, ['title' => '']),
            'structure' => ['errors' => ['title']],
            'fragment' => ['errors' => ['title' => ['The title field is required.']]],
        ],
        'title > integer' => [
            'method' => 'POST',
            'route' => 'cards.store',
            'data' => array_merge(cardData, ['title' => 12345]),
            'structure' => ['errors' => ['title']],
            'fragment' => ['errors' => ['title' => ['The title field must be a string.']]],
        ],
        'title > false' => [
            'method' => 'POST',
            'route' => 'cards.store',
            'data' => array_merge(cardData, ['title' => false]),
            'structure' => ['errors' => ['title']],
            'fragment' => ['errors' => ['title' => ['The title field must be a string.']]],
        ],

        // DESCRIPTION TESTS
        'description > empty' => [
            'method' => 'POST',
            'route' => 'cards.store',
            'data' => array_merge(cardData, ['description' => '']),
            'structure' => ['errors' => ['description']],
            'fragment' => ['errors' => ['description' => ['The description field is required.']]],
        ],
        'description > integer' => [
            'method' => 'POST',
            'route' => 'cards.store',
            'data' => array_merge(cardData, ['description' => 12345]),
            'structure' => ['errors' => ['description']],
            'fragment' => ['errors' => ['description' => ['The description field must be a string.']]],
        ],

        // CATEGORY TESTS
        'category > integer' => [
            'method' => 'POST',
            'route' => 'cards.store',
            'data' => array_merge(cardData, ['category' => 1]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],
        'category > false' => [
            'method' => 'POST',
            'route' => 'cards.store',
            'data' => array_merge(cardData, ['category' => false]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],
        'category > true' => [
            'method' => 'POST',
            'route' => 'cards.store',
            'data' => array_merge(cardData, ['category' => true]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],
        'category > empty array' => [
            'method' => 'POST',
            'route' => 'cards.store',
            'data' => array_merge(cardData, ['category' => []]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],

        // COMPONENT TESTS
        'component > empty' => [
            'method' => 'POST',
            'route' => 'cards.store',
            'data' => array_merge(cardData, ['component' => '']),
            'structure' => ['errors' => ['component']],
            'fragment' => ['errors' => ['component' => ['The component field is required.']]],
        ],
        'component > integer' => [
            'method' => 'POST',
            'route' => 'cards.store',
            'data' => array_merge(cardData, ['component' => 12345]),
            'structure' => ['errors' => ['component']],
            'fragment' => ['errors' => ['component' => ['The component field must be a string.']]],
        ],

        // DISPLAY TESTS
        'display > string' => [
            'method' => 'POST',
            'route' => 'cards.store',
            'data' => array_merge(cardData, ['display' => 'string']),
            'structure' => ['errors' => ['display']],
            'fragment' => ['errors' => ['display' => ['The display field must be true or false.']]],
        ],
        'display > empty array' => [
            'method' => 'POST',
            'route' => 'cards.store',
            'data' => array_merge(cardData, ['display' => []]),
            'structure' => ['errors' => ['display']],
            'fragment' => ['errors' => ['display' => ['The display field must be true or false.']]],
        ],
    ]);
});
