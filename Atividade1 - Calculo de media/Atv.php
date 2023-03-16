<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Situação academica</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<?php
$NomeAluno = $_POST["NomedoAluno"];
$Nota1 = $_POST["Nota1"];
$Nota2 = $_POST["Nota2"];
$Nota3 = $_POST["Nota3"];
$Nota4 = $_POST["Nota4"];
$Media = ($Nota1+$Nota2+$Nota3+$Nota4)/4;
?>
    <h1>
        <?php if ($Media >=7) 
         {
            echo "O Aluno ".$NomeAluno. " esta APROVADO";
        
         }
        ?>
    </h1>
    <h2>
        <?php
         if ($Media >=5 && $Media<7)
         {
            echo "O Aluno ".$NomeAluno. " esta de RECUPERAÇÂO";
          }  
        ?>
    </h2>
        <h3>
            <?php if ($Media <5){
                echo "O Aluno ".$NomeAluno. " esta REPROVADO";
            }           
            ?>
        </h3>
</body>
</html>