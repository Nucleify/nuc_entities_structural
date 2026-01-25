<?php

if (!defined('PEST_RUNNING')) {
    return;
}

uses()->group('feature-api-422');
uses()->group('feature-api-422-put');
uses()->group('api-422');
uses()->group('api-422-put');

beforeEach(function (): void {
    $this->createUsers();
    $this->actingAs($this->admin);
});

describe('422 > PUT', function (): void {
    apiTestArray([
        // ICON TESTS
        'icon > integer' => [
            'method' => 'PUT',
            'route' => 'features.update',
            'id' => 1,
            'data' => array_merge(updatedFeatureData, ['icon' => 1]),
            'structure' => ['errors' => ['icon']],
            'fragment' => ['errors' => ['icon' => ['The icon field must be a string.']]],
        ],
        'icon > false' => [
            'method' => 'PUT',
            'route' => 'features.update',
            'id' => 1,
            'data' => array_merge(updatedFeatureData, ['icon' => false]),
            'structure' => ['errors' => ['icon']],
            'fragment' => ['errors' => ['icon' => ['The icon field must be a string.']]],
        ],
        'icon > true' => [
            'method' => 'PUT',
            'route' => 'features.update',
            'id' => 1,
            'data' => array_merge(updatedFeatureData, ['icon' => true]),
            'structure' => ['errors' => ['icon']],
            'fragment' => ['errors' => ['icon' => ['The icon field must be a string.']]],
        ],
        'icon > empty array' => [
            'method' => 'PUT',
            'route' => 'features.update',
            'id' => 1,
            'data' => array_merge(updatedFeatureData, ['icon' => []]),
            'structure' => ['errors' => ['icon']],
            'fragment' => ['errors' => ['icon' => ['The icon field is required.']]],
        ],

        // HEADER TESTS
        'header > empty' => [
            'method' => 'PUT',
            'route' => 'features.update',
            'id' => 1,
            'data' => array_merge(updatedFeatureData, ['header' => '']),
            'structure' => ['errors' => ['header']],
            'fragment' => ['errors' => ['header' => ['The header field is required.']]],
        ],
        'header > integer' => [
            'method' => 'PUT',
            'route' => 'features.update',
            'id' => 1,
            'data' => array_merge(updatedFeatureData, ['header' => 1]),
            'structure' => ['errors' => ['header']],
            'fragment' => ['errors' => ['header' => ['The header field must be a string.']]],
        ],
        'header > false' => [
            'method' => 'PUT',
            'route' => 'features.update',
            'id' => 1,
            'data' => array_merge(updatedFeatureData, ['header' => false]),
            'structure' => ['errors' => ['header']],
            'fragment' => ['errors' => ['header' => ['The header field must be a string.']]],
        ],
        'header > true' => [
            'method' => 'PUT',
            'route' => 'features.update',
            'id' => 1,
            'data' => array_merge(updatedFeatureData, ['header' => true]),
            'structure' => ['errors' => ['header']],
            'fragment' => ['errors' => ['header' => ['The header field must be a string.']]],
        ],
        'header > empty array' => [
            'method' => 'PUT',
            'route' => 'features.update',
            'id' => 1,
            'data' => array_merge(updatedFeatureData, ['header' => []]),
            'structure' => ['errors' => ['header']],
            'fragment' => ['errors' => ['header' => ['The header field is required.']]],
        ],

        // DESCRIPTION TESTS
        'description > integer' => [
            'method' => 'PUT',
            'route' => 'features.update',
            'id' => 1,
            'data' => array_merge(updatedFeatureData, ['description' => 1]),
            'structure' => ['errors' => ['description']],
            'fragment' => ['errors' => ['description' => ['The description field must be a string.']]],
        ],
        'description > false' => [
            'method' => 'PUT',
            'route' => 'features.update',
            'id' => 1,
            'data' => array_merge(updatedFeatureData, ['description' => false]),
            'structure' => ['errors' => ['description']],
            'fragment' => ['errors' => ['description' => ['The description field must be a string.']]],
        ],
        'description > true' => [
            'method' => 'PUT',
            'route' => 'features.update',
            'id' => 1,
            'data' => array_merge(updatedFeatureData, ['description' => true]),
            'structure' => ['errors' => ['description']],
            'fragment' => ['errors' => ['description' => ['The description field must be a string.']]],
        ],
        'description > empty array' => [
            'method' => 'PUT',
            'route' => 'features.update',
            'id' => 1,
            'data' => array_merge(updatedFeatureData, ['description' => []]),
            'structure' => ['errors' => ['description']],
            'fragment' => ['errors' => ['description' => ['The description field is required.']]],
        ],

        // CATEGORY TESTS
        'content > empty' => [
            'method' => 'PUT',
            'route' => 'features.update',
            'id' => 1,
            'data' => array_merge(updatedFeatureData, ['category' => '']),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field is required.']]],
        ],
        'category > integer' => [
            'method' => 'PUT',
            'route' => 'features.update',
            'id' => 1,
            'data' => array_merge(updatedFeatureData, ['category' => 1]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],
        'category > false' => [
            'method' => 'PUT',
            'route' => 'features.update',
            'id' => 1,
            'data' => array_merge(updatedFeatureData, ['category' => false]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],
        'category > true' => [
            'method' => 'PUT',
            'route' => 'features.update',
            'id' => 1,
            'data' => array_merge(updatedFeatureData, ['category' => true]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],
        'category > empty array' => [
            'method' => 'PUT',
            'route' => 'features.update',
            'id' => 1,
            'data' => array_merge(updatedFeatureData, ['category' => []]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field is required.']]],
        ],
    ]);
});
