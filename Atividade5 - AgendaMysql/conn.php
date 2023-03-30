<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexao</title>
</head>
<body>
    <?php
    $LocalServ = "localhost";
    $usuario = "root";
    $senha = "";
    $nomeagendamento = "agenda";

    $conn = mysqli_connect($LocalServ,$usuario,$senha,$nomeagendamento);
    //if($conn){
    //  echo "Conectado!";
    // }
    
    
    ?>
</body>
</html>

