<?php

function ehPrimo($numero) {
    if ($numero < 2) {
        return false;
    }
    for ($i = 2; $i <= sqrt($numero); $i++) {
        if ($numero % $i == 0) {
            return false;
        }
    }
    return true;
}


if (isset($_POST['valor'])) {
    $limite = intval($_POST['valor']);
    echo "<h3>Números primos até $limite:</h3>";
    
    for ($i = 2; $i <= $limite; $i++) {
        if (ehPrimo($i)) {
            echo $i . " ";
        }
    }
}
?>


<form method="post">
    <label>Digite um número:</label>
    <input type="number" name="valor" required>
    <input type="submit" value="Mostrar primos">
</form>
