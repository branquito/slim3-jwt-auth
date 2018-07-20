<?php

require_once __DIR__ . '/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__ . '/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}


$app = new Jenssegers\Lean\App();
$container = $app->getContainer();

$container->get('settings')->set('displayErrorDetails', true);
$container->get('settings')->set('db', [
  'driver' => 'mysql',
  'host' => env('DB_HOST'),
  'username' => env('DB_USER'),
  'password' => env('DB_PASSWORD'),
  'database' => env('DB_NAME'),
  'charset' => 'utf8',
  'collation' => 'utf8_unicode_ci'
]);

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container->get('settings')->get('db'));

$capsule->setAsGlobal();
$capsule->bootEloquent();

require_once __DIR__ . '/../routes/web.php';
