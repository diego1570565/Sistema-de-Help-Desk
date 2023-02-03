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
        background: url(fundo2.jpg) ;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="Img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        Cadastro
      </a>
      
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-login">
          <div class="card">
            <div class="card-header">
              Confirmação de email
            </div>
            <div class="card-body">
              <form action="valida_email3.php" method="POST">

                <div class="form-group">
                  <input name ="nome" type="Text" class="form-control" placeholder="Confirmação">
                </div>
                
                <button class="btn btn-lg btn-info btn-block" type="submit">Certo</button>
            
            </form>

            </div>
          </div>
        </div>
    </div>
  </body>

</html>