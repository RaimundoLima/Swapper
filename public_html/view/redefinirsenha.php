<?php
    include_once('./header.php');

    $url = $_SERVER['REQUEST_URI'];
    $chaveURL = explode('?', $url)[1];
?>
    <link rel="stylesheet" href="./css/logar.css">

    <div class="row" id="conteudo">
        <div class="col s10">
            <div class="col s12 error-message">
                <span id="mensagem-erro"></span>
            </div>

            <form method="POST" action="<?php  echo 'http://'.$_SERVER['HTTP_HOST'].'/model/redefinirsenha.php?'.$chaveURL;  ?>" >
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password" name="senha" required="">
                        <label for="password"> Senha </label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="confirm-password" type="password" name="confirm-senha" required="">
                        <label for="confirm-password"> Confirmar Senha </label>
                    </div>
                </div>

                <div class="row col s12" id="botoes">
                    <div>
                        <button class="btn waves-effect waves-light col s12" type="submit" name="action">
                            Cadastrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="js/validadores/form/redefinirsenha.js"></script>
<?php
    include_once('./footer.php');
?>