<?php
echo "Digite a temperatura em C: ";
$celsius = trim (fgets(STDIN));

$celsius = floatval($celsius);

$fahrenheit = ($celsius * 9/5) +32;

echo "$celsius C equivalem a" . number_format($fahrenheit);