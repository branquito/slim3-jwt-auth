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
  'host' => '127.0.0.1',
  'username' => 'user',
  'password' => 'pass',
  'database' => 'jwt_slim3',
  'charset' => 'utf8',
  'collation' => 'utf8_unicode_ci'
]);

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container->get('settings')->get('db'));

$capsule->setAsGlobal();
$capsule->bootEloquent();

require_once __DIR__ . '/../routes/web.php';
