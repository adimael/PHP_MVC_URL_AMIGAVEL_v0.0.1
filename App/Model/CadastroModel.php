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
class CadastroModel
{
   /**
     * Declaração das propriedades conforme campos da tabela no banco de dados.
     * para saber mais sobre Propriedades de Classe, leia: https://www.php.net/manual/pt_BR/language.oop5.properties.php
    */
  public $id_user, $nome, $data_nascimento, $email, $telefone;

  /**
     * Declaração do método save que chamará a DB para gravar no banco de dados
     * o model preenchido.
  */
  public function save()
  {
    include 'App/db/Conexao.php'; // Incluíndo o arquivo Conexão

    // Instância do objeto e conexão no banco de dados via construtor
    $db = new Conexao();

    // Verificando se a propriedade id foi preenchida no model
    // Para saber mais sobre a palavra-chave this, leia: https://pt.stackoverflow.com/questions/575/quando-usar-self-vs-this-em-php
    if(empty($this->id_user))
    {
      // Chamando o método insert que recebe o próprio objeto model
      // já preenchido
      $db->insert($this);
      header("Location: /cadastro?sucesso=1"); // redirecionando o usuário para mesma tela.

    } else {
      
      $db->update($this); // Como existe um id_user, passando o model para ser atualizado.
      header("Location: /consulta?sucesso=1"); // redirecionando o usuário para tela de consulta.
    }
  }

  /**
     * Método que encapsula o acesso a DB do método delete.
     * O método recebe um parâmetro do tipo inteiro que é o id_user do registro
     * que será excluido da tabela no MySQL, via camada DB.
  */
  public function delete(int $id_user)
  {
    include 'App/db/Conexao.php'; // Incluíndo o arquivo Conexão

    // Instância do objeto e conexão no banco de dados via construtor
    $db = new Conexao();

    $db->delete($id_user);

    header("Location: /consulta?sucessodelete=1");

  }

}