<?php

ini_set('memory_limit', '2G');

$source_vectors = [];
foreach (glob(__DIR__ . '/images/sequence/*.png') as $filename) {
    $src = imagecreatefromstring(file_get_contents($filename));
    for ($d = 0; $d < 16; ++$d) {
        $pixels = [];
        $width = 15;
        $height = 28;
        $margin = 4;
        for ($h = 0; $h < $height; ++$h) {
            for ($w = 0; $w < $width; ++$w) {
                $x = 8 + $d * ($width + $margin) + $w;
                $y = 8 + $h;
                $color = imagecolorat($src, $x, $y);
                $pixels[] = (int)($color === 0x000000);
            }
        }
        $source_vectors[] = $pixels;
    }
    imagedestroy($src);
}

file_put_contents(__DIR__ . '/vectors/source.json', json_encode($source_vectors));
