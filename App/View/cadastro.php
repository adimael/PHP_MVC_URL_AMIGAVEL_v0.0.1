<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="public/assets/css/nav.css">
  <link rel="stylesheet" type="text/css" href="public/assets/css/style-home.css">
  <link rel="stylesheet" type="text/css" href="public/assets/css/form.css">
  <link rel="stylesheet" type="text/css" href="public/assets/css/modal-bootstrap.css">
  <link rel="stylesheet" type="text/css" href="public/assets/css/modal.css">
  <!-- Adicione o favicon -->
  <link rel="icon" type="image/x-icon" href="public/assets/img/logo.png">
  <title>IFBAIANO - Instituto Federal Baiano</title>
</head>
<body>
  <!-- Header -->
  <header class="header">
          <nav class="navbar">
              <a href="/" class="nav-logo"><img style="width: 30px;" src="public/assets/img/if.png" alt="logo"> Instituto Federal Baiano</a>
              <ul class="nav-menu">
                  <li class="nav-item">
                      <a href="/" class="nav-link">Inicio</a>
                  </li>
                  <li class="nav-item">
                      <a href="/cadastro" class="nav-link">Cadastro</a>
                  </li>
                  <li class="nav-item">
                      <a href="/consulta" class="nav-link">Consultas</a>
                  </li>
              </ul>
              <div class="hamburger">
                  <span class="bar"></span>
                  <span class="bar"></span>
                  <span class="bar"></span>
              </div>
          </nav>
  </header>

  <!-- Main -->
  <main>
    <div class="title-center">
      <h1 style="margin-bottom: 2em;">Realizar novo cadastro</h1>
      <div class="container">
    <div class="illustration">
      <img style="width: 30em;" src="public/assets/img/hero-img2.png" alt="Ilustração" style="max-width: 100%;">
    </div>
    <div class="form-container">
      <h1 style="margin-bottom: 10px;">Preencha todos os campos</h1>
      <?php if(isset($_GET['id_user'])){ ?>
      <form action="/cadastro/save" method="post">
        <input type="hidden" value="<?=$_GET['id_user'];?>" id="id_user" name="id_user" />
        <label for="nome">Nome Completo:</label>
        <input type="text" id="nome" name="nome" value="<?= $model->nome ?>" placeholder="Digite seu nome completo..." autocomplete="off" required>

        <label for="telefone">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" value="<?= $model->data_nascimento ?>" autocomplete="off" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Digite seu email..." value="<?= $model->email ?>" autocomplete="off" required>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" placeholder="Digite seu telefone..." value="<?= $model->telefone ?>" autocomplete="off" required>

        <input type="submit" value="Enviar">
      </form>
      <?php } else {?>
        <form action="/cadastro/save" method="post">
        <label for="nome">Nome Completo:</label>
        <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo..." autocomplete="off" required>

        <label for="telefone">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" autocomplete="off" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Digite seu email..." autocomplete="off" required>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" placeholder="Digite seu telefone..." autocomplete="off" required>

        <input type="submit" value="Enviar">
      </form>
      <?php }?>
    </div>
  </div>
    </div>
    <!-- Footer -->
    <footer id="rodape">
      <p>&copy; 2023 IFBAIANO - By Adimael. License MIT</p>
    </footer>
  </main>
  
  <!-- JAVASCRIPTS -->
  <script src="public/assets/js/nav.js"></script>
  <!-- MASK -->
  <script type="text/javascript" src="public/assets/js/jquery.mask.min.js"></script>
  <script src="public/assets/js/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<!--MASCARAS -->
<script type="text/javascript">
    $(document).ready(function(){
      $('#telefone').mask('(00) 00000-0000');
      });
</script> 

<!-- Modal de sucesso (inicialmente oculto) -->
<div class="modal fade" id="modalSucesso" tabindex="-1" role="dialog" aria-labelledby="modalSucessoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-green">
                    <h5 class="modal-title" id="modalSucessoLabel">Cadastro realizado com sucesso!</h5>
                    <a href="/cadastro"><button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span></a>
                    </button>
                </div>
                <div class="modal-body">
                    Sua informação foi cadastrada com sucesso.
                </div>
                <div class="modal-footer">
                    <a href="/cadastro"><button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Adicione o parâmetro ?sucesso=1 à URL para ocultar a modal -->
    <script>
        // Verifique se a modal deve ser exibida e remova o parâmetro da URL
        if (window.location.search.indexOf('sucesso=1') > -1) {
            $('#modalSucesso').modal('show'); // Exibe a modal
            // Remove o parâmetro sucesso da URL
            var novaURL = window.location.href.replace('?sucesso=1', '');
            window.history.replaceState({}, document.title, novaURL);
        }
    </script>