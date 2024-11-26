<?php

/**
 * Returns the importmap for this application.
 *
 * - "path" is a path inside the asset mapper system. Use the
 *     "debug:asset-map" command to see the full list of paths.
 *
 * - "entrypoint" (JavaScript only) set to true for any module that will
 *     be used as an "entrypoint" (and passed to the importmap() Twig function).
 *
 * The "importmap:require" command can be used to add new entries to this file.
 */
return [
    'app' => [
        'path' => './assets/app.js',
        'entrypoint' => true,
    ],
    '@hotwired/stimulus' => [
        'version' => '3.2.2',
    ],
    '@symfony/stimulus-bundle' => [
        'path' => './vendor/symfony/stimulus-bundle/assets/dist/loader.js',
    ],
    '@hotwired/turbo' => [
        'version' => '7.3.0',
    ],
    'tom-select' => [
        'version' => '2.4.1',
    ],
    '@orchidjs/sifter' => [
        'version' => '1.1.0',
    ],
    '@orchidjs/unicode-variants' => [
        'version' => '1.1.2',
    ],
    'tom-select/dist/css/tom-select.default.min.css' => [
        'version' => '2.4.1',
        'type' => 'css',
    ],
    'vue' => [
        'version' => '3.5.13',
        'package_specifier' => 'vue/dist/vue.esm-bundler.js',
    ],
    '@vue/runtime-dom' => [
        'version' => '3.5.13',
    ],
    '@vue/compiler-dom' => [
        'version' => '3.5.13',
    ],
    '@vue/shared' => [
        'version' => '3.5.13',
    ],
    '@vue/runtime-core' => [
        'version' => '3.5.13',
    ],
    '@vue/compiler-core' => [
        'version' => '3.5.13',
    ],
    '@vue/reactivity' => [
        'version' => '3.5.13',
    ],
    '@symfony/ux-vue' => [
        'path' => './vendor/symfony/ux-vue/assets/dist/loader.js',
    ],
];
