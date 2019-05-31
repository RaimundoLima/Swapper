<?php
    session_start();
    include_once('./header.php');
?>
    <link rel="stylesheet" href="./css/logar.css">

    <div class="row" id="conteudo">
        <div class="col s10">

            <?php
                if (isset($_SESSION['error-message'])) {
                    echo '<div class="col s12 error-message">
                            <span> ERRO! '.$_SESSION['error-message'].'</span>
                        </div>';
                }
            ?>

            <form method="POST" action="<?php echo 'https://'.$_SERVER['HTTP_HOST'].'/logando'; ?>">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="email" name="email">
                        <label for="email">Email</label>
                        <span class="helper-text" data-error="wrong" data-success="right"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password" name="senha">
                        <label for="password"> Senha </label>
                    </div>
                </div>
                <div class="row col s12">
                    <a href="<?php echo 'https://'.$_SERVER['HTTP_HOST'].'/view/esqueceusenha.php'; ?>" id="esqueceu-senha">
                        Esqueceu sua senha?
                    </a>
                </div>
                <div class="row col s12" id="botoes">
                    <div>
                        <button class="btn waves-effect waves-light col s5" type="submit" name="action">
                            Entrar
                        </button>
                    </div>
                    <div>
                        <a href="./cadastro.php" class="waves-effect waves-light btn col s5 offset-s2">
                            Cadastrar
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col s10">
            <div>
                <?php
                    $ds = DIRECTORY_SEPARATOR;
                    $base_dir = realpath(dirname(__FILE__).$ds.'..');

                    include_once($base_dir.'/model/loginalternativo/facebook/facebook-init.php');
                    include_once($base_dir.'/public_html/model/loginalternativo/google/google.php');
                    
                    echo '<div class="col s12">
                            <a id="btn-fb" class="waves-effect waves-light btn col s12" href="'.htmlspecialchars($loginUrl).'">
                                Continuar com Facebook
                            </a>
                        </div>
            </div>
            <div>
                <div class="col s12">
                    <form action="'.$googleAuthUrl.'" method="post">
                        <button type="submit" class="waves-effect waves-light btn col s12">
                            Continuar com Google
                        </button>
                    </form>
                </div>';

                        // logout google
                        // unset($_SESSION['access_token']);
                        // $client->revokeToken();
                ?>
            </div>
        </div>
    </div>
<?php
    include_once('./footer.php');
?>