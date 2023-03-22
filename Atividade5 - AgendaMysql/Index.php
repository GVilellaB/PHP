<?php
include('conn.php');
if (isset($_POST["btnprocurar"])) {
  $valor = $_POST["txtbuscar"];
  $sqlselect = "SELECT * FROM tab_agendamentos WHERE NomePaciente LIKE '$valor%'";
} else {
  $sqlselect = "SELECT ID,DataHora,NomePaciente,Convenio,DetalhesPaciente FROM tab_agendamentos";
}
$resselect = mysqli_query($conn, $sqlselect);
// UPDATE `tab_agendamentos` SET `DataHora`='$DiaHora',`NomePaciente`='$NomePaciente',`Convenio`='$convenio',`DetalhesPaciente`='$DetAgenda' WHERE 1

if (isset($_POST["Agendar"])) {
  if (!empty($_POST["diahora"]) && !empty($_POST["detagenda"]) && !empty($_POST["nomepac"]) && !empty($_POST["conv"])) {
    $DiaHora = $_POST["diahora"];
    $NomePaciente = $_POST["nomepac"];
    $convenio = $_POST["conv"];
    $DetAgenda = $_POST["detagenda"];
    $id = $_POST["ID"];
    $sql = "INSERT INTO tab_agendamentos(ID,DataHora,NomePaciente,Convenio,DetalhesPaciente) VALUES('$id','$DiaHora','$NomePaciente','$convenio','$DetAgenda')";

    if (mysqli_query($conn, $sql)) {
      echo "<script>alert('Registro Efetuado')</script>";
      header('location:Index.php');
    } else {
      echo "<script>alert('ERRO')</script>";
    }
  } else {
    echo "<script>alert('Preencha todos os campos')</script>";
  }
}elseif (isset($_GET["id"])){
  $IDdelete = $_GET["id"];
  $sqldelete = "DELETE FROM tab_agendamentos WHERE ID='$IDdelete'";
  if (mysqli_query($conn, $sqldelete)) {
    echo "<script>alert('Registro Deletado')</script>";
    header('location:Index.php');
  } else {
    echo "<script>alert('ERRO')</script>";
  }
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
      <form class="d-flex" role="search" method="POST">
        <input class="form-control me-2 border border-danger" type="search " name="txtbuscar" placeholder="Agendamentos" aria-label="Search">
        <button class="btn btn btn-danger" type="submit" name="btnprocurar">Procurar</button>
      </form>
    </div>
  </nav>
  <div class="p-3 text-center text-danger-emphasis rounded-8">
    <h1>Agendamendo de consultas</h1>
  </div>
  <div class="container" style="margin-top: 30px;">
    <Form method="POST">
      <div class="mb-3">
        <label class="form-label text-light">Nome do Paciente</label>
        <input type="text" class="form-control border border-danger" name="nomepac" rows="3">
      </div>

      <div class="mb-3">
        <label class="form-label text-light">Convenio</label>
        <select class="form-select border border-danger" aria-label="Default select example" name="conv">
          <option selected>Convenios</option>
          <option name="Unimed" value="Unimed">Unimed</option>
          <option name="Policlin" value="Policlin">Policlin</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label text-light">Detalhes do agendamento</label>
        <textarea class="form-control border border-danger" name="detagenda" rows="3"></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label text-light">Data Agendada</label><br>
        <input type="datetime-local" name="diahora" class="date border border-danger">
      </div>
      <input type="submit" value="Agendar" name="Agendar" class="btn btn-danger"><br>
    </Form>
    <div class="container col-8 mt-4">
      <div class="row">
        <?php
        while ($linha = mysqli_fetch_assoc($resselect)) {
        ?>
          <div class="col-sm-15 mb-3 mb-sm-0">
            <div class="card text-bg-dark border-danger mb-3">
              <div class="card-body">
                <h5 class="card-title"><?php echo $linha["DataHora"] ?></h5>
                <p class="card-text">Nome do Paciente: <?php echo $linha["NomePaciente"] ?></p>
                <p class="card-text">Convenio: <?php echo $linha["Convenio"] ?></p>
                <p class="card-text">Observações:<br><?php echo $linha["DetalhesPaciente"] ?></p>
                <p class="card-text">ID: <?php echo $linha["ID"] ?></p>
                <a href="editar.php?ID=<?php echo $linha["ID"] ?>" class="btn btn-danger" name="Editar">Editar</a>
                <a href="Index.php?id=<?php echo $linha["ID"] ?>" class="btn btn-danger" name="Deletar">Desmarcar</a>
                
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>