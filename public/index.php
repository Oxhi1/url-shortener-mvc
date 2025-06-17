<?php
// Hataları göster
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Yapılandırma dosyasını al
require_once '../config.php';

// Otomatik sınıf yükleyici
spl_autoload_register(function ($class) {
    $paths = [
        '../app/Controllers/',
        '../app/Models/',
        '../app/core/'
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Uygulamayı başlat
$app = new App();
