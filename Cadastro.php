<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-login {
        padding: 30px 0 0 0;
        width: 350px;
        margin: 0 auto;
      }
      body{
        background:rosybrown ;
      }
    </style>
  </head>

  <body>
  <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <div>
          <img class="img" src="Img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
          <span class = "ml-3 text" ;><?php 
          echo  "CADASTRO" ?>
          </span>
        </div>
      </a>
    </nav>
    <div class="container">    
      <div class="row">

        <div class="card-login">
          <div class="card">
            <div class="card-header">
              Cadastro
            </div>
            <div class="card-body">
              <form action="valida_email.php" method="POST">
                <div class="form-group">
                  <input name ="email" type="email" class="form-control" placeholder="E-mail">
                </div>
                <div class="form-group">
                  <input name ="senha" type="password" class="form-control" placeholder="Senha">
                </div>
                <div class="form-group">
                  <input name ="nome" type="Text" class="form-control" placeholder="Nome e Sobrenome">
                </div>
                <button class="btn btn-lg btn-info btn-block" type="submit">Salvar</button>
              </form>
              <form action ="index.php">
              <button class="btn btn-lg btn-info btn-block" type="submit">Retornar ao Login</button>
              </form> 
            </div>
          </div>
        </div>
    </div>
  </body>
</html>