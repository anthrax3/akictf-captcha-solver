<?php

$chars = "0123456789abcdef";

echo "\$base64_digits = [\n";
foreach (str_split($chars) as $char) {
    $filename = __DIR__ . "/images/manually-recognized/$char.png";
    echo "    '$char' => '" . base64_encode(file_get_contents($filename)) . "',\n";
}
echo "];\n";
