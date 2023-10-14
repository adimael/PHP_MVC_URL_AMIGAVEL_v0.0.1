<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="public/assets/css/nav.css">
  <link rel="stylesheet" type="text/css" href="public/assets/css/style-home.css">
  <link rel="stylesheet" type="text/css" href="public/assets/css/table.css">
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
      <h1 style="margin-bottom: 1em;">Consultar dados do usuário</h1>
      <input type="text" id="pesquisar" placeholder="Pesquisar..." oninput="pesquisarTabela()">
      <p class="not-found">Dado não encontrado</p>
      
      <div class="container">
      <table id="tabela">
        <thead>
          <tr>
            <th>Nome Completo</th>
            <th>Data de Nascimento</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($model->rows as $item): ?>

            <?php $dt_registro2 = implode('/', array_reverse(explode('-', $item->data_nascimento))); ?>
          <tr>
            <td><?= $item->nome ?></td>
            <td><?= $dt_registro2 ?></td>
            <td><?= $item->email ?></td>
            <td><?= $item->telefone ?></td>
            <td class="button-container">
              <a href="/cadastro?id_user=<?= $item->id_user ?>" class="editar-registro" data-id="1"><button class="edit-button">Editar</button></a>
              <button class="delete-button excluir-registro" data-id="<?= $item->id_user ?>">Deletar</button>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php if(count($model->rows) == 0): ?>
            <tr>
              <td style="text-align: center; color:brown;" colspan="5">Nenhum registro encontrado.</td>
            </tr>
            <?php endif;?>
          <!-- Adicione mais linhas conforme necessário -->
        </tbody>
      </table>
      </div>
    </div>

    <!-- Footer -->
    <footer id="rodape">
      <p>&copy; 2023 IFBAIANO - By Adimael. License MIT</p>
    </footer>
  </main>
  
  <!-- JAVASCRIPTS -->
  <script src="public/assets/js/nav.js"></script>
  <script src="public/assets/js/table-input.js"></script>
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
      $('#editTelefone').mask('(00) 00000-0000');
      });
</script> 

<!-- Modal de sucesso (inicialmente oculto) -->
<div class="modal fade" id="modalSucesso" tabindex="-1" role="dialog" aria-labelledby="modalSucessoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSucessoLabel">Cadastro atualizado com sucesso!</h5>
                    <a href="/cadastro"><button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span></a>
                    </button>
                </div>
                <div class="modal-body">
                    Sua informação foi atualizada com sucesso.
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

<!-- Modal de Registro Deletado com Sucesso -->
<div class="modal fade" id="modalRegistroDeletado" tabindex="-1" role="dialog" aria-labelledby="modalRegistroDeletadoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-header-green">
        <h5 class="modal-title" id="modalRegistroDeletadoLabel">Registro Deletado com Sucesso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        O registro foi deletado com sucesso.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Adicione o parâmetro ?sucesso=1 à URL para ocultar a modal -->
<script>
        // Verifique se a modal deve ser exibida e remova o parâmetro da URL
        if (window.location.search.indexOf('sucessodelete=1') > -1) {
            // Exibir a modal de Registro Deletado com Sucesso
            $('#modalRegistroDeletado').modal('show');
            // Remove o parâmetro sucesso da URL
            var novaURL = window.location.href.replace('?sucessodelete=1', '');
            window.history.replaceState({}, document.title, novaURL);
        }
    </script>

    <script>
      $(document).ready(function () {
        // Quando o botão "Excluir" for clicado
        $('.excluir-registro').click(function () {
          // Captura o id_user do atributo data-id
          var id_user = $(this).data('id');

          // Exibe a modal de confirmação
          $('#modalConfirmacao').modal('show');

          // Adiciona o id_user ao link de confirmação na modal
          $('#modalConfirmacao .confirmar-exclusao').attr('href', '/consulta/delete?id_user=' + id_user);
        });
      });
    </script>

<div class="modal fade" id="modalConfirmacao" tabindex="-1" role="dialog" aria-labelledby="modalConfirmacaoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-header-yellow">
        <h5 class="modal-title" id="modalConfirmacaoLabel">Confirmação de Exclusão</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Tem certeza de que deseja excluir este registro?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a href="#" class="btn btn-danger confirmar-exclusao">Confirmar Exclusão</a>
      </div>
    </div>
  </div>
</div>
