<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
try {
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $input = new Symfony\Component\Console\Input\ArgvInput(['artisan','list','-vvv']);
    $output = new Symfony\Component\Console\Output\ConsoleOutput();
    $status = $kernel->handle($input, $output);
    echo "STATUS:" . $status . PHP_EOL;
} catch (Throwable $e) {
    echo get_class($e) . ': ' . $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
}
