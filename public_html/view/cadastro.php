<?php
    session_start();
    include_once('./header.php');
?>
    <link rel="stylesheet" href="./css/logar.css">

    <div class="row" id="conteudo">
        <div class="col s10">
            <?php
                if (isset($_SESSION['error-message'])) {
                    echo '<div class="col s12 error-message" style="display: block;">
                            <span> ERRO! '.$_SESSION['error-message'].'</span>
                        </div>';
                }
                unset($_SESSION['error-message']);
            ?>
            <div class="col s12 error-message">
                <span id="mensagem-erro"></span>
            </div>

            <form method="POST" action="/cadastrar" enctype="multipart/form-data">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="nome" type="text" name="nome" required="">
                        <label for="nome">Nome Completo</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="data-nasc" type="date" name="data-nasc" required="" placeholder="">
                        <label for="data-nasc">Data de Nascimento</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <label>
                            <input name="sexo" value="M" type="radio" checked />
                            <span> Masculino </span>
                        </label>
                        <label>
                            <input name="sexo" value="F" type="radio" />
                            <span> Feminino </span>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="email" name="email" required="" pattern="^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$">
                        <label for="email">Email</label>
                    </div>
                </div>
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
                <div class="row">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>FOTO</span>
                            <input name="foto" type="file" accept="image/x-png,image/jpg,image/jpeg">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Adicionar foto de perfil (Opcional)">
                        </div>
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

    <script src="js/validadores/form/cadastro.js"></script>
<?php
    include_once('./footer.php');
?>