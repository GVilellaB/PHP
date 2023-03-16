<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabuada</title>
</head>
<body>
    <Form method="POST">
        <label>Indique o numero para a tabuada:</label><br><br>
        <input type="number" name="num">
        <input type="submit" value="Gerar tabuada">
    </Form>
    <?php
     include('functions.php');
     define("NUMEROS",[0,1,2,3,4,5,6,7,8,9,10]);
     $i = 0;
        if (isset($_POST["num"])){
            $numero = $_POST["num"];
            echo tabuada($numero,$i);
        }
    ?>    
</body>
</html>