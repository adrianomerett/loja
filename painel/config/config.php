<?php
$host = $_SERVER['HTTP_HOST'];
defined('BASE_URL') || define('BASE_URL', "http://{$host}/loja/painel");
defined('URL_API') || define('URL_API', "http://{$host}/loja/painel/api");
defined('URL_IMG') || define('URL_IMG', BASE_URL . "/public/upload/produtos");
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
defined('PAINEL') || define('PAINEL', 'painel');
// Caso mude de o projeto de diretório altere aqui
defined('ROOT_APP') || define('ROOT_APP', $_SERVER['DOCUMENT_ROOT'] . DS . 'loja' . DS . PAINEL . DS);
defined('ROOT_PAGES') || define('ROOT_PAGES', ROOT_APP . DS . 'paginas' . DS);
defined('ROOT_UPLOAD') || define('ROOT_UPLOAD', ROOT_APP . 'public' . DS . 'upload' . DS);
defined('ROOT_CORE') || define('ROOT_CORE', ROOT_APP . 'core'  . DS);
defined('ROOT_PROCUCTS') || define('ROOT_PROCUCTS', ROOT_UPLOAD . "produtos" . DS);
defined('ROOT_LIBRARY') || define('ROOT_LIBRARY', ROOT_CORE . 'libraries' . DS);
defined('ROOT_HELPERS') || define('ROOT_HELPERS', ROOT_CORE . 'helpers' . DS);
defined('MODELS') || define('MODELS', ROOT_CORE . 'models' . DS);
defined('DATABASE') || define('DATABASE', ROOT_CORE . 'database' . DS . 'database.php');

// Carrega  a classe de configuração
require_once MODELS . 'config.php';
$cfg = Config::getConfig();
defined('VERSION') || define('VERSION', md5(uniqid(rand(), true)));
defined('TIME_SESSION') || define('TIME_SESSION', 1800);
defined('KEY_SESSION') || define('KEY_SESSION', 'A9dE3xLmT2pQ0VwZb4rY7uJk5sC1gHnF8mR2tQ9lB3dN6xP0');
