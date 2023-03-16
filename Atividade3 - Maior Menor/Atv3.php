<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maior e Menor</title>
</head>
<body>
    <form method="POST">
        <label>Indique o numero 1:</label><br><br>
        <input type="number" name="N1"><br><br>
        <label>Indique o numero 2:</label><br><br>
        <input type="number" name="N2"><br><br>
    <input type="submit" value="Enviar">
    </form>
    <?php
if (isset($_POST["N1"]) && isset($_POST["N2"]))
{
    $numb1 = $_POST["N1"];
    $numb2 = $_POST["N2"];
    if ($numb1 > $numb2){
        echo $numb2.", ".$numb1;
    }elseif ($numb1 == $numb2){
            echo "Os numeros sao iguais";
    }

    
    else{
        echo $numb1.", ".$numb2;
    }
}
?>
       
</body>
</html>