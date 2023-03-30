<?php
include('conn.php');

if (isset($_GET["cadastrar"])) {
    if (!empty($_GET["usuario"]) && !empty($_GET["senha"]) && !empty($_GET["confirmesenha"])) {
        function testarValor($valor)
        {
            $valor = htmlspecialchars($valor);
            $valor = stripslashes($valor);
            $valor = trim($valor);
            return $valor;
        }
        $usuario = testarValor($_GET["usuario"]);
        $senha = testarValor($_GET["senha"]);
        $confirmesenha = testarValor($_GET["confirmesenha"]);
        $loginOK = false;
        $senhaOK = false;

        if($senha == $confirmesenha){
            $senhaOK = true;
        }else{
            header('location:cadastrar.php?erro=senha');
        }
    
    $sql = "SELECT * FROM tab_usuarios WHERE usuario='$usuario'";
    $result = mysqli_query($conn,$sql);
    $quantReg = mysqli_num_rows($result);
    if($quantReg > 0) {
        header('location:cadastrar.php?erro=login');
    }else{
        $loginOK = true;
    }

    if($loginOK && $senhaOK){
        $sql = "INSERT INTO tab_usuarios(usuario,senha) VALUES ('$usuario','$senha')";
    if(mysqli_query($conn,$sql)){
        header('location:login.php?cad=ok');
    }else{
        header('location:cadastrar.php?erro=ok');
        }    
    }
}else {
    header('location:cadastrar.php?erro=cadnaopre');
}
}
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #000000;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #ef2b41, #ef2b41, #ef2b41, #ef2b41);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, #ef2b41, #ef2b41, #ef2b41, #ef2b41);
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }
    </style>
</head>

<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="img/logo.png" style="width: 100px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">Gerenciador de Tarefas</h4>
                                    </div>
                                    <div>
                                        <?php
                                            if (isset($_GET["erro"]) && $_GET["erro"] == "senha") {
                                        ?><div id="liveAlertPlaceholder"></div>
                                            <script>
                                                const alertPlaceholdersen = document.getElementById('liveAlertPlaceholder')

                                                const alertsen = (message, type) => {
                                                    const wrappersen = document.createElement('div')
                                                    wrappersen.innerHTML = [
                                                        `<div class="alert alert-dismissible d-flex align-items-center alert alert-danger" role="alert">`,
                                                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" heigth="16" class="exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">',
                                                        '<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>',
                                                        '</svg>',
                                                        `<div>${message}</div>`,
                                                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                                                        '</div>'
                                                    ].join('')

                                                    alertPlaceholdersen.append(wrappersen)
                                                }
                                                alertsen('Senhas NÃO coincidem', 'success');
                                            </script>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div>
                                        <?php
                                            if (isset($_GET["erro"]) && $_GET["erro"] == "login") {
                                        ?><div id="liveAlertPlaceholder"></div>
                                            <script>
                                                const alertPlaceholderlog = document.getElementById('liveAlertPlaceholder')

                                                const alertlog = (message, type) => {
                                                    const wrapperlog = document.createElement('div')
                                                    wrapperlog.innerHTML = [
                                                        `<div class="alert alert-dismissible d-flex align-items-center alert alert-danger" role="alert">`,
                                                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" heigth="16" class="exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">',
                                                        '<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>',
                                                        '</svg>',
                                                        `<div>${message}</div>`,
                                                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                                                        '</div>'
                                                    ].join('')

                                                    alertPlaceholderlog.append(wrapperlog)
                                                }
                                                alertlog('Login ja registrado', 'success');
                                            </script>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div>
                                        <?php
                                            if (isset($_GET["erro"]) && $_GET["erro"] == "ok") {
                                        ?><div id="liveAlertPlaceholder"></div>
                                            <script>
                                                const alertPlaceholderok = document.getElementById('liveAlertPlaceholder')

                                                const alertok = (message, type) => {
                                                    const wrapperok = document.createElement('div')
                                                    wrapperok.innerHTML = [
                                                        `<div class="alert alert-dismissible d-flex align-items-center alert alert-danger" role="alert">`,
                                                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" heigth="16" class="exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">',
                                                        '<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>',
                                                        '</svg>',
                                                        `<div>${message}</div>`,
                                                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                                                        '</div>'
                                                    ].join('')

                                                    alertPlaceholderok.append(wrapperok)
                                                }
                                                alertok('PROBLEMA DE CONEXÃO', 'success');
                                            </script>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div>
                                        <?php
                                            if (isset($_GET["erro"]) && $_GET["erro"] == "cadnaopre") {
                                        ?><div id="liveAlertPlaceholder"></div>
                                            <script>
                                                const alertPlaceholdercadn = document.getElementById('liveAlertPlaceholder')

                                                const alertcadn = (message, type) => {
                                                    const wrappercadn = document.createElement('div')
                                                    wrappercadn.innerHTML = [
                                                        `<div class="alert alert-dismissible d-flex align-items-center alert alert-info" role="alert">`,
                                                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" heigth="16" class="exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Info:">',
                                                        '<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>',
                                                        '</svg>',
                                                        `<div>${message}</div>`,
                                                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                                                        '</div>'
                                                    ].join('')

                                                    alertPlaceholdercadn.append(wrappercadn)
                                                }
                                                alertcadn('Preencha todos os campos', 'success');
                                            </script>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <form>
                                        <p>cadastrar sua conta</p>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="form2Example11" name="usuario" class="form-control" placeholder="Usuario" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="form2Example22" name="senha" class="form-control" placeholder="Senha" />
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input type="text" id="form2Example22" name="confirmesenha" class="form-control" placeholder="Confirmar Senha" />
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="cadastrar">Cadastrar</button>
                                            <a href="login.php" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" name="retornar">Retornar</a>
                                        </div>



                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">Gerenciador de tarefas</h4>
                                    <p class="small mb-0">ask manager ou gerenciador de tarefas, anteriormente conhecido
                                        como Windows Task Manager ou gerenciador de tarefas do Windows é um gerenciador
                                        de tarefas, monitor do sistema, e gerenciador de inicialização incluído com
                                        sistemas Microsoft Windows.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>
</body>
</html>
