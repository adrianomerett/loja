<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . "/public/assets/fontawesome/css/all.min.css"; ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . "/public/assets/css/painel.css?version=" . VERSION; ?>">
<?php
if (isset($assets['css']) && count($assets['css']) > 0) {
foreach ($assets['css'] as $key => $value) {
if($key != $pagina){
    continue;
}
if (isset($assets['css'][$pagina][$acao]) && count($assets['css'][$pagina][$acao]) > 0) {
foreach ($assets['css'][$pagina][$acao] as $key => $value) {
?>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . "/public/assets/css/" . $value; ?>.css?version=<?php echo VERSION; ?>">
<?php
}
}
}
}
?>
    <title>Teste</title>
</head>

<body>
    <?php require_once(ROOT_PAGES . "template" . DS . "topo.php"); ?>