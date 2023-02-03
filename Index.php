<html>
  <head>
    <meta charset="utf-8" />
    <title>Login - Help Desk</title></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-login {
        padding: 30px 0 0 0;
        width: 350px;
        margin: 0 auto;
      }
      body{
        background: lightsteelblue ;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <div>
          <img class="img" src="Img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">

          <span class = "ml-3 text" ;><?php 
          echo  "LOGIN" ?>
          </span>

        </div>
      </a>

    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-login">
          <div class="card">
            <div class="card-header">
              
              Login
            
            </div>
            <div class="card-body">

              <form action="valida_login.php" method="POST">
                <div class="form-group">
                  <input name ="email" type="email" class="form-control" placeholder="E-mail">
                </div>
                <div class="form-group">
                  <input name ="senha" type="password" class="form-control" placeholder="Senha">
              
                </div>
                <button class= "btn btn-lg btn-info btn-block" type="submit">Entrar</button>
               </form> 

              <form method="POST" action="cadastro.php" name="botao">
                  <button  class="btn btn-lg  btn-info btn-block" type="submit">Fazer Cadastro</button>
              </form>
              <form method="POST" action="esqueci_senha.php" name="botao">
                  <button  class="btn btn-lg  btn-info btn-block" type="submit">Esqueci a Senha</button>
              </form>

            </div>
          </div>
        </div>
    </div>
  </body>
 
</html>