<?php

$publicPath = __DIR__.DIRECTORY_SEPARATOR.'public';
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/');
$requestedFile = realpath($publicPath.$uri);

if ($uri !== '/'
    && $requestedFile !== false
    && str_starts_with($requestedFile, realpath($publicPath))
    && is_file($requestedFile)) {
    return false;
}

require $publicPath.DIRECTORY_SEPARATOR.'index.php';
