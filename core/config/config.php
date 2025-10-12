<?php
$host = $_SERVER['HTTP_HOST'];
$dir = 'loja';
defined('PAINEL') || define('PAINEL', 'painel');
defined('BASE_URL') || define('BASE_URL', "http://{$host}/{$dir}");
defined('URL_API') || define('URL_API', "http://{$host}/{$dir}/api/");
defined('URL_PAINEL') || define('URL_PAINEL', "http://{$host}/{$dir}/" . PAINEL);
defined('ASSETS') || define('ASSETS', BASE_URL . "/public/assets");

defined('DS') || define('DS', DIRECTORY_SEPARATOR);

defined('ROOT_APP') || define('ROOT_APP', $_SERVER['DOCUMENT_ROOT'] . DS . 'loja' . DS);
defined('ROOT_PAGES') || define('ROOT_PAGES', ROOT_APP . "paginas" . DS);
defined('ROOT_CORE') || define('ROOT_CORE', ROOT_APP . "core" . DS);
defined('DATABASE') || define('DATABASE', ROOT_APP . PAINEL . DS . 'core' . DS . 'database' . DS . 'Database.php');
defined('MODELS') || define('MODELS', ROOT_CORE . "models" . DS);

// Carrega  a classe de configuração
require_once MODELS . 'mconfig.php';
$cfg = Config::getConfig();
defined('VERSION') || define('VERSION', md5(uniqid(rand(), true)));
