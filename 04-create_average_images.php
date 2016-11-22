<?php

$average_vectors = json_decode(file_get_contents(__DIR__ . '/vectors/average.json'));

foreach ($average_vectors as $i => $vector) {
    $width = 15;
    $height = 28;
    $img = imagecreatetruecolor(15, 28);
    foreach ($vector as $index => $value) {
        $x = $index % $width;
        $y = (int)($index / $width);
        $value = $vector[$index];
        $color = $value ? 0x000000 : 0xffffff;
        imagesetpixel($img, $x, $y, $color);
    }
    imagepng($img, __DIR__ . '/images/average/' . $i . '.png');
}
