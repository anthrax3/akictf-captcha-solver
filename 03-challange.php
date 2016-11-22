<?php

function argmin(array $values)
{
    $argmin = $min = null;
    foreach ($values as $key => $value) {
        if ($min === null || $min > $value) {
            $argmin = $key;
            $min = $value;
        }
    }
    return $argmin;
}

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => 'http://q34.ctf.katsudon.org/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_COOKIEFILE => true,
    CURLOPT_FOLLOWLOCATION => true,
]);
$html = curl_exec($ch);

while (true) {

    echo "\n\n---------------------\n\n";
    echo $html;

    $dom = new DOMDocument;
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $url = $xpath->evaluate('concat("http://q34.ctf.katsudon.org", //img/@src)');
    $id = $xpath->evaluate('string(//input[@name="id"]/@value)');

    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPGET => true,
    ]);
    $binary = curl_exec($ch);

    if ($id === '' || $binary === false) {
        break;
    }

    $unknown = imagecreatefromstring($binary);
    $key = '';

    for ($d = 0; $d < 16; ++$d) {
        $width = 15;
        $height = 28;
        $margin = 4;
        $distances = [];
        for ($r = 0; $r < 16; ++$r) {
            $digitname = base_convert($r, 10, 16);
            $filename = __DIR__ . '/images/manually-recognized/' . $digitname . '.png';
            $digit = imagecreatefrompng($filename);
            $distances[$digitname] = 0;
            for ($h = 0; $h < $height; ++$h) {
                for ($w = 0; $w < $width; ++$w) {
                    $x = 8 + $d * ($width + $margin) + $w;
                    $y = 8 + $h;
                    $ucolor = imagecolorat($unknown, $x, $y) === 0x000000 ? 0x000000 : 0xffffff;
                    $dcolor = imagecolorat($digit, $w, $h) === 0x000000 ? 0x000000 : 0xffffff;
                    $distances[$digitname] += (int)($ucolor !== $dcolor);
                }
            }
            imagedestroy($digit);
        }
        $key .= argmin($distances);
    }

    curl_setopt_array($ch, [
        CURLOPT_URL => 'http://q34.ctf.katsudon.org/challenge',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query(compact('id', 'key'), '', '&'),
    ]);
    $html = curl_exec($ch);
}
