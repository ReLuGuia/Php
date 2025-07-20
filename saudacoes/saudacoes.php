<?php
date_default_timezone_set("America/Sao_Paulo");
$hora = date("H");

if ($hora >= 5 && $hora < 12) {
    $mensagem = "Bom dia";
} elseif ($hora >= 12 && $hora < 18) {
    $mensagem = "Boa tarde";
} else {
    $mensagem = "Boa noite";
}

echo "<h3>$mensagem!</h3>";
echo "Agora são " . date("H:i") . ".";
?>
