<?php
require '../vendor/autoload.php';
new Yoop\Kernel(); // On doit charger le .env

header('Content-Type: text/css; charset=UTF-8');
header('Cache-Control: max-age=31536000'); // 1 an

$baseDir = __DIR__ . '/assets/css/';
$files = isset($_GET['files']) ? explode(' ', $_GET['files']) : [];
$output = '';

foreach ($files as $file) {
    $filePath = realpath($baseDir . $file);

    if ($filePath && file_exists($filePath)) {
        $css = file_get_contents($filePath);
        
        // Minification simple (supprime les commentaires et espaces inutiles)
        $css = preg_replace('!/\*.*?\*/!s', '', $css);
        $css = preg_replace('/\n\s*\n/', "\n", $css);
        $css = preg_replace('/[\n\r \t]/', ' ', $css);
        $css = preg_replace('/ +/', ' ', $css);
        $css = preg_replace('/ ?([,:;{}]) ?/', '$1', $css);

        $output .= $css;
    }
}

$helper = new App\Service\HelperController();
echo str_replace("DEFAULT_CTF_FLAG=d790ee4fcdb3d0e0568fda08e74ac4401d465043", "Bien joué le flag est : ".$helper->flag(), $output);