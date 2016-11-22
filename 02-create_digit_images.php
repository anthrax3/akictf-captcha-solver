<?php

foreach (glob(__DIR__ . '/images/sequence/*.png') as $i => $filename) {
    $src = imagecreatefromstring(file_get_contents($filename));
    for ($d = 0; $d < 16; ++$d) {
        $dst = imagecreatetruecolor(15, 28);
        $width = 15;
        $height = 28;
        $margin = 4;
        for ($h = 0; $h < $height; ++$h) {
            for ($w = 0; $w < $width; ++$w) {
                $x = 8 + $d * ($width + $margin) + $w;
                $y = 8 + $h;
                $color = imagecolorat($src, $x, $y) === 0x000000 ? 0x000000 : 0xffffff;
                imagesetpixel($dst, $w, $h, $color);
            }
        }
        imagepng($dst, __DIR__ . '/images/digit/' . $i . '-' . $d . '.png');
        imagedestroy($dst);
    }
    imagedestroy($src);
}
