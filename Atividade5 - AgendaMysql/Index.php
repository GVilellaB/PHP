<?php
session_start();
if (empty($_SESSION["usuario"])) {
  header('location:login.php');
}
include('conn.php');
if (isset($_GET["btnprocurar"])) {
  $valor = $_GET["txtbuscar"];
  $sqlselect = "SELECT * FROM tab_agendamentos WHERE NomePaciente LIKE '$valor%'";
} else {
  $id = $_SESSION["ID"];
  $sqlselect = "SELECT t.ID, t.DataHora, t.NomePaciente, t.Convenio, 
  t.DetalhesPaciente, t.id_usuario,t.Prioridade, u.usuario FROM tab_agendamentos AS t
  INNER JOIN tab_usuarios AS u
  WHERE t.id_usuario = u.id and t.id_usuario = '$id'";
}
$resselect = mysqli_query($conn, $sqlselect);
// UPDATE `tab_agendamentos` SET `DataHora`='$DiaHora',`NomePaciente`='$NomePaciente',`Convenio`='$convenio',`DetalhesPaciente`='$DetAgenda' WHERE 1

if (isset($_GET["Agendar"])) {
  if (!empty($_GET["diahora"]) && !empty($_GET["detagenda"]) && !empty($_GET["nomepac"]) && !empty($_GET["conv"])&& !empty($_GET["prio"])) {
    $DiaHora = $_GET["diahora"];
    $NomePaciente = $_GET["nomepac"];
    $convenio = $_GET["conv"];
    $DetAgenda = $_GET["detagenda"];
    $id = $_GET["ID"];
    $idus = $_SESSION["ID"];
    $pri = $_GET["prio"];
    $sql = "INSERT INTO tab_agendamentos(ID,DataHora,NomePaciente,Convenio,DetalhesPaciente,id_usuario,Prioridade)
     VALUES('$id','$DiaHora','$NomePaciente','$convenio','$DetAgenda','$idus','$pri')";

    if (mysqli_query($conn, $sql)) {

      header('location:Index.php?msg=3');
    } else {
      echo "<script>alert('ERRO')</script>";
    }
  } else {
    echo "<script>alert('Preencha todos os campos')</script>";
  }
} elseif (isset($_GET["id"])) {
  $IDdelete = $_GET["id"];
  $sqldelete = "DELETE FROM tab_agendamentos WHERE ID='$IDdelete'";
  if (mysqli_query($conn, $sqldelete)) {
    header('location:Index.php?msg=2');
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
      <form class="d-flex col-3" role="search">
        <input class="form-control me-2 border border-danger" type="search " name="txtbuscar" placeholder="Agendamentos" aria-label="Search">
        <button class="btn btn btn-danger" type="submit" name="btnprocurar">Procurar</button>
      </form>
     
      <div class="text-danger">
        <?= $_SESSION["usuario"] ?>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalsair">
          Sair
        </button>
      </div>
      <!-- Modal -->
      <div class="modal fade text-dark" id="exampleModalsair" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Logout</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Deseja realmente sair?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
              <a href="sair.php" class="btn btn-danger">Sair</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <?php
  if (isset($_GET["msg"]) && $_GET["msg"] == 1) {
  ?><div id="liveAlertPlaceholder"></div>
    <script>
      const alertPlaceholder1 = document.getElementById('liveAlertPlaceholder')

      const alert1 = (message, type) => {
        const wrapper1 = document.createElement('div')
        wrapper1.innerHTML = [
          `<div class="alert alert-dismissible d-flex align-items-center alert alert-primary" role="alert">`,
          '<svg xmlns="http://www.w3.org/2000/svg" width="16" heigth="16" class="info-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Info:">',
          '<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>',
          '</svg>',
          `<div>${message}</div>`,
          '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
          '</div>'
        ].join('')

        alertPlaceholder1.append(wrapper1)
      }
      alert1('Registro Atualizado', 'success')
    </script>
  <?php
  }
  if (isset($_GET["msg"]) && $_GET["msg"] == 2) {
  ?>
    <div id="liveAlertPlaceholder"></div>
    <script>
      const alertPlaceholder2 = document.getElementById('liveAlertPlaceholder')

      const alert2 = (message, type) => {
        const wrapper2 = document.createElement('div')
        wrapper2.innerHTML = [
          `<div class="alert alert-dismissible d-flex align-items-center alert alert-danger" role="alert">`,
          '<svg xmlns="http://www.w3.org/2000/svg" width="16" heigth="16" class="exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">',
          '<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>',
          '</svg>',
          `<div>${message}</div>`,
          '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
          '</div>'
        ].join('')

        alertPlaceholder2.append(wrapper2)
      }
      alert2('Consulta Desmarcada', 'success')
    </script>
  <?php
  }
  if (isset($_GET["msg"]) && $_GET["msg"] == 3) {
  ?><div id="liveAlertPlaceholder"></div>
    <script>
      const alertPlaceholder3 = document.getElementById('liveAlertPlaceholder')

      const alert3 = (message, type) => {
        const wrapper3 = document.createElement('div')
        wrapper3.innerHTML = [
          `<div class="alert alert-${type} alert-dismissible d-flex align-items-center" " role="alert">`,
          '<svg xmlns="http://www.w3.org/2000/svg" width="16" heigth="16" class="check-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Sucess:">',
          '<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>',
          '</svg>',
          `<div>${message}</div>`,
          '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
          '</div>'
        ].join('')

        alertPlaceholder3.append(wrapper3)
      }
      alert3('Consulta Marcada', 'success')
    </script>
  <?php
  }
  ?>
  <div class="p-3 text-center text-danger-emphasis rounded-8">
    <h1>Agendamendo de consultas</h1>
  </div>
  <div class="container" style="margin-top: 30px;">
    <Form>
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
        <input type="datetime-local" name="diahora" class="date border border-danger" value="<?= date("Y-m-d\TH:i") ?>">
      </div>
      <div class="mb-2 col-3">
        <label class="form-label text-light">Prioridade</label>
        <select class="form-select border border-danger" aria-label="Default select example" name="prio">
          <option selected>Prioridade</option>
          <option name="baixa" value="baixa">Baixa</option>
          <option name="media" value="media">Media</option>
          <option name="alta" value="alta">Alta</option>
        </select>
      </div><br>
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
                <p class="card-text">Prioridade: <?php echo $linha["Prioridade"] ?></p>
                <a href="editar.php?ID=<?php echo $linha["ID"] ?>" class="btn btn-danger" name="Editar">Editar</a>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModaldesmarcar">
                  Desmarcar
                </button>

                <!-- Modal -->
                <div class="modal fade text-dark" id="exampleModaldesmarcar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" modal-content-bg="black" ;>
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Desmarcar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Realmente deseja desmarcar?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                        <a href="Index.php?id=<?php echo $linha["ID"] ?>" class="btn btn-danger" name="Deletar">Desmarcar</a>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>
  <script>
    let convenio = document.querySelector(`select[name="conv"]`);
  </script>
</body>

</html>
