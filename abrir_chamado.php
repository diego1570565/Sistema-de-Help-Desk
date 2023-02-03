<?php require 'autenticar_sessao.php';

?>

<html>

<head>
    <meta charset="UTF-8" />
    <title>App Help Desk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        .card-abrir-chamado {
            padding: 30px 0 0 0;
            width: 100%;
            margin: 0 auto;
        }

        body {
            background: #a2a2a2;
        }

        .link {
            color: black;
        }
    </style>
</head>
<?php

if ($_SESSION['chamado_aberto'] == false) {
    echo "<script> alert ('Chamado aberto com sucesso') </script>";
    $_SESSION['chamado_aberto'] = true;
}

?>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="home.php">
            <div>
                <img class="img" src="Img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">

                <span class="ml-3 text" ;>
                    <?php
                        echo ($_SESSION['Nome'] . ' - ' . $_SESSION['condicao'])
                    ?>
                </span>

            </div>
        </a>>
    </nav>

    <div class="container">
        <div class="row">

            <div class="card-abrir-chamado">
                <div class="card">
                    <div class="card-header">
                        Abertura de chamado
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">

                                <form method="post" enctype="multipart/form-data" action="registra_chamado.php">
                                    <div class="form-group">
                                        <label>Título</label>
                                        <input name='titulo' type="text" class="form-control" placeholder="Título">
                                    </div>

                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <select name="categoria" class="form-control">
                                            <option>Criação Usuário</option>
                                            <option>Impressora</option>
                                            <option>Hardware</option>
                                            <option>Software</option>
                                            <option>Rede</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Descrição</label>
                                        <textarea name="descricao" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Enviar Imagens</label>
                                        <input name='imagem' type="file" class="form-control" placeholder="Título">
                                    </div>



                                    <div class="row mt-5">
                                        <div class="col-6">

                                            <a href="home.php" class="btn btn-lg btn-warning btn-block">Voltar</a>

                                        </div>

                                        <div class="col-6">
                                            <button class="btn btn-lg btn-info btn-block" type="submit">Abrir</button>
                                        </div>
                                    </div>


                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>