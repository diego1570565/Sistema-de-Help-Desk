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
      background: #a2a2a2;
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

    .container span {
      text-transform: uppercase;
    }

    a {
      text-decoration: none;
      color: black;
    }

    .container span:hover {
      text-decoration: none;
      color: black;
      cursor: pointer;
    }

    .botao {
      margin-left: 38%;
      width: 6em;
    }
  </style>

</head>

<?php

if ($_SESSION['chamado_alterado'] == false) {
    echo "<script> alert ('Chamado alterado com sucesso') </script>";
    $_SESSION['chamado_alterado'] = true;
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

  <div class="container mb-4">
    <div class="row">
      <div class="col">
        <div class="card-consultar-chamado">
          <div class="card">
            <div class="card-header">
              Consulta de chamado
              <?php

if (!isset($_POST['pesquisa'])) {
    $_POST['pesquisa'] = '';
}
if (!isset($_POST['pesquisaID'])) {
    $_POST['pesquisaID'] = '';
}

$varVerificacao = true;

if (isset($_SESSION['varVerificacao'])) {
    if (
        $_SESSION['varVerificacao'] == true
    ) {
        $varVerificacao = false;
    }
}
echo "<h6 class=d-flex text-right>" . date('d/m/Y') . "</h6>";
?>

            </div>
            <div class="row">
              <div class="col-6">
                <form class=" m-3" method="POST" action="consultar_chamado.php">
                  <input style='width : 100%' class="mb-1" name="pesquisa" type="text" value="" placeholder="Pesquisa por Titulo"></input>
                  <button class="btn link btn-info" type="submit">Pesquisar</button>
                </form>
              </div>
              <div class="col-6">
                <form class="m-3" method="POST" action="consultar_chamado.php">

                  <input style='width : 100%' class="mb-1" name="pesquisaID" type="text" value="" placeholder="Pesquisa por ID"></input>
                  <button class="link btn btn-info" type="submit">Pesquisar</button>
                </form>
              </div>

            </div>
            <div class="row ">
              <div class='col-6 d-flex justfy-content-center align-itens-center col-sm-6'>
                <form class="ml-sm-3 mr-3" method="POST" action=menos_chamado.php>
                  <INPUT TYPE="hidden" NAME="pesquisa" VALUE="0">
                  <button class="link botao btn-lg btn-info" id="" type="submit">
                    Anterior </button>
                </form>
              </div>
              <div class='col-6 d-flex justfy-content-center align-itens-center'>
                <form class="" method="POST" action=mais_chamado.php>
                  <INPUT TYPE="hidden" NAME="pesquisa" VALUE="0">
                  <button class="link botao btn-lg btn-info" type="submit">Próximo</button>
                </form>
              </div>
            </div>
            <div class="card-body">

              <?php
$pesquisaID = $_POST['pesquisaID'];
$pesquisa = $_POST['pesquisa'];

if (!isset($_SESSION['id_Cha'])) {
    $_SESSION['id_Cha'] = -1;
}

if ($pesquisa == '' && $pesquisaID == '' && $_SESSION['condicao'] == 'ADMINISTRADOR') {
    $query = "SELECT id,titulo, categoria, conteudo, Email , data, situacao FROM chamados where ID > " . ($_SESSION['id_Cha']) . " LIMIT 5";
}

if ($pesquisa == '' && $pesquisaID == '' && $_SESSION['condicao'] != 'ADMINISTRADOR') {
    $user = $_SESSION['email'];
    $query = "SELECT id,titulo, categoria, conteudo, Email, data , situacao FROM chamados WHERE" . "'$user'" . "= email AND ID >" . $_SESSION['id_Cha'] . " LIMIT 3";
}
if ($pesquisaID != '' && $_SESSION['condicao'] == 'ADMINISTRADOR') {
    $query = "SELECT id,titulo, categoria, conteudo, Email, data, situacao FROM chamados WHERE id = $pesquisaID";
}

if ($pesquisaID != '' && $_SESSION['condicao'] != 'ADMINISTRADOR') {
    $user = $_SESSION['email'];
    $query = "SELECT id,titulo, categoria, conteudo, Email, data, situacao FROM chamados WHERE" . "'$user'" . "= email AND id =  $pesquisaID";
}
if ($pesquisa != '' && $pesquisaID == '' && $_SESSION['condicao'] == 'ADMINISTRADOR') {
    $query = "SELECT id,titulo, categoria, conteudo, Email, data, situacao FROM chamados WHERE titulo LIKE '%$pesquisa%'";
}

if ($pesquisa != '' && $pesquisaID == '' && $_SESSION['condicao'] != 'ADMINISTRADOR') {
    $user = $_SESSION['email'];
    $query = "SELECT id,titulo, categoria, conteudo, Email, data, situacao FROM chamados WHERE" . "'$user'" . "= email AND LIKE '%$pesquisa%'";
}
require '../Caixa_de_Ferramentas/Funcoes.php';
verifica_tabela('chamados', $conn);
if ($_SESSION['existencia'] == true) {
    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $situacao = $row['situacao'];

            echo "<form action='alterar_situacao_chamado.php' method='POST'>";
            echo "<div id = " . $row['id'] . " name = '" . $row['id'] . "' onclick='getFocus (this.id);' class='card mb-3 bg-light'>";
            echo "<span style= font-size:13px;";
            if ($situacao == 'aberto') {
                echo "background:yellowgreen";
            }

            if ($situacao == 'fechado') {
                echo "background:#f08080";
            }

            echo "> <strong> CHAMADO : </strong> <i>" . $row['id'] . "</i> <br/>";
            echo "  <INPUT TYPE='hidden' name= 'pesquisa' value = " . $row['id'] . ">";
            echo "<strong> TITULO: </strong><i>" . $row['titulo'] . "</i> <br/>";
            if ($varVerificacao == false) {
                $varVerificacao = true;
                $_SESSION['varVerificacao'] = false;
                $_SESSION['Diego'] = $row['id'];
            }
            echo "</div>";
            echo "</form>";
        }

        $result->close();
    }
}
?>
              <div class="row ">
                <div class="col-12">
                  <a href="home.php" class="btn btn-lg btn-warning " type="submit">Voltar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function getFocus(name) {
      var id = document.getElementById(name)
      location.assign('alterar_situacao_chamado.php?id=' + name);
    }
  </script>


</body>

</html>