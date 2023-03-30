<?php
session_start();
include('conn.php');
if (empty($_SESSION["usuario"])) {
    header('location:login.php');
}
$sqlselect = "SELECT * FROM tab_agendamentos";
$resselect = mysqli_query($conn, $sqlselect);

if (!empty($_GET["ID"])) {
    $id = $_GET["ID"];
    $sql = "SELECT * FROM tab_agendamentos WHERE ID='$id'";
    $result = mysqli_query($conn, $sql);
    $vlconv = -1;
    $vlprio = -1;
    if (mysqli_num_rows($result) > 0) {
        while ($linha = mysqli_fetch_assoc($result)) {
            $id = $linha["ID"];
            $Datahora = $linha["DataHora"];
            $nome = $linha["NomePaciente"];
            $conv = $linha["Convenio"];
            $detpac = $linha["DetalhesPaciente"];
            $pri = $linha["Prioridade"];
        }
        if ($conv == "Unimed") {
            $vlconv = 1;
        }
        if ($conv == "Policlin") {
            $vlconv = 2;
        }
        if ($pri == "Baixa") {
            $vlprio = 1;
        }
        if ($pri == "Media") {
            $vlprio = 2;
        }if ($pri == "Alta") {
            $vlprio = 3;
        }
    } else {
        header('location:Index.php');
    }
}

if (isset($_GET["Salvar"])) {
    if (!empty($_GET["ID"]) && !empty($_GET["diahora"])  && !empty($_GET["nomepac"]) && !empty($_GET["conv"]) && !empty($_GET["detagenda"])&& !empty($_GET["prio"])) {
        $id = $_GET["ID"];
        $diahora = $_GET["diahora"];
        $nome = $_GET["nomepac"];
        $conv = $_GET["conv"];
        $pri = $_GET["prio"];
        $detagenda = $_GET["detagenda"];
        $sqledit = "UPDATE tab_agendamentos SET DataHora='$diahora',NomePaciente='$nome',Convenio='$conv',
        DetalhesPaciente='$detagenda',Prioridade='$pri' WHERE ID ='$id'";

        if (mysqli_query($conn, $sqledit)) {
            header('location:Index.php?msg=1');
        } else {
            echo "<script>alert('ERRO')</script>";
        }
    } else {
        echo "<script>alert('Preencha todos os campos')</script>";
    }
}
if (isset($_GET["Cancelar"])) {
    header('location:Index.php');
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agendamento Medico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body style="background-color: black; background: url(https://images.wallpaperscraft.com/image/single/stars_space_galaxy_117958_1280x720.jpg)">
    <nav class="navbar navbar bg-dark">
        <div class="container-fluid">
            <h2><a class="navbar-brand text-danger-emphasis">Agenda</a></h2>
            <form class="d-flex" role="search">
                <input class="form-control me-2 border border-danger" type="search " name="txtbuscar" placeholder="Agendamentos" aria-label="Search">
                <button class="btn btn btn-danger" type="submit" name="btnprocurar">Procurar</button>
            </form>
        </div>
    </nav>
    <div class="p-3 text-center text-danger-emphasis rounded-8">
        <h1>Agendamendo de consultas</h1>
    </div>
    <div class="container" style="margin-top: 30px;">
        <div class="container col-8 mt-4">
            <div class="row">
                <Form>

                    <div class="col-sm-15 mb-3 mb-sm-0">
                        <div class="card text-bg-dark border-danger mb-3">
                            <div class="card-body">

                                <h5 class="card-title">Data e Hora do agendamento:</h5>
                                <input type="datetime-local" class="date border border-danger" name="diahora" value="<?= date("Y-m-d\TH:i") ?>"><br>
                                <p class="card-text">Nome do Paciente: </p>
                                <input type="text" class="form-control border border-danger" name="nomepac" value="<?php echo $nome ?>"><br>

                                <p class="card-text">Convenio: </p>
                                <select class="form-select border border-danger" name="conv">
                                    <option>Convenios</option>
                                    <option name="Unimed" value="Unimed" <?php if ($vlconv == 1) echo 'selected' ?>>Unimed</option>
                                    <option name="Policlin" value="Policlin" <?php if ($vlconv == 2) echo 'selected' ?>>Policlin</option>
                                </select><br>

                                <p class="card-text">Observações:</p>
                                <input type="text" class="form-control border border-danger" name="detagenda" value="<?php echo $detpac ?>"><br>

                                <p class="card-text">ID:</p>
                                <input type="text" class="form-control border border-danger" name="ID" readonly value=<?= $id ?>><br>
                                <div class="mb-2 col-3">
                                <p class="card-text">Prioridade : </p>
                                <select class="form-select border border-danger" name="prio">
                                    <option>Prioridade:</option>
                                    <option name="Baixa" value="Baixa" <?php if ($vlprio == 1) echo 'selected' ?>>Baixa</option>
                                    <option name="Media" value="Media" <?php if ($vlprio == 2) echo 'selected' ?>>Media</option>
                                    <option name="Alta" value="Alta" <?php if ($vlprio == 3) echo 'selected' ?>>Alta</option>
                                </select></div><br>
                                
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Salvar
                                </button>

                                <!-- Modal -->
                                <div class="modal fade text-dark" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Atualização</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Salvar alterações?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                                                <input type="submit" class="btn btn-danger" value="Salvar" name="Salvar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-danger" value="Cancelar" name="Cancelar">
                            </div>
                        </div>
                    </div>

                </Form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>
</html>
