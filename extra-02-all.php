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

$base64_digits = [
    '0' => 'iVBORw0KGgoAAAANSUhEUgAAAA8AAAAcCAIAAAAx9nIoAAAAfUlEQVQ4ja2USQ7AIAwDSdT/f9k9VKpSkw01PsJgnLAIgGUkImvTy2iJ2nEt0c8sAAqTSN3RyEKTDPsCx9tCtMBPEmmUppL+eduy9l4V3tT4kHYPwacftHU6iRyajG0kpqMMQ0mS6z5U5ZB3EpT2uToQJ+k8ewBnueXoZ7sBeUQ/K2Q8VLAAAAAASUVORK5CYII=',
    '1' => 'iVBORw0KGgoAAAANSUhEUgAAAA8AAAAcCAIAAAAx9nIoAAAAS0lEQVQ4jWP8//8/AzbAyMiIzIUoYyGoDhmwEKkOYQUux2A3m7CRMHczEWkqBGBRjcdtLGjq8JvNQqQ6hEuIDxOKfTmqelT1CFUNALcuHi6WJKDKAAAAAElFTkSuQmCC',
    '2' => 'iVBORw0KGgoAAAANSUhEUgAAAA8AAAAcCAIAAAAx9nIoAAAAc0lEQVQ4jdWSwQ7AIAhDwfj/v4wHE53QIpclW0/EPGoJqJnJQ6oqQYvRXSHONzjvS0OdFpGW/RvUGTRrN0zPzUCSenSc+2t03O5rScyM0vDIqt5zJ5hm1wvoiK5lezpBaRKmg86ND/qKbrqC8leif9x31AD5MDwaeJTYsgAAAABJRU5ErkJggg==',
    '3' => 'iVBORw0KGgoAAAANSUhEUgAAAA8AAAAcCAIAAAAx9nIoAAAAeElEQVQ4jc2SwQ7AIAhDxez/f5kdZlgGtUDiYVx91FIYqjrKNevor2ghU4pIVTuiqlp18ljAtBM2t4DeoYAmqKfjZK4u/mz9rXNaDZ/tpE7ObT7+dvQGWd5pbfOG+SRTura5k4E/LG244ajiffN19jLp1ZsJ8WDMDdSjMzN5EndmAAAAAElFTkSuQmCC',
    '4' => 'iVBORw0KGgoAAAANSUhEUgAAAA8AAAAcCAIAAAAx9nIoAAAAZklEQVQ4jdXTOw6AMAwDUCf3v7NZkJCCY1IVBjxW1us/SEIlIsoIyZTVLrp9h117we7gbdvAe7aHnS1v7Wo/wq3dPYecw9ru4LM9hIVtYAA5h6vt4R8nzM7Kcb3057upFtpfrgTAAZE3HjLlAzSFAAAAAElFTkSuQmCC',
    '5' => 'iVBORw0KGgoAAAANSUhEUgAAAA8AAAAcCAIAAAAx9nIoAAAAZ0lEQVQ4jc2RUQ7AIAxCZen9r8w+TBrDtgbNssmfisizjSTJ5ukwfbu543b3iXuf3m9QAhiXCW1lA+j3J5oA+JhyHKTgxtWx3kRSfpy8UM5nS0ChkBeLz9Zjq4kpkq67V0A2KVjTcwK0Nic1LbfAwQAAAABJRU5ErkJggg==',
    '6' => 'iVBORw0KGgoAAAANSUhEUgAAAA8AAAAcCAIAAAAx9nIoAAAAdElEQVQ4je2UwQ7AIAhDqfH/f7k7LCHKANHtuN6Mz1KUCJIyC4B4IomRjjhVq6MTXVFPjDWk7nbXw7Suy70kLYoR0nmMBa0CYMs+nSJvklndvSRv6fXrjI1+d4M/rUoGuEl6weak/5aR/VHuytzavyrJcGMXL9M2K9haRtoAAAAASUVORK5CYII=',
    '7' => 'iVBORw0KGgoAAAANSUhEUgAAAA8AAAAcCAIAAAAx9nIoAAAAaElEQVQ4jc2SOQ7AMAgElyj///KmSywOA8JFqEejARskUZ6rjv6KlnRLEam6V7RdsqOVuOcmeegmNgPAXc9A1O2KQ9oVt8fZ0ma8TF6y6mYvH12j5FZbDUr2GTO3GvsUH51mnCtxf9ID/xckKwDcwcwAAAAASUVORK5CYII=',
    '8' => 'iVBORw0KGgoAAAANSUhEUgAAAA8AAAAcCAIAAAAx9nIoAAAAgElEQVQ4jc2TUQ6AMAhDx+L9r1w/XDYEVjDRRL6W+CjdqAKgqRKR5moysk4RZ3sAGPmso1wHlzD2Op9mJgc0qV/T+h3syurbAdDnKUVvTioTFs1TNb6+kKqdBMuJ77FevaS+T75L3f9lTtgfPgjtmz92kKq6k+e3rMuLRkmwLuwEg75f62y4dVwAAAAASUVORK5CYII=',
    '9' => 'iVBORw0KGgoAAAANSUhEUgAAAA8AAAAcCAIAAAAx9nIoAAAAfElEQVQ4jc2UwQ7AIAhDLfH/f5kdXNBAx3DbYT0t+locRKGqbRGAFmQM5hfjnEeKqK9SkVxF0BRCGxcNPDs6T7r6f5Xs/9IfTMfkOkZoI0hzt09SN8hWBSR3Z2ytK9258yKvO/g8m9MA4iziSs+3V80XYu8ktxqdLdE2hAM7HTwkEXuYnAAAAABJRU5ErkJggg==',
    'a' => 'iVBORw0KGgoAAAANSUhEUgAAAA8AAAAcCAIAAAAx9nIoAAAAc0lEQVQ4jdWUsRLAIAhDwfP/fzkd7IBIA1yvQzPqI4YMKgApa9TRH9OzyKmqiGirwc17GYS6TeveABq0vO3EPeU2mSFkh+3AIGie5ClDQJO+NzrllvoNnsZ2b98JQZMkvM0ktwvp6aScj/8TYu+uBslzHl4qQTYs6BTk5AAAAABJRU5ErkJggg==',
    'b' => 'iVBORw0KGgoAAAANSUhEUgAAAA8AAAAcCAIAAAAx9nIoAAAAWElEQVQ4je2SOw4AIAhDxXj/Kz83QxT8xEQd7FraAK0AIhIUgOAgesSfnkTyCDuENotOOl2uwfkr9Xr6XMN7q4Na/E7yd6cH/67aN/Yuglp5toPLPTEFQAaEeyck6z7jUQAAAABJRU5ErkJggg==',
    'c' => 'iVBORw0KGgoAAAANSUhEUgAAAA8AAAAcCAIAAAAx9nIoAAAAX0lEQVQ4je2TwQrAMAxCa9n//7I79BBITbGll8E8hocYYkCy2eo++tNSzzwCIFGSSNep0Oy95oaOckvjOeSGN0lNV8XsZoygfX2Z9h9Ze1ed2UsSjb3fwaCdXfPvrCO9S6AhNfgwKWIAAAAASUVORK5CYII=',
    'd' => 'iVBORw0KGgoAAAANSUhEUgAAAA8AAAAcCAIAAAAx9nIoAAAAZ0lEQVQ4je1SQQ7AIAijy/7/5e6wxTCELlwWD/akUMBaQNIkAIzzoakBmz3j9Bf/tWaWWEFSGBRSHy8J07JxNXoqS6R6kPJeDLGDWsY6zv/Jjla3euviB+VitreqVdAARuNZ0J3y8QsaKDAUycWY/gAAAABJRU5ErkJggg==',
    'e' => 'iVBORw0KGgoAAAANSUhEUgAAAA8AAAAcCAIAAAAx9nIoAAAAaklEQVQ4je2SOw7AMAhDcdT7X9kdEjWUkNRD06lsSM9gPiBpchQd/ek0jpADGKHrJvDXSVGv6fQarVF01KrvEZ01THbiJwk/t3PfsdebtXfSq69Ian875exnABhJ3UyrLQq6E0Vw8/0oOAG8VDAdIWaDcwAAAABJRU5ErkJggg==',
    'f' => 'iVBORw0KGgoAAAANSUhEUgAAAA8AAAAcCAIAAAAx9nIoAAAAVElEQVQ4jWP8//8/AzbAyMiIKchEvFLsqnEpxWk2LsBC0GBkj5FmNgHVaCFGVbMJ2EVVQJLZpLmbEc1stNihYwiOqh4+qtHzPFYAT2oEVEPUwVMiAM7QGDSriFQVAAAAAElFTkSuQmCC',
];

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
            $digit = imagecreatefromstring(base64_decode($base64_digits[$digitname]));
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
