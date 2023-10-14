<?php

/**
 * A camada model é responsável por transportar os dados da Controller até a DB e vice-versa.
 * Também é atribuído a Model a validação dos dados da View e controle de acesso aos métodos
 * da DB.
 * By Adimael
 * https://github.com/adimael
 * https://adimael.github.io/
 * https://www.linkedin.com/in/adimael/
 */
class ConsultaModel 
{
  /**
     * Propriedade que armazenará o array retornado da DAO com a listagem das pessoas.
  */
  public $rows;

  /**
     * Método que encapsula a chamada a DB e que abastecerá a propriedade rows;
     * Esse método é importante pois como a model é "vista" na View a propriedade
     * $rows será acessada e possibilitará listar os registros vindos do banco de dados
  */
  public function getAllRows(){
      
    include 'App/db/Conexao.php'; // Incluíndo o arquivo Conexao.php

    // Instância do objeto e conexão no banco de dados via construtor
    $db = new Conexao();

    // Abastecimento da propriedade $rows com as "linhas" vindas do MySQL
    // via camada DB.
    $this->rows = $db->select();

  }

  /**
     * Método que encapsula o acesso ao método selectById da camada DB
     * O método recebe um parâmetro do tipo inteiro que é o id_user do registro
     * a ser recuperado do MySQL, via camada DB.
  */
  public function getById(int $id_user)
  {
    include 'App/db/Conexao.php'; // Incluíndo o arquivo Conexao.php

    $db = new Conexao();

    // Obtendo um model preenchido da camada DB
    $obj = $db->selectById($id_user);

     // Para saber mais operador ternário, leia: https://pt.stackoverflow.com/questions/56812/uso-de-e-em-php
     return ($obj) ? $obj : new CadastroModel(); // Operador Ternário

     /*
    if($obj){
      return $obj;
    } else {
      return new CadastroModel;
    }
    */
  }
}