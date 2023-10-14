<?php

/**
 * By Adimael
 * https://github.com/adimael
 * https://adimael.github.io/
 * https://www.linkedin.com/in/adimael/
 */

include 'App/Controller/HomeController.php';

// Para saber mais sobre a função parse_url: https://www.php.net/manual/pt_BR/function.parse-url.php
$rota = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

define('BASE_URL', 'http://localhost'); // Substitua pelo URL real do seu site

// Para saber mais estrutura switch, leia: https://www.php.net/manual/pt_BR/control-structures.switch.php
switch($rota){
  case '/':
    // Para saber mais sobre o Operador de Resolução de Escopo (::), 
    // leia: https://www.php.net/manual/pt_BR/language.oop5.paamayim-nekudotayim.php
    HomeController::index();
    break;
  case '/home':
    HomeController::index();
    break;
  case '/cadastro':
    HomeController::cadastro();
    break;
  case '/cadastro/save':
    HomeController::save();
    break;
  case '/consulta/delete':
    HomeController::delete();
    break;
  case '/consulta':
    HomeController::consulta();
    break;
  default:
    echo '<h1>Erro 404</h1>';
}

//include "App/View/{$rota}.php";