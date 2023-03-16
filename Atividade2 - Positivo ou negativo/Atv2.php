<?php
if (isset($_POST["N1"])){
    $numb1 = $_POST["N1"];
    if ($numb1 < 0){
        echo "O numero ".$numb1." é negativo";
    }elseif ($numb1 == 0){
        echo "O numero ".$numb1." é igual a zero";
    }else{
        echo "O numero ".$numb1." é positivo";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Positivo ou negativo</title>
</head>
<body>
    <form method="POST">
        <label>Indique o numero:</label><br><br>
        <input type="number" name="N1">
    <input type="submit" value="Enviar">
    </form>
       
</body>
</html>