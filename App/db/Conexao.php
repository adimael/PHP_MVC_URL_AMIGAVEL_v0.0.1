<?php

/**
 * A classe de conexao é responsável por executar os
 * SQL junto ao banco de dados. 
 * By Adimael
 * https://github.com/adimael
 * https://adimael.github.io/
 * https://www.linkedin.com/in/adimael/
 */
class Conexao
{
  /**
   * Atributo (ou Propriedade) da classe destinado a armazenar o link (vinculo aberto)
   * de conexão com o banco de dados.
   */
  private $conexao;

  /**
   * Método construtor, sempre chamado na classe quando a classe é instanciada.
   * Exemplo de instanciar classe (criar objeto da classe):
   * $db = new Conexao();
   * Neste caso, assim que é instanciado, abre uma conexão com o MYSQL (Banco de dados)
   * A conexão é aberta via PDO (PHP Data Object) que é um recurso da linguagem para
   * acesso a diversos SGBDs.
   */
  public function __construct()
  {
    //DSN (Data Source Name) onde o servidor MYSQL será encontrado
    //(host) em qual porta o MYSQL está operando e qual o nome do banco pretendido
    /* Connect to a MySQL database using driver invocation */
    $dsn = 'mysql:dbname=dbsystem;host=127.0.0.1:3306';
    $user = 'root';
    $password = '';

    // Criando a conexão e armazedo na propriedade definida para tal.
    $this->conexao = new PDO($dsn, $user, $password);
  }

  /**
   * Método que recebe um model e extrai os dados do model para realizar o insert
   * na tabela correspondente ao model. Note o tipo do parâmetro declarado.
   */
  public function insert(CadastroModel $model)
  {
    //Trecho de código SQL com marcadores ? para substituição posterior, no prepare
    $sql = "INSERT INTO users (nome,data_nascimento,email,telefone) VALUES (?,?,?,?)";

    //Declaração da variável stmt que conterá a montagem da consulta. Observe que
    //estamos  acessando o método prepare dentro da propriedade que guarda a conexão
    //com o MYSQL, via operador seta "->". Isso significa que o prepare "está dentro"
    //da propriedade $conexão e recebe nossa string sql com os devido marcadores.
    $stmt = $this->conexao->prepare($sql);

    //Nesta etapa os bindValue são responsável por receber um valor e trocar em uma
    //determinada posição, ou seja, o valor que está em 3, será trocado pelo terceiro ?
    //No que o bindValue está recebendo o model que veio via parâmetro e acessamos
    //via seta qual dado do model queremos pegar para a posição em questão.
    $stmt->bindValue(1, $model->nome);
    $stmt->bindValue(2, $model->data_nascimento);
    $stmt->bindValue(3, $model->email);
    $stmt->bindValue(4, $model->telefone);

    //Ao fim, onde todo SQL está montando, executamos a consulta.
    $stmt->execute();
  }

  /**
     * Método que recebe o Model preenchido e atualiza no banco de dados.
     * Note que neste model é necessário ter a propriedade id preenchida.
  */
  public function update(CadastroModel $model)
  {
    $sql = "UPDATE users SET nome = ?, data_nascimento = ?, email = ?,telefone = ? WHERE id_user = ?";

    $stmt = $this->conexao->prepare($sql);

    $stmt->bindValue(1, $model->nome);
    $stmt->bindValue(2, $model->data_nascimento);
    $stmt->bindValue(3, $model->email);
    $stmt->bindValue(4, $model->telefone);
    $stmt->bindValue(5, $model->id_user);

    $stmt->execute();
  }

   /**
     * Remove um registro da tabela pessoa do banco de dados.
     * Note que o método exige um parâmetro $id do tipo inteiro.
    */
  public function delete(int $id_user)
  {
    $sql = "DELETE FROM users WHERE id_user = ? ";

    $stmt = $this->conexao->prepare($sql);
    $stmt->bindValue(1, $id_user);
    $stmt->execute();
  }

  /**
     * Método que retorna todas os registros da tabela users no banco de dados.
  */
  public function select()
  {
    $sql = "SELECT * FROM users";

    $stmt = $this->conexao->prepare($sql);
    $stmt->execute();

    // Retorna um array com as linhas retornadas da consulta. Observe que
    // o array é um array de objetos. Os objetos são do tipo stdClass e 
    // foram criados automaticamente pelo método fetchAll do PDO.
    return $stmt->fetchAll(PDO::FETCH_CLASS);
  }

  
    /**
     * Retorna um registro específico da tabela users do banco de dados.
     * Note que o método exige um parâmetro $id_user do tipo inteiro.
    */
  public function selectById(int $id_user)
  {
    include_once 'App/Model/CadastroModel.php';
    $sql = "SELECT * FROM users WHERE id_user = ?";

    $stmt = $this->conexao->prepare($sql);
    $stmt->bindValue(1, $id_user);
    $stmt->execute();

    return $stmt->fetchObject("CadastroModel");  // Retornando um objeto específico CadastroModel
  }

}