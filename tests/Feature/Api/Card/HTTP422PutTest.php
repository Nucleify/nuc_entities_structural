<?php

if (!defined('PEST_RUNNING')) {
    return;
}

uses()->group('card-api-422');
uses()->group('card-api-422-put');
uses()->group('api-422');
uses()->group('api-422-put');

beforeEach(function (): void {
    $this->createUsers();
    $this->actingAs($this->admin);
});

describe('422 > PUT', function (): void {
    apiTestArray([
        // SRC TESTS
        'src > empty' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'id' => 1,
            'data' => array_merge(updatedCardData, ['src' => '']),
            'structure' => ['errors' => ['src']],
            'fragment' => ['errors' => ['src' => ['The src field is required.']]],
        ],
        'src > integer' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'id' => 1,
            'data' => array_merge(updatedCardData, ['src' => 12345]),
            'structure' => ['errors' => ['src']],
            'fragment' => ['errors' => ['src' => ['The src field must be a string.']]],
        ],
        'src > false' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'id' => 1,
            'data' => array_merge(updatedCardData, ['src' => false]),
            'structure' => ['errors' => ['src']],
            'fragment' => ['errors' => ['src' => ['The src field must be a string.']]],
        ],

        // TITLE TESTS
        'title > empty' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'id' => 1,
            'data' => array_merge(updatedCardData, ['title' => '']),
            'structure' => ['errors' => ['title']],
            'fragment' => ['errors' => ['title' => ['The title field is required.']]],
        ],
        'title > integer' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'id' => 1,
            'data' => array_merge(updatedCardData, ['title' => 12345]),
            'structure' => ['errors' => ['title']],
            'fragment' => ['errors' => ['title' => ['The title field must be a string.']]],
        ],
        'title > false' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'id' => 1,
            'data' => array_merge(updatedCardData, ['title' => false]),
            'structure' => ['errors' => ['title']],
            'fragment' => ['errors' => ['title' => ['The title field must be a string.']]],
        ],

        // DESCRIPTION TESTS
        'description > empty' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'id' => 1,
            'data' => array_merge(updatedCardData, ['description' => '']),
            'structure' => ['errors' => ['description']],
            'fragment' => ['errors' => ['description' => ['The description field is required.']]],
        ],
        'description > integer' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'id' => 1,
            'data' => array_merge(updatedCardData, ['description' => 12345]),
            'structure' => ['errors' => ['description']],
            'fragment' => ['errors' => ['description' => ['The description field must be a string.']]],
        ],

        // CATEGORY TESTS
        'category > integer' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'id' => 1,
            'data' => array_merge(updatedCardData, ['category' => 1]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],
        'category > false' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'id' => 1,
            'data' => array_merge(updatedCardData, ['category' => false]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],
        'category > true' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'id' => 1,
            'data' => array_merge(updatedCardData, ['category' => true]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],
        'category > empty array' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'id' => 1,
            'data' => array_merge(updatedCardData, ['category' => []]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],

        // COMPONENT TESTS
        'component > empty' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'id' => 1,
            'data' => array_merge(updatedCardData, ['component' => '']),
            'structure' => ['errors' => ['component']],
            'fragment' => ['errors' => ['component' => ['The component field is required.']]],
        ],
        'component > integer' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'id' => 1,
            'data' => array_merge(updatedCardData, ['component' => 12345]),
            'structure' => ['errors' => ['component']],
            'fragment' => ['errors' => ['component' => ['The component field must be a string.']]],
        ],

        // DISPLAY TESTS
        'display > string' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'id' => 1,
            'data' => array_merge(updatedCardData, ['display' => 'string']),
            'structure' => ['errors' => ['display']],
            'fragment' => ['errors' => ['display' => ['The display field must be true or false.']]],
        ],
        'display > empty array' => [
            'method' => 'PUT',
            'route' => 'cards.update',
            'id' => 1,
            'data' => array_merge(updatedCardData, ['display' => []]),
            'structure' => ['errors' => ['display']],
            'fragment' => ['errors' => ['display' => ['The display field must be true or false.']]],
        ],
    ]);
});
