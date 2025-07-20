<?php
echo "Digite a temperatura em C: ";
$celsius = 12;

$fahrenheit = ($celsius * 9/5) +32;

echo "$celsius C equivalem a" . number_format($fahrenheit);

?>