<?php
session_start();
include('conn.php');

if (!empty($_GET["usuario"]) && !empty($_GET["senha"])) {
    function testarValor($valor){
        $valor = htmlspecialchars($valor);
        $valor = stripslashes($valor);
        $valor = trim($valor);
        return $valor;
    }
    $usuario = testarValor($_GET["usuario"]);
    $senha = testarValor($_GET["senha"]);
    $sql = "SELECT * FROM tab_usuarios WHERE usuario = '$usuario' AND senha = '$senha' ";

    $result = mysqli_query($conn,$sql);
    $quantReg = mysqli_num_rows($result);

    if($quantReg > 0) {
        $_SESSION["usuario"] = $usuario;
        header('location:index.php');
    }else{
        header('location:login.php?erro=1');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
                                        <a href="login.php"><img src="img/logo.png" style="width: 100px;"
                                                alt="logo"></a>
                                        <h4 class="mt-1 mb-5 pb-1">*Nome da Clinica*</h4>
                                    </div>
                                    <div>
                                        <?php
                                            if (isset($_GET["cad"]) && $_GET["cad"] == "ok") {
                                        ?><div id="liveAlertPlaceholder"></div>
                                            <script>
                                                const alertPlaceholdercad = document.getElementById('liveAlertPlaceholder')

                                                const alertcad = (message, type) => {
                                                    const wrappercad = document.createElement('div')
                                                    wrappercad.innerHTML = [
                                                        `<div class="alert alert-dismissible d-flex align-items-center alert alert-success" role="alert">`,
                                                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" heigth="16" class="check-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Sucess:">',
                                                        '<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>',
                                                        '</svg>',
                                                        `<div>${message}</div>`,
                                                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                                                        '</div>'
                                                    ].join('')

                                                    alertPlaceholdercad.append(wrappercad)
                                                }
                                                alertcad('Cadastro Efetuado', 'success');
                                            </script>
                                        <?php
                                            }
                                        ?>
                                    </div>

                                    <form>
                                        <p>Acessar sua conta</p>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="form2Example11" name="usuario" class="form-control"
                                                placeholder="Usuario" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="form2Example22" name="senha" class="form-control"
                                                placeholder="Senha" />
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                                type="submit">Logar</button>

                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Não tem uma conta?</p>
                                            <a href="cadastrar.php" class="btn btn-outline-danger" name="cadastro">Cadastrar-se</a>
                                        </div>

                                        <div>
                                            <a href="https://google.com"><img src="https://img.icons8.com/color/512/google-logo.png" style="width:30px;" alt="google"></a>
                                            <a href="https://facebook.com"><img src="https://1000logos.net/wp-content/uploads/2021/04/Facebook-logo.png" style="width:50px;" alt="google"></a>

                                        </div>

                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">Servicos de Agendamento</h4>
                                    <p class="small mb-0">Bla Bla Bla Agenda</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>
</body>

</html>