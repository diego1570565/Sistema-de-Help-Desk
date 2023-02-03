<?php require_once 'autenticar_sessao.php';
$_SESSION['chamado_aberto'] = true;
$_SESSION['chamado_alterado'] = true;
$variavel1 = false;
require 'conexao.php';
require '../Caixa_de_Ferramentas/Funcoes.php';
if (!empty($_POST['editar_usuarios'])) {
    $editarusuarios = $_POST['editar_usuarios'];
    $query = "SELECT Nome FROM usuarios where Condicao <> 'adm' and Nome =" . "'$editarusuarios'";
    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            if ($row['Nome'] != '') {
                $_SESSION['nomedousuario'] = $row['Nome'];
                $variavel1 = true;
            }
        }
        $result->close();
    }}
?>
<html>

<head>
  <meta charset="utf-8" />
  <title>App Help Desk</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <style>
    .card-home {
      padding: 30px 0 0 0;
      width: 100%;
      margin: 0 auto;
    }

    body {
      background: #a2a2a2;
    }

    .titulos {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .estilo {
      margin-bottom: 10px;
    }

    .container a {
      text-decoration: none;
      color: black;
      display: inline-block;
    }

    .container a:hover {
      text-decoration: none;
    }

    table,
    th,
    td {
      border: 1px double black;
      padding: 3px;
    }

    .nome {
      cursor: pointer;
    }
  </style>
  <script>
    function levar(nome) {
      var caixa_texto = document.getElementById('edita_usuarios')
      var nome_cara = document.getElementById(nome)

      $('#nome').addClass('mb-5');
      caixa_texto.value = nome_cara.id

      $('#BtnUser').click();

    }
  </script>
</head>
<?php
if (!isset($_POST['editar_usuarios'])) {
    $_POST['editar_usuarios'] = '';
}
?>

<body>
  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
      <div>
        <img class="img" src="Img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        <span class="ml-3 text" ;><?php
echo ($_SESSION['Nome'] . ' - ' . $_SESSION['condicao']) ?>
        </span>
      </div>
    </a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="logoff.php">SAIR</a>
      </li>
    </ul>
  </nav>
  <div class="container">
    <div class="row">
      <div class="card-home">
        <div class="card">
          <div class="card-header titulos">
            MENU
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-6 d-flex justify-content-center">
                <a href="abrir_chamado.php">
                  <img src="Img/formulario_abrir_chamado.png" width="70" height="70">
                </a>
              </div>
              <div class="col-6 d-flex justify-content-center">
                <a href="consultar_chamado.php">
                  <INPUT TYPE="hidden" NAME="pesquisaID" VALUE="0">
                  <img src="Img/formulario_consultar_chamado.png" width="70" height="70">
                </a>
              </div>
              <div class="col-6 d-flex justify-content-center">
                <a href="abrir_chamado.php">
                  Abrir Chamados
                </a>
              </div>
              <div class="col-6 d-flex justify-content-center">
                <INPUT TYPE="hidden" NAME="pesquisaID" VALUE="0">
                <a href="consultar_chamado.php">
                  Consultar Chamados
                </a>
              </div>
            </div>
          </div>
        </div>
        <?php

if ($_SESSION['condicao'] == 'ADMINISTRADOR') {?>
          <div class=" mb-3 container">
            <div class="row">
              <div class="card-home">
                <div class="card">
                  <div class="titulos card-header align-text">
                    USUARIOS CADASTRADOS NO SISTEMA HELPDESK
                  </div>
                  <div class='titulos mt-3 col-12'>
                    <form action="home.php" method="POST">
                      <input type="hidden" id="edita_usuarios" name="editar_usuarios" placeholder="Usuario">
                      <input type="submit" id="BtnUser" name="editar" value="Atualizar">
                    </form>



                  </div>
                  <?php if ($variavel1 == true) {
    echo "<div class='titulos card-header'>";
    echo "<h4 style = 'text-transform: uppercase ;display: flex;align-items: center;justify-content: center;'>$editarusuarios</h4>";?>
                 <hr>
                <form class="m-1" action="excluir_usuario.php" method='POST'>
                  <input type='submit' name='editar' value='Remover Acesso do Usuario'>
                </form>
                <form class="m-1" action="tornar_administrador.php" method='POST'>
                  <input type='submit' name='editar' value='Tornar Usuario Administrador'>
                </form>
            </div>
          <?php }

    ?>

                <?php
                  echo "<div' class='estilo card-body'>";
                      echo " <div class='row'>";
                      echo " <div class='col-12'> ";
                      $query = "SELECT Nome FROM usuarios where Condicao <> 'adm'";
                      if ($result = $conn->query($query)) {
                          while ($row = $result->fetch_assoc()) {
                              echo '<table style="width:100%"';
                              echo "id = '" . $row['Nome'] . "'   onclick = 'levar(this.id)'   class='nome mb-4'>";
                              echo "<tr>";
                              echo "<td>" . $row['Nome'] . "</td>";
                              echo '</tr>';
                              echo 'USUARIO :';
                              echo '</tr>';
                              echo "</table>";
                          }
                          $result->close();
                      }
                  }
                  ?>
                </div>

              </div>


            </div>
          </div>
      </div>
    </div>
</body>



</html>