<?php

if (!defined('PEST_RUNNING')) {
    return;
}

uses()->group('feature-api-422');
uses()->group('feature-api-422-post');
uses()->group('api-422');
uses()->group('api-422-post');

beforeEach(function (): void {
    $this->createUsers();
    $this->actingAs($this->admin);
});

describe('422 > POST', function (): void {
    apiTestArray([
        // ICON TESTS
        'icon > integer' => [
            'method' => 'POST',
            'route' => 'features.store',
            'data' => array_merge(featureData, ['icon' => 1]),
            'structure' => ['errors' => ['icon']],
            'fragment' => ['errors' => ['icon' => ['The icon field must be a string.']]],
        ],
        'icon > false' => [
            'method' => 'POST',
            'route' => 'features.store',
            'data' => array_merge(featureData, ['icon' => false]),
            'structure' => ['errors' => ['icon']],
            'fragment' => ['errors' => ['icon' => ['The icon field must be a string.']]],
        ],
        'icon > true' => [
            'method' => 'POST',
            'route' => 'features.store',
            'data' => array_merge(featureData, ['icon' => true]),
            'structure' => ['errors' => ['icon']],
            'fragment' => ['errors' => ['icon' => ['The icon field must be a string.']]],
        ],
        'icon > empty array' => [
            'method' => 'POST',
            'route' => 'features.store',
            'data' => array_merge(featureData, ['icon' => []]),
            'structure' => ['errors' => ['icon']],
            'fragment' => ['errors' => ['icon' => ['The icon field is required.']]],
        ],

        // HEADER TESTS
        'header > empty' => [
            'method' => 'POST',
            'route' => 'features.store',
            'data' => array_merge(featureData, ['header' => '']),
            'structure' => ['errors' => ['header']],
            'fragment' => ['errors' => ['header' => ['The header field is required.']]],
        ],
        'header > integer' => [
            'method' => 'POST',
            'route' => 'features.store',
            'data' => array_merge(featureData, ['header' => 1]),
            'structure' => ['errors' => ['header']],
            'fragment' => ['errors' => ['header' => ['The header field must be a string.']]],
        ],
        'header > false' => [
            'method' => 'POST',
            'route' => 'features.store',
            'data' => array_merge(featureData, ['header' => false]),
            'structure' => ['errors' => ['header']],
            'fragment' => ['errors' => ['header' => ['The header field must be a string.']]],
        ],
        'header > true' => [
            'method' => 'POST',
            'route' => 'features.store',
            'data' => array_merge(featureData, ['header' => true]),
            'structure' => ['errors' => ['header']],
            'fragment' => ['errors' => ['header' => ['The header field must be a string.']]],
        ],
        'header > empty array' => [
            'method' => 'POST',
            'route' => 'features.store',
            'data' => array_merge(featureData, ['header' => []]),
            'structure' => ['errors' => ['header']],
            'fragment' => ['errors' => ['header' => ['The header field is required.']]],
        ],

        // DESCRIPTION TESTS
        'description > integer' => [
            'method' => 'POST',
            'route' => 'features.store',
            'data' => array_merge(featureData, ['description' => 1]),
            'structure' => ['errors' => ['description']],
            'fragment' => ['errors' => ['description' => ['The description field must be a string.']]],
        ],
        'description > false' => [
            'method' => 'POST',
            'route' => 'features.store',
            'data' => array_merge(featureData, ['description' => false]),
            'structure' => ['errors' => ['description']],
            'fragment' => ['errors' => ['description' => ['The description field must be a string.']]],
        ],
        'description > true' => [
            'method' => 'POST',
            'route' => 'features.store',
            'data' => array_merge(featureData, ['description' => true]),
            'structure' => ['errors' => ['description']],
            'fragment' => ['errors' => ['description' => ['The description field must be a string.']]],
        ],
        'description > empty array' => [
            'method' => 'POST',
            'route' => 'features.store',
            'data' => array_merge(featureData, ['description' => []]),
            'structure' => ['errors' => ['description']],
            'fragment' => ['errors' => ['description' => ['The description field is required.']]],
        ],

        // CATEGORY TESTS
        'content > empty' => [
            'method' => 'POST',
            'route' => 'features.store',
            'data' => array_merge(featureData, ['category' => '']),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field is required.']]],
        ],
        'category > integer' => [
            'method' => 'POST',
            'route' => 'features.store',
            'data' => array_merge(featureData, ['category' => 1]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],
        'category > false' => [
            'method' => 'POST',
            'route' => 'features.store',
            'data' => array_merge(featureData, ['category' => false]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],
        'category > true' => [
            'method' => 'POST',
            'route' => 'features.store',
            'data' => array_merge(featureData, ['category' => true]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],
        'category > empty array' => [
            'method' => 'POST',
            'route' => 'features.store',
            'data' => array_merge(featureData, ['category' => []]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field is required.']]],
        ],
    ]);
});
