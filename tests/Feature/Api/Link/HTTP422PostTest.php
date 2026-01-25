<?php

if (!defined('PEST_RUNNING')) {
    return;
}

uses()->group('link-api-422');
uses()->group('link-api-422-post');
uses()->group('api-422');
uses()->group('api-422-post');

beforeEach(function (): void {
    $this->createUsers();
    $this->actingAs($this->admin);
});

describe('422 > POST', function (): void {
    apiTestArray([
        // DOWNLOAD TESTS
        'download > int' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['download' => 1]),
            'structure' => ['errors' => ['download']],
            'fragment' => ['errors' => ['download' => ['The download field must be a string.']]],
        ],
        'download > false' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['download' => false]),
            'structure' => ['errors' => ['download']],
            'fragment' => ['errors' => ['download' => ['The download field must be a string.']]],
        ],

        // HREF TESTS
        'href > empty' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['href' => '']),
            'structure' => ['errors' => ['href']],
            'fragment' => ['errors' => ['href' => ['The href field is required.']]],
        ],
        'href > integer' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['href' => 1]),
            'structure' => ['errors' => ['href']],
            'fragment' => ['errors' => ['href' => ['The href field must be a string.', 'The href field must be a valid URL.']]],
        ],
        'href > false' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['href' => false]),
            'structure' => ['errors' => ['href']],
            'fragment' => ['errors' => ['href' => ['The href field must be a string.', 'The href field must be a valid URL.']]],
        ],
        'href > true' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['href' => true]),
            'structure' => ['errors' => ['href']],
            'fragment' => ['errors' => ['href' => ['The href field must be a string.', 'The href field must be a valid URL.']]],
        ],
        'href > empty array' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['href' => []]),
            'structure' => ['errors' => ['href']],
            'fragment' => ['errors' => ['href' => ['The href field is required.']]],
        ],

        // CATEGORY TESTS
        'content > empty' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['category' => '']),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field is required.']]],
        ],
        'category > integer' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['category' => 1]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],
        'category > false' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['category' => false]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],
        'category > true' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['category' => true]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field must be a string.']]],
        ],
        'category > empty array' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['category' => []]),
            'structure' => ['errors' => ['category']],
            'fragment' => ['errors' => ['category' => ['The category field is required.']]],
        ],

        // SRC TESTS
        'src > integer' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['src' => 1]),
            'structure' => ['errors' => ['src']],
            'fragment' => ['errors' => ['src' => ['The src field must be a string.', 'The src field must be a valid URL.']]],
        ],
        'src > false' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['src' => false]),
            'structure' => ['errors' => ['src']],
            'fragment' => ['errors' => ['src' => ['The src field must be a string.', 'The src field must be a valid URL.']]],
        ],
        'src > true' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['src' => true]),
            'structure' => ['errors' => ['src']],
            'fragment' => ['errors' => ['src' => ['The src field must be a string.', 'The src field must be a valid URL.']]],
        ],
        'src > empty array' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['src' => []]),
            'structure' => ['errors' => ['src']],
            'fragment' => ['errors' => ['src' => ['The src field must be a string.', 'The src field must be a valid URL.']]],
        ],

        // ICON TESTS
        'icon > integer' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['icon' => 1]),
            'structure' => ['errors' => ['icon']],
            'fragment' => ['errors' => ['icon' => ['The icon field must be a string.']]],
        ],
        'icon > false' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['icon' => false]),
            'structure' => ['errors' => ['icon']],
            'fragment' => ['errors' => ['icon' => ['The icon field must be a string.']]],
        ],
        'icon > true' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['icon' => true]),
            'structure' => ['errors' => ['icon']],
            'fragment' => ['errors' => ['icon' => ['The icon field must be a string.']]],
        ],
        'icon > empty array' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['icon' => []]),
            'structure' => ['errors' => ['icon']],
            'fragment' => ['errors' => ['icon' => ['The icon field must be a string.']]],
        ],

        // HREFLANG TESTS
        'hreflang > integer' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['hreflang' => 1]),
            'structure' => ['errors' => ['hreflang']],
            'fragment' => ['errors' => ['hreflang' => ['The hreflang field must be a string.']]],
        ],
        'hreflang > false' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['hreflang' => false]),
            'structure' => ['errors' => ['hreflang']],
            'fragment' => ['errors' => ['hreflang' => ['The hreflang field must be a string.']]],
        ],
        'hreflang > true' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['hreflang' => true]),
            'structure' => ['errors' => ['hreflang']],
            'fragment' => ['errors' => ['hreflang' => ['The hreflang field must be a string.']]],
        ],
        'hreflang > empty array' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['hreflang' => []]),
            'structure' => ['errors' => ['hreflang']],
            'fragment' => ['errors' => ['hreflang' => ['The hreflang field must be a string.']]],
        ],

        // MEDIA TESTS
        'media > integer' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['media' => 1]),
            'structure' => ['errors' => ['media']],
            'fragment' => ['errors' => ['media' => ['The media field must be a string.']]],
        ],
        'media > false' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['media' => false]),
            'structure' => ['errors' => ['media']],
            'fragment' => ['errors' => ['media' => ['The media field must be a string.']]],
        ],
        'media > true' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['media' => true]),
            'structure' => ['errors' => ['media']],
            'fragment' => ['errors' => ['media' => ['The media field must be a string.']]],
        ],
        'media > empty array' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['media' => []]),
            'structure' => ['errors' => ['media']],
            'fragment' => ['errors' => ['media' => ['The media field must be a string.']]],
        ],

        // PING TESTS
        'ping > integer' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['ping' => 1]),
            'structure' => ['errors' => ['ping']],
            'fragment' => ['errors' => ['ping' => ['The ping field must be a string.']]],
        ],
        'ping > false' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['ping' => false]),
            'structure' => ['errors' => ['ping']],
            'fragment' => ['errors' => ['ping' => ['The ping field must be a string.']]],
        ],
        'ping > true' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['ping' => true]),
            'structure' => ['errors' => ['ping']],
            'fragment' => ['errors' => ['ping' => ['The ping field must be a string.']]],
        ],
        'ping > empty array' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['ping' => []]),
            'structure' => ['errors' => ['ping']],
            'fragment' => ['errors' => ['ping' => ['The ping field must be a string.']]],
        ],

        // REL TESTS
        'rel > integer' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['rel' => 1]),
            'structure' => ['errors' => ['rel']],
            'fragment' => ['errors' => ['rel' => ['The rel field must be a string.', 'The selected rel is invalid.']]],
        ],
        'rel > false' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['rel' => false]),
            'structure' => ['errors' => ['rel']],
            'fragment' => ['errors' => ['rel' => ['The rel field must be a string.', 'The selected rel is invalid.']]],
        ],
        'rel > true' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['rel' => true]),
            'structure' => ['errors' => ['rel']],
            'fragment' => ['errors' => ['rel' => ['The rel field must be a string.', 'The selected rel is invalid.']]],
        ],
        'rel > empty array' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['rel' => []]),
            'structure' => ['errors' => ['rel']],
            'fragment' => ['errors' => ['rel' => ['The rel field must be a string.', 'The selected rel is invalid.']]],
        ],

        // TARGET TESTS
        'target > integer' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['target' => 1]),
            'structure' => ['errors' => ['target']],
            'fragment' => ['errors' => ['target' => ['The selected target is invalid.', 'The target field must be a string.']]],
        ],
        'target > false' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['target' => false]),
            'structure' => ['errors' => ['target']],
            'fragment' => ['errors' => ['target' => ['The selected target is invalid.', 'The target field must be a string.']]],
        ],
        'target > true' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['target' => true]),
            'structure' => ['errors' => ['target']],
            'fragment' => ['errors' => ['target' => ['The selected target is invalid.', 'The target field must be a string.']]],
        ],
        'target > empty array' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['target' => []]),
            'structure' => ['errors' => ['target']],
            'fragment' => ['errors' => ['target' => ['The selected target is invalid.', 'The target field must be a string.']]],
        ],

        // TYPE TESTS
        'type > integer' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['type' => 1]),
            'structure' => ['errors' => ['type']],
            'fragment' => ['errors' => ['type' => ['The type field must be a string.']]],
        ],
        'type > false' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['type' => false]),
            'structure' => ['errors' => ['type']],
            'fragment' => ['errors' => ['type' => ['The type field must be a string.']]],
        ],
        'type > true' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['type' => true]),
            'structure' => ['errors' => ['type']],
            'fragment' => ['errors' => ['type' => ['The type field must be a string.']]],
        ],
        'type > empty array' => [
            'method' => 'POST',
            'route' => 'links.store',
            'data' => array_merge(linkData, ['type' => []]),
            'structure' => ['errors' => ['type']],
            'fragment' => ['errors' => ['type' => ['The type field must be a string.']]],
        ],
    ]);
});
