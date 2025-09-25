<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de controle - <?php echo $cfg->nameloja; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . "/public/assets/fontawesome/css/all.min.css"; ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . "/public/assets/css/login.css?version=" . VERSION; ?>">
</head>

<body>
    <div class="container-login">
        <div class="title-login">Painel Administrativo - <?= $cfg->nameloja; ?></div>
        <div class="box-login">
            <div class="return-login info-login" id="return-login">
                <span>Informe seu email e senha para acessar.</span>
            </div>
            <div class="ct-inputs">
                <div class="ct-label" for="email">Email:</div>
                <div class="ct-input">
                    <div class="icon-input"><i class="fa-solid fa-envelope"></i></div>
                    <input type="text" id="email" class="inputs" name="email" placeholder="Email">
                </div>
            </div>
            <div class="ct-inputs">
                <div class="ct-label" for="password">Senha:</div>
                <div class="ct-input">
                    <div class="icon-input"><i class="fa-solid fa-key"></i></div>
                    <input type="password" id="password" class="inputs" name="password" placeholder="********">
                </div>
                <div class="show-password" id="show-password">
                    <i class="fa-solid fa-eye-slash"></i>
                </div>
            </div>
            <div class="ct-buttons">
                <div class="buttom-login" id="button-login">
                    <i class="fa-solid fa-fingerprint"></i> &nbsp; Entrar
                </div>
                <div class="buttom-clear" id="button-clear">
                    <i class="fa-solid fa-ban"></i> &nbsp; Limpar
                </div>
            </div>
            <div class="remember-login">
                <input type="checkbox" id="remember" name="remember"> &nbsp;
                <label for="remember">Lembrar meus dados.</label>
            </div>
        </div>
        <div class="content-loader" id="loader">
            <span class="loader"></span>
        </div>
        <script type="text/javascript">
            const URL_API = "<?php echo URL_API; ?>";
            const BASE_URL = "<?php echo BASE_URL; ?>";
        </script>
        <script src="<?php echo BASE_URL . "/public/assets/js/axios.min.js"; ?>"></script>
        <script src="<?php echo BASE_URL . "/public/assets/js/login.js?version=" . VERSION; ?>"></script>
</body>

</html>