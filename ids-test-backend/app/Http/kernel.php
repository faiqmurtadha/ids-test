protected $middleware = [
    // ...
    \Fruitcake\Cors\HandleCors::class,
];

// atau

protected $middlewareGroups = [
    'web' => [
        // ...
        \Fruitcake\Cors\HandleCors::class,
    ],

    'api' => [
        // ...
        \Fruitcake\Cors\HandleCors::class,
    ],
];
