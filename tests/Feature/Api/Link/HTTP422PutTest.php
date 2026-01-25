<?php

if (!defined('PEST_RUNNING')) {
    return;
}

uses()->group('link-api-422');
uses()->group('link-api-422-put');
uses()->group('api-422');
uses()->group('api-422-put');

beforeEach(function (): void {
    $this->createUsers();
    $this->actingAs($this->admin);
});

describe('422 > PUT', function (): void {
    apiTestArray([
        // DOWNLOAD TESTS
        'download > int' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['download' => 1]),
            'structure' => ['errors' => ['download']],
            'fragment' => ['errors' => ['download' => ['The download field must be a string.']]],
        ],
        'download > false' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['download' => false]),
            'structure' => ['errors' => ['download']],
            'fragment' => ['errors' => ['download' => ['The download field must be a string.']]],
        ],

        // HREF TESTS
        'href > empty' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['href' => '']),
            'structure' => ['errors' => ['href']],
            'fragment' => ['errors' => ['href' => ['The href field is required.']]],
        ],
        'href > integer' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['href' => 1]),
            'structure' => ['errors' => ['href']],
            'fragment' => ['errors' => ['href' => ['The href field must be a string.', 'The href field must be a valid URL.']]],
        ],
        'href > false' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['href' => false]),
            'structure' => ['errors' => ['href']],
            'fragment' => ['errors' => ['href' => ['The href field must be a string.', 'The href field must be a valid URL.']]],
        ],
        'href > true' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['href' => true]),
            'structure' => ['errors' => ['href']],
            'fragment' => ['errors' => ['href' => ['The href field must be a string.', 'The href field must be a valid URL.']]],
        ],
        'href > empty array' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['href' => []]),
            'structure' => ['errors' => ['href']],
            'fragment' => ['errors' => ['href' => ['The href field is required.']]],
        ],

        // CATEGORY TESTS
        'content > empty' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['category' => '']),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field is required.']]],
        ],
        'category > integer' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['category' => 1]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],
        'category > false' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['category' => false]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],
        'category > true' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['category' => true]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],
        'category > empty array' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['category' => []]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field is required.']]],
        ],

        // SRC TESTS
        'src > integer' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['src' => 1]),
            'structure' => ['errors' => ['src']],
            'fragment' => ['errors' => ['src' => ['The src field must be a string.', 'The src field must be a valid URL.']]],
        ],
        'src > false' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['src' => false]),
            'structure' => ['errors' => ['src']],
            'fragment' => ['errors' => ['src' => ['The src field must be a string.', 'The src field must be a valid URL.']]],
        ],
        'src > true' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['src' => true]),
            'structure' => ['errors' => ['src']],
            'fragment' => ['errors' => ['src' => ['The src field must be a string.', 'The src field must be a valid URL.']]],
        ],
        'src > empty array' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['src' => []]),
            'structure' => ['errors' => ['src']],
            'fragment' => ['errors' => ['src' => ['The src field must be a string.', 'The src field must be a valid URL.']]],
        ],

        // ICON TESTS
        'icon > integer' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['icon' => 1]),
            'structure' => ['errors' => ['icon']],
            'fragment' => ['errors' => ['icon' => ['The icon field must be a string.']]],
        ],
        'icon > false' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['icon' => false]),
            'structure' => ['errors' => ['icon']],
            'fragment' => ['errors' => ['icon' => ['The icon field must be a string.']]],
        ],
        'icon > true' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['icon' => true]),
            'structure' => ['errors' => ['icon']],
            'fragment' => ['errors' => ['icon' => ['The icon field must be a string.']]],
        ],
        'icon > empty array' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['icon' => []]),
            'structure' => ['errors' => ['icon']],
            'fragment' => ['errors' => ['icon' => ['The icon field must be a string.']]],
        ],

        // HREFLANG TESTS
        'hreflang > integer' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['hreflang' => 1]),
            'structure' => ['errors' => ['hreflang']],
            'fragment' => ['errors' => ['hreflang' => ['The hreflang field must be a string.']]],
        ],
        'hreflang > false' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['hreflang' => false]),
            'structure' => ['errors' => ['hreflang']],
            'fragment' => ['errors' => ['hreflang' => ['The hreflang field must be a string.']]],
        ],
        'hreflang > true' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['hreflang' => true]),
            'structure' => ['errors' => ['hreflang']],
            'fragment' => ['errors' => ['hreflang' => ['The hreflang field must be a string.']]],
        ],
        'hreflang > empty array' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['hreflang' => []]),
            'structure' => ['errors' => ['hreflang']],
            'fragment' => ['errors' => ['hreflang' => ['The hreflang field must be a string.']]],
        ],

        // MEDIA TESTS
        'media > integer' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['media' => 1]),
            'structure' => ['errors' => ['media']],
            'fragment' => ['errors' => ['media' => ['The media field must be a string.']]],
        ],
        'media > false' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['media' => false]),
            'structure' => ['errors' => ['media']],
            'fragment' => ['errors' => ['media' => ['The media field must be a string.']]],
        ],
        'media > true' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['media' => true]),
            'structure' => ['errors' => ['media']],
            'fragment' => ['errors' => ['media' => ['The media field must be a string.']]],
        ],
        'media > empty array' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['media' => []]),
            'structure' => ['errors' => ['media']],
            'fragment' => ['errors' => ['media' => ['The media field must be a string.']]],
        ],

        // PING TESTS
        'ping > integer' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['ping' => 1]),
            'structure' => ['errors' => ['ping']],
            'fragment' => ['errors' => ['ping' => ['The ping field must be a string.']]],
        ],
        'ping > false' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['ping' => false]),
            'structure' => ['errors' => ['ping']],
            'fragment' => ['errors' => ['ping' => ['The ping field must be a string.']]],
        ],
        'ping > true' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['ping' => true]),
            'structure' => ['errors' => ['ping']],
            'fragment' => ['errors' => ['ping' => ['The ping field must be a string.']]],
        ],
        'ping > empty array' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['ping' => []]),
            'structure' => ['errors' => ['ping']],
            'fragment' => ['errors' => ['ping' => ['The ping field must be a string.']]],
        ],

        // REL TESTS
        'rel > integer' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['rel' => 1]),
            'structure' => ['errors' => ['rel']],
            'fragment' => ['errors' => ['rel' => ['The rel field must be a string.', 'The selected rel is invalid.']]],
        ],
        'rel > false' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['rel' => false]),
            'structure' => ['errors' => ['rel']],
            'fragment' => ['errors' => ['rel' => ['The rel field must be a string.', 'The selected rel is invalid.']]],
        ],
        'rel > true' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['rel' => true]),
            'structure' => ['errors' => ['rel']],
            'fragment' => ['errors' => ['rel' => ['The rel field must be a string.', 'The selected rel is invalid.']]],
        ],
        'rel > empty array' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['rel' => []]),
            'structure' => ['errors' => ['rel']],
            'fragment' => ['errors' => ['rel' => ['The rel field must be a string.', 'The selected rel is invalid.']]],
        ],

        // TARGET TESTS
        'target > integer' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['target' => 1]),
            'structure' => ['errors' => ['target']],
            'fragment' => ['errors' => ['target' => ['The selected target is invalid.', 'The target field must be a string.']]],
        ],
        'target > false' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['target' => false]),
            'structure' => ['errors' => ['target']],
            'fragment' => ['errors' => ['target' => ['The selected target is invalid.', 'The target field must be a string.']]],
        ],
        'target > true' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['target' => true]),
            'structure' => ['errors' => ['target']],
            'fragment' => ['errors' => ['target' => ['The selected target is invalid.', 'The target field must be a string.']]],
        ],
        'target > empty array' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['target' => []]),
            'structure' => ['errors' => ['target']],
            'fragment' => ['errors' => ['target' => ['The selected target is invalid.', 'The target field must be a string.']]],
        ],

        // TYPE TESTS
        'type > integer' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['type' => 1]),
            'structure' => ['errors' => ['type']],
            'fragment' => ['errors' => ['type' => ['The type field must be a string.']]],
        ],
        'type > false' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['type' => false]),
            'structure' => ['errors' => ['type']],
            'fragment' => ['errors' => ['type' => ['The type field must be a string.']]],
        ],
        'type > true' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['type' => true]),
            'structure' => ['errors' => ['type']],
            'fragment' => ['errors' => ['type' => ['The type field must be a string.']]],
        ],
        'type > empty array' => [
            'method' => 'PUT',
            'route' => 'links.update',
            'id' => 1,
            'data' => array_merge(updatedLinkData, ['type' => []]),
            'structure' => ['errors' => ['type']],
            'fragment' => ['errors' => ['type' => ['The type field must be a string.']]],
        ],
    ]);
});
