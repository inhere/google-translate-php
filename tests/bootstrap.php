<?php

// library's vendor
if (file_exists(dirname(__DIR__) . '/vendor/autoload.php')) {
    require dirname(__DIR__) . '/vendor/autoload.php';
    // application's vendor
} elseif (file_exists(dirname(__DIR__, 4) . '/vendor/autoload.php')) {
    /** @var \Composer\Autoload\ClassLoader $loader */
    $loader = require dirname(__DIR__, 4) . '/vendor/autoload.php';

    // need load testing psr4 config map
    $libDir   = dirname(__DIR__);
    $jsonFile = $libDir . '/composer.json';
    $jsonData = json_decode(file_get_contents($jsonFile), true);

    foreach ($jsonData['autoload-dev']['psr-4'] as $prefix => $dir) {
        $loader->addPsr4($prefix, $libDir . '/' . $dir);
    }
} else {
    exit('Please run "composer install" to install the dependencies' . PHP_EOL);
}

//\Swoole\Runtime::enableCoroutine();
//$application = new \Swoft\Test\TestApplication();
//$application->setBeanFile(__DIR__ . '/testing/bean.php');
//$application->run();
