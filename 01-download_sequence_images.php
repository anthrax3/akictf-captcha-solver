<?php

for ($t = 0; $t < 200; ++$t) {
    $dom = new DOMDocument;
    @$dom->loadHTML(file_get_contents('http://q34.ctf.katsudon.org/'));
    $xpath = new DOMXPath($dom);
    $url = $xpath->evaluate('concat("http://q34.ctf.katsudon.org", //img/@src)');
    if (false === $binary = file_get_contents($url)) {
        continue;
    }
    file_put_contents(__DIR__ . '/images/sequence/' . md5($binary) . '.png', $binary);
}
