<?php

namespace DelfiNico\Guest;

class GuestEndpoints {
    private $controller;
    private $routes;

    public function __construct($controller)
    {
        $this->controller = $controller;
        $this->init();
        add_action('rest_api_init', [$this, 'register_routes']);
    }

    public function init(): void
    {
        $this->routes[] = [
            'namespace'=>'guest',
            'route'=>'/',
            'args'=> [
                'methods'  => 'GET',
                'callback' => [$this->controller, 'search_guest'],
                'permission_callback'   => '__return_true',
            ]
        ];

        $this->routes[] = [
            'namespace'=>'guest',
            'route'=>'/',
            'args'=> [
                'methods'  => 'UPDATE',
                'callback' => [$this->controller,'update_guest'],
                'permission_callback'   => '__return_true',
            ]
        ];

        $this->routes[] = [
            'namespace'=>'check-for-change',
            'route'=>'/check-for-change/(?P<search_id>\S+)',
            'args'=> [
                'methods'  => 'GET',
                'callback' => [$this->controller,'check_for_change'],
                'permission_callback'   => '__return_true',
            ]
        ];
    }
    public function register_routes(): void
    {
        foreach($this->routes as $route) {
            register_rest_route($route['namespace'], $route['route'], $route['args']);
        }
    }
}