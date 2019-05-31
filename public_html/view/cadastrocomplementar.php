<?php
    include_once('./header.php');
?>
    <link rel="stylesheet" href="./css/logar.css">

    <div class="row" id="conteudo">
        <div class="col s10">
            <span id="titulo-cadastro-complementar"> Por favor, completemente suas informações </span>
        </div>
        <div class="col s10">
            <form method="POST" action="/cadastrar">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="data-nasc" type="text" required="" class="datepicker">
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
                <div class="row"></div>

                <div class="row col s12" id="botoes">
                    <div>
                        <button class="btn waves-effect waves-light col s12" type="submit" name="action">
                            Completar Cadastro
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="js/validadores/form/cadastrocomplementar.js"></script>
<?php
    include_once('./footer.php');
?>