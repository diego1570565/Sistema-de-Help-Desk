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
            background:#a2a2a2;
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
        .link{
            color: black;
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="home.php">
            <div>
                <img class="img" src="Img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">

                <span class="ml-3 text" ;><?php
                                            echo ($_SESSION['Nome'] . ' - ' . $_SESSION['condicao']) ?>
                </span>

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
                            <form action="deletar_chamado.php" method="POST">
                           
                                    <input style="width: 100%;" class="mb-1" name="pesquisa" type="text" value="" placeholder="Pesquisa por ID"></input>
                              
                                    <button class="link btn btn-lg btn-info btn-block" type="submit">Buscar</button>
                            </form>
                        </div>
                        <div class="card-body">
                      <?php
                      
                  
                      $pesquisa = $_POST['pesquisa']; 

                            if ($_SESSION['condicao'] == 'ADMINISTRADOR') {
                                $query = "SELECT id,titulo, categoria, conteudo, Email , data, situacao FROM chamados WHERE ID =  $pesquisa";
                                if ($result = $conn->query($query)) {
                                  while ($row = $result->fetch_assoc()) {
                                    $situacao = $row['situacao'];
                                    echo "<div  class='card mb-3 bg-light'>";
                                    echo "<span style="; 
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
                                    echo "<div  class='card mb-3 bg-light'>";
                                    echo "<span style="; 
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
                                    echo "</div>";
                                  }
                                  $result->close();
                                }
                              }
                      
                        
                        ?>  
                
                            <form action="consultar_chamado.php">
                                <button class="btn link btn-lg btn-info btn-block" type="submit">Voltar</button>
                            </form>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-dark bg-dark">
      <div> 
        <ul class="navbar-nav">
          <li style="color:white" class="nav-item"> <span>Help-Desk_Developed_by Diego.Oliveira</span>
          </li>
        </ul>
      </div>
  </nav>
</body>

</html>