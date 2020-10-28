<?php

require "../vendor/autoload.php";




use App\Routes\Router;

// ========================================================================================================

// Meta tags SEO
$title = null;
$description = null;

// Keywords

// Google

// Open Graph protocol

// Geo Location

// Language

// Layout


$router = new Router(dirname(__DIR__, 1) . '/src/pages');
$router->get("/", "home", "home")
    ->get("/signup", "signup", "signup")
    ->get("/signin", "signin", "signin")
    ->get("/upload", "upload", "upload")
    ->post("/auth", "auth", "auth")
    ->post("/processing", "processing", "processing")
    ->run();