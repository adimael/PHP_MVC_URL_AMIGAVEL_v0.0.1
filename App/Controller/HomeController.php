<?php

/**
 * Classes Controller são responsáveis por processar as requisições do usuário.
 * Isso significa que toda vez que um usuário chama uma rota, um método (função)
 * de uma classe Controller é chamado.
 * O método poderá devolver uma View (fazendo um include), acessar uma Model (para
 * buscar algo no banco de dados), redirecionar o usuário de rota, ou mesmo,
 * chamar outra Controller.
 * By Adimael
 * https://github.com/adimael
 * https://adimael.github.io/
 * https://www.linkedin.com/in/adimael/
 */
class HomeController {

  /**
     * Os métodos index serão usados para devolver uma View.
     * Para saber mais sobre métodos estáticos, leia: https://www.php.net/manual/pt_BR/language.oop5.static.php
     */
  public static function index(){
    // Para saber mais sobre include , leia: https://www.php.net/manual/pt_BR/function.include.php
    include 'App/View/home.PHP';
  }

  public static function cadastro(){

    include 'App/Model/ConsultaModel.php';
    $model = new ConsultaModel();
    
    if(isset($_GET['id_user']))
      $model = $model->getById((int) $_GET['id_user']);

    include 'App/View/cadastro.PHP';
  }

  /**
     * Preenche um Model para que seja enviado ao banco de dados para salvar.
     */
  public static function save(){
    
    include 'App/Model/CadastroModel.php'; // inclusão do arquivo model.

    // Abaixo cada propriedade do objeto sendo abastecida com os dados informados
    // pelo usuário no formulário (note o envio via POST)
    $model = new CadastroModel();

    $model->id_user = $_POST['id_user'];
    $model->nome = $_POST['nome'];
    $model->data_nascimento = $_POST['data_nascimento'];
    $model->email = $_POST['email'];
    $model->telefone = $_POST['telefone'];

    $model->save(); // Chamando o método save do model.

  }

   /**
     * Método para tratar a rota delete. 
     */
  public static function delete()
  {
    include 'App/Model/CadastroModel.php'; // inclusão do arquivo model.

    // Abaixo cada propriedade do objeto sendo abastecida com os dados informados
    // pelo usuário no formulário (note o envio via POST)
    $model = new CadastroModel();

    $model->delete((int) $_GET['id_user']);

  }

  public static function consulta(){
    include 'App/Model/ConsultaModel.php';

    $model = new ConsultaModel();
    $model->getAllRows();

    include 'App/View/consulta.PHP';
  }

}