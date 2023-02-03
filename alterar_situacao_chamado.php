<?php require_once 'autenticar_sessao.php';
require_once 'conexao.php';

$arquivos = glob("req/{*.txt}", GLOB_BRACE);
$count = count(glob("req/{*.txt}", GLOB_BRACE));
function convertDate($date)
{
    $aux = explode('-', $date);
    $dia = $aux[2];
    $mes = $aux[1];
    $ano = $aux[0];

    return $dia . '/' . $mes . '/' . $ano;
}

$id_chamado = $_GET['id'];


?>

<html>

<head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        .card-consultar-chamado {
            padding: 30px 0 0 0;
            width: 100%;
            margin: 0 auto;
        }

        body {
            background: #a6a6a6;
        }

        .caixa_situ {
            background: red;
        }

        .btn {
            width: 100%;
            display: inline-block;
            padding: 5px;
            background-color: #dcdcdc;
            margin-top: 8px;
        }

        .link {
            color: black;
        }

        .divi {
            padding: 10px;
        }
    </style>

</head>
<?php

if (!isset($_SESSION['condicao'])) {
    $_SESSION['condicao'] = '';
}


if (!isset($_SESSION['Pesquisa_Chamado'])) {
    $_SESSION['Pesquisa_Chamado'] = 0;
}



?>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="home.php">
            <div>
                <img class="img" src="Img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                <span class="ml-3 text" ;><?php echo ($_SESSION['Nome'] . ' - ' . $_SESSION['condicao']) ?></span>
            </div>
        </a>
    </nav>
    <div class="container my-4">
        <div class="row">
            <div class="col">
                <div class="card-consultar-chamado">
                    <div class="card">
                        <div class="card-header">
                            Alterar Chamado
                        </div>
                        <div class="card-body">
                            <?php
                            $pesquisa = $id_chamado;
                            if ($_SESSION['condicao'] == 'ADMINISTRADOR') {
                                $query = "SELECT id, titulo, categoria, conteudo, Email , data, situacao, Imagem FROM chamados WHERE ID =  $pesquisa ";
                                if ($result = $conn->query($query)) {
                                    while ($row = $result->fetch_assoc()) {
                                        $situacao = $row['situacao'];

                                        echo "<div class=' card mb-3 bg-light'>";
                                        echo "<span class='divi' style=";
                                        if ($situacao == 'aberto')
                                            echo "background:#90ee90";
                                        if ($situacao == 'fechado')
                                            echo "background:#f08080";

                                        $_SESSION['id_chamado'] = $row['id'];
                                        $_SESSION['sit_chamado'] = $row['situacao'];
                                        echo "><h4 style = 'text-transform: uppercase ;display: flex;align-items: center;justify-content: center;'>$situacao</h4>";
                                        echo "<strong> CHAMADO : </strong> <i>" . $row['id'] . "</i> <br/>";
                                        echo "<strong> ABERTO POR :</strong> <i>" . $row['Email'] . "</i> - <span class='text-danger'>Data: " . convertDate($row['data']) . "</span><br/>";
                                        echo "<strong> TITULO: </strong><i>" .  $row['titulo'] . "</i> <br/>";
                                        echo "<strong> CATEGORIA: </strong> <i>" . $row['categoria'] . "</i> <br/>";
                                        echo "<strong> CONTEUDO: </strong> ";
                                        echo "<i>" . $row['conteudo'] . "</i></pre>";
                                        if ($row['Imagem'] <> '') {
                                            echo "<img style='width: 100%; display:inline-block' src='Uploads/" . $row['Imagem'] . "'>";
                                        } else {
                                            echo '<h4>Não Há Imagens Atribuidas a esse Chamado</h4>';
                                        }
                                        echo '</span>';
                                        echo "</div>";
                                    }
                                    $result->close();
                                }
                            } else {
                                $user = $_SESSION['email'];
                                $query = "SELECT id,titulo, categoria, conteudo, Email , data, situacao FROM chamados WHERE" . "'$user'" . "= email AND ID =  $pesquisa";
                                if ($result = $conn->query($query)) {
                                    while ($row = $result->fetch_assoc()) {
                                        $situacao = $row['situacao'];
                                        echo "<h2 style = 'text-transform: uppercase ;display: flex;align-items: center;justify-content: center;'>$situacao</h2>";
                                        echo "<div  class='card mb-3 bg-light'>";
                                        echo "<span style= text-transform:uppercase;";
                                        if ($situacao == 'aberto')
                                            echo "background:#90ee90";
                                        if ($situacao == 'fechado')
                                            echo "background:#f08080";
                                        $_SESSION['id_chamado'] = $row['id'];
                                        $_SESSION['sit_chamado'] = $row['situacao'];
                                        echo "> <strong> CHAMADO : </strong> <i>" . $row['id'] . "</i> <br/>";
                                        echo "<strong> ABERTO POR :</strong> <i>" . $row['Email'] . "</i> - <span class='text-danger'>Data: " . convertDate($row['data']) . "</span><br/>";
                                        echo "<strong> TITULO: </strong><i>" .  $row['titulo'] . "</i> <br/>";
                                        echo "<strong> CATEGORIA: </strong> <i>" . $row['categoria'] . "</i> <br/>";
                                        echo "<strong> CONTEUDO: </strong> ";
                                        echo "<i>" . $row['conteudo'] . "</i></pre></span>";
                                        if ($row['Imagem'] <> '') {
                                            echo '<hr>';
                                            echo "<img style='width: 100%; display:inline-block' src='Uploads/" . $row['Imagem'] . "'>";
                                        } else {
                                            echo '<h4>Não Há Imagens Atribuidas a esse Chamado</h4>';
                                        }
                                        echo '</span>';
                                        echo "</div>";
                                    }
                                    $result->close();
                                }
                            }
                            if ($situacao == 'fechado') {
                                echo '<form action="config_situacao_chamado.php">';
                                echo '<button class="link btn btn-lg btn-info btn-block" type="submit">Abrir Chamado</button>';
                                echo '</form>';
                            }
                            if ($situacao == 'aberto') {
                                echo '<form action="config_situacao_chamado.php">';
                                echo '<button class="link btn btn-lg btn-info btn-block" type="submit">Fechar Chamado</button>';
                                echo '</form>';
                            }
                            ?>
                            <form action="deletar_chamado2.php">
                                <button class="link btn btn-lg btn-info btn-block" type="submit">Deletar Chamado</button>
                            </form>
                            <form action="consultar_chamado.php">
                                <button class="link btn btn-lg btn-info btn-block" type="submit">Voltar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>