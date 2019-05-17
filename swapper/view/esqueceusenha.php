<?php
    include_once('./header.php');
?>
    <link rel="stylesheet" href="./css/logar.css">

    <div class="row" id="conteudo">
        <div class="col s10">

            <?php
                session_start();

                if (isset($_SESSION['error-message'])) {
                    echo '<div class="col s12 error-message">
                            <span> ERRO! '.$_SESSION['error-message'].'</span>
                        </div>';
                }

                session_destroy();
            ?>

            <div class="col s12">
                <span id="header">
                    Informe seu email para receber o link de recuperação de senha.
                </span>
            </div>

            <form method="POST" action="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/recuperarsenha'; ?>">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="email" name="email">
                        <label for="email"> Email </label>
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                    </div>
                </div>
                <div class="row col s12">
                    <button class="btn waves-effect waves-light col s12" type="submit" name="action">
                        Enviar Email
                    </button>
                </div>
            </form>
        </div>
    </div>

<?php
    include_once('./footer.php');
?>