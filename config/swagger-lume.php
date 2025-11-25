<?php

return [
    'api' => [
        /*
        |--------------------------------------------------------------------------
        | Edit to set the api's title
        |--------------------------------------------------------------------------
        */
        'title' => 'Blog API Documentation',
    ],

    'routes' => [
        /*
        |--------------------------------------------------------------------------
        | Route for accessing api documentation interface
        |--------------------------------------------------------------------------
        */
        'api' => 'api/documentation',

        /*
        |--------------------------------------------------------------------------
        | Route for accessing parsed swagger annotations.
        |--------------------------------------------------------------------------
        */
        'docs' => 'docs',

        /*
        |--------------------------------------------------------------------------
        | Route for accessing Swagger UI assets
        |--------------------------------------------------------------------------
        */
        'assets' => 'swagger-ui-assets',

        /*
        |--------------------------------------------------------------------------
        | Route for OAuth2 callback
        |--------------------------------------------------------------------------
        */
        'oauth2_callback' => 'api/oauth2-callback',

        /*
        |--------------------------------------------------------------------------
        | Middleware allows to prevent unexpected access to API documentation
        |--------------------------------------------------------------------------
         */
        'middleware' => [
            'api' => [],
            'asset' => [],
            'docs' => [],
            'oauth2_callback' => [],
        ],
    ],

    'paths' => [
        /*
        |--------------------------------------------------------------------------
        | Absolute path to location where parsed swagger annotations will be stored
        |--------------------------------------------------------------------------
        */
        'docs' => storage_path('api-docs'),

        /*
        |--------------------------------------------------------------------------
        | File name of the generated json documentation file
        |--------------------------------------------------------------------------
        */
        'docs_json' => 'api-docs.json',

        /*
        |--------------------------------------------------------------------------
        | File name of the generated YAML documentation file
        |--------------------------------------------------------------------------
         */
        'docs_yaml' => 'api-docs.yaml',

        /*
        |--------------------------------------------------------------------------
        | Format to use for docs (json or yaml)
        |--------------------------------------------------------------------------
         */
        'format_to_use_for_docs' => env('SWAGGER_FORMAT', 'json'),

        /*
        |--------------------------------------------------------------------------
        | Absolute path to directory containing the swagger annotations are stored.
        |--------------------------------------------------------------------------
        */
        'annotations' => base_path('app'),

        /*
        |--------------------------------------------------------------------------
        | Absolute path to directories that you would like to exclude from swagger generation
        |--------------------------------------------------------------------------
        */
        'excludes' => [],

        /*
        |--------------------------------------------------------------------------
        | Edit to set the api's base path
        |--------------------------------------------------------------------------
        */
        'base' => env('L5_SWAGGER_BASE_PATH', null),

        /*
        |--------------------------------------------------------------------------
        | Edit to set the swagger version number
        |--------------------------------------------------------------------------
        */
        'swagger_version' => env('SWAGGER_VERSION', '3.0'),

        /*
        |--------------------------------------------------------------------------
        | Edit to trust the proxy's ip address - needed for AWS Load Balancer
        |--------------------------------------------------------------------------
        */
        'proxy' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | API security definitions. Will be generated into documentation file.
    |--------------------------------------------------------------------------
    */
    'securityDefinitions' => [
        'securitySchemes' => [
            'bearerAuth' => [
                'type' => 'http',
                'description' => 'Enter JWT Bearer token',
                'name' => 'Authorization',
                'in' => 'header',
                'scheme' => 'bearer',
                'bearerFormat' => 'JWT',
            ],
        ],
        'security' => [
            [
                'bearerAuth' => [],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Turn this off to remove swagger generation on production
    |--------------------------------------------------------------------------
    */
    'generate_always' => env('SWAGGER_GENERATE_ALWAYS', false),

    /*
    |--------------------------------------------------------------------------
    | Edit to set the swagger UI settings
    |--------------------------------------------------------------------------
    */
    'ui' => [
        'display' => [
            /*
            |--------------------------------------------------------------------------
            | Controls the default expansion setting for the operations and tags.
            | It can be 'list' (expands only the tags), 'full' (expands the tags and operations)
            | or 'none' (expands nothing).
            |--------------------------------------------------------------------------
            */
            'doc_expansion' => env('L5_SWAGGER_UI_DOC_EXPANSION', 'none'),

            /**
             * Controls how the API listing is displayed. It can be set to 'none' (default),
             * 'list' (shows operations for each resource), or 'full' (fully expanded: shows operations and their details).
             */
            'filter' => env('L5_SWAGGER_UI_FILTERS', true),
        ],

        'authorization' => [
            /*
            |--------------------------------------------------------------------------
            | If set to true, it persists authorization data and it would not be lost on browser close/refresh
            |--------------------------------------------------------------------------
            */
            'persist_authorization' => env('L5_SWAGGER_UI_PERSIST_AUTHORIZATION', false),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Constants which can be used in annotations
    |--------------------------------------------------------------------------
     */
    'constants' => [
        'L5_SWAGGER_CONST_HOST' => env('L5_SWAGGER_CONST_HOST', 'http://localhost'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Force HTTPS in Swagger UI
    |--------------------------------------------------------------------------
    */
    'use_https' => env('SWAGGER_USE_HTTPS', true),
    'force_https' => env('SWAGGER_USE_HTTPS', true),
];
