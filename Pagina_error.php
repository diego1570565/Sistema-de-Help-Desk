<html>

<head>
  <meta charset="utf-8" />
  <title>App Help Desk</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>
<style>
  .msg {
    font-size: 30px;
  }

  .titulos {
    display: flex;
    align-items: center;
    justify-content: center;
  }
  body{
    background: #a5a5a5;
  }
  #carinha{
    margin: auto;
    display: block;
   width: 100px;
  }
</style>

<body>
  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">

        <img class="img" src="Img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        <span class="ml-3 text" ;>ERROR</span>

    </a>
  </nav>
  <div class="container">
    <div class="">

      <div class="mt-5 card-login">
        <div class="card">
          <div class=" titulos msg card-header">
            Erro ao fazer a Requisição da pagina
          </div>
          <div class="titulos card-body">
          <?php

if (isset($_GET['error'])) {
    $error = $_GET['error'];
    echo $error;
} else {
    echo 'Houve um Erro inesperado ao fazer a Requisição da pagina, favor conferir as informações inseridas';
}

?>

        </div>
          <img src="Img/carinha.jpg" id='carinha' alt="">
          <div class=" card-body">
            <form action="home.php">
              <button class='btn btn-primary btn-lg btn-block ' href="../Help_Desk/Index.php">Home</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</body>

</html>
