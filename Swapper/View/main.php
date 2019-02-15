<body>

    <div class="row swiper-container main-container">
        <div class="swiper-wrapper">
            <div id="perfil" class="col s12 swiper-slide">
                <div class="row">
                    <div class="perfil_tab col s12 out-tab">
                        <div class="titulo_tab  pd-0">
                            <a id="burguerBtn" class=""><i class=" material-icons">dehaze</i></a>
                            <h4 class="pd-r0">Perfil</h4>
                        </div>
                        <div class="perfil_dados col s12">
                            <div class="row mg-0">
                                <div class="col s3 pd-r0">
                                    <div class="pic">
                                        <img id="fotoPerfil" <?php echo "src='data:image/jpeg;base64,".$_SESSION["usuario"]["foto"]."'";?> alt="">
                                    </div>
                                </div>
                                <div class="pd-r0 tx-l col s7 pd-l14">
                                    <h5 class="nome">
                                        <div class="nome_tx"><span><?php echo $_SESSION["usuario"]["nome"];?></span></div>
                                    </h5>
                                    <i class="material-icons meritos-perfil">star_half</i><i class="material-icons meritos-perfil">check_circle</i>
                                </div>

                            </div>
                            <div class="row" id="borda_perfil">
                                <div class="col s12 borda_perfil">
                                </div>
                            </div>

                            <div class="row perfil-btns">
                                <div class="col s6">
                                    <a id="credibilidade-usuario-btn" class="btn-generic"><i class="material-icons">star_half</i></a>
                                    <br>
                                    <span>Credibilidade</span>
                                </div>
                                <div class="col s6">
                                    <a id="produtos-usuario-btn" class="produtos-usuario-btn btn-generic"><i class="material-icons">shopping_basket</i></a>
                                    <br>
                                    <span>Produtos</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div id="descobrir" class="col s12 swiper-slide">
                <div class="row">
                    <div class="descobrir_tab col s12">

                        <h4 class="titulo_tab">Descobrir</h4>

                        <a id="filtro-btn" class="btn-generic set_btn">
                            <i class="font18em material-icons">settings</i>
                        </a>
                        
                        <div id="cards">
                             <!--<div class="cards swiper-no-swiping">

                                <div class="card-imgs tx-c card-imagens swiper-no-swiping">
                                    <div class="swiper-wrapper">
                                        <div id="card-view-img1" class="swiper-slide r"><img id="card-imagem1" class="i" src="View/img/camiseta.jpg" alt=""></div>
                                        <div id="card-view-img2" class="swiper-slide r"><img id="card-imagem2" class="i" src="View/img/camiseta.jpg" alt=""></div>
                                        <div id="card-view-img3" class="swiper-slide r"><img id="card-imagem3" class="i" src="View/img/camiseta.jpg" alt=""></div>
                                    </div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>

                                </div>

                                <div class="card-dados row swiper-no-swiping">
                                    <div class="col s3"></div>
                                    <div class="col s9"><span class="card-dadosNome">Jonh Connor<span>-7KM</span></span></div>

                                </div>
                                <div class="dados swiper-no-swiping">
                                    <img id="perfis-btn" src="/View/img/rai.jpg" alt="">
                                    <span>
                                        <i class="meritos-perfil material-icons">star_half</i>
                                        <i class="meritos-perfil material-icons">check_circle</i>
                                    </span>
                                </div>
                            </div>
                        -->
                        </div>
                        <div class="action-btns bt-8">
                            <button id="btn-rever" class="btn-p swiper-no-swiping">
                                <i class="btn-rever material-icons">replay</i>
                            </button>
                            <button id="btn-deslike" class="btn-g swiper-no-swiping">
                                <i class="btn-deslike material-icons">close</i>
                            </button>
                            <button id="btn-like" class="btn-g swiper-no-swiping">
                                <i class="btn-like material-icons">favorite</i>
                            </button>
                            <button id="btn-superlike" class="btn-p swiper-no-swiping">
                                <i class="btn-superlike material-icons">grade</i>
                            </button>
                        </div>


                    </div>
                </div>
            </div>

            <div id="mensagens" class="col s12 swiper-slide">

                <div class="row">
                    <div class="combinacoes_tab col s12">

                        <h4 class="titulo_tab fixed">Combinações</h4>
                        <div id="msgs">

                            <div class="combinacoes_msg_card">
                                <div class="row">
                                    <div class="col s3">
                                        <div class="pic_msgs"><img src="/View/img/rai.jpg" alt=""></div>
                                    </div>
                                    <div class="dados_msgs col s8">
                                        <span class="nome_msg">Raimundo Nonato</span>

                                        <br>
                                        <span class="ultima_msg">Para para paradise, uhhhhh uhhhh uhh aaaaaa</span>
                                        <span class="hora_msg">18:54 - 7Km</span>
                                    </div>
                                    <div class="col s1">
                                        <div class="msg_nãolida"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="col s12 tabs swiper-pagination swiper-no-swiping">
        </div>
    </div>

    <!-- Abas de confirmação // Menu -->
    <div id="confirmarFotoPerfil">
        <div class="row tx-c">
            <div class="col s12">
                <div class="pic-preview"><img id="fotoPerfilPreview" src="" alt=""></div>
            </div>
            <div class="btns">
                <div class="col s5 tx-r">
                    <a id="rejeitarFoto" class="btn-generic"><i class="material-icons">close</i></a>
                </div>
                <div class="col s2"></div>
                <div class="col s5 tx-l">
                    <a id="confirmarFoto" class="btn-generic"><i class="material-icons">check</i></a>
                </div>
            </div>
        </div>
    </div>

    <div id="confirmarDeslogar">
        <div class="row tx-c">
            <div class="btns">
                <div class="col s12 title">Deslogar</div>
                <div class="col s6 tx-r">
                    <a id="rejeitarLogout" class="btn-generic">Não</a>
                </div>
                <div class="col s6 tx-l">
                    <a id="confirmarLogout" href="/deslogar" class="btn-generic">Sim</a>
                </div>
            </div>
        </div>
    </div>

    <div id="menu-burguer" class="out-tab">
        <div class="main">
            <div class="titulo_tab fixed">
                <a id="burguerBtn-voltar" class=""><i class=" material-icons">chevron_left</i></a>
                <h4 class="">Opções</h4>
            </div>
            <div class="btn-burguer">
                <input type="file" accept=".jpg,.png,.jpeg" name="fileToUpload" id="fotoPerfilUpload">
                <label for="fotoPerfilUpload">
                    <a id="" class="burguer-option">Alterar foto de perfil</a>
                </label>
            </div>
            <a id="" class="burguer-option">Verificar conta</a>
            <a id="deslogarBtn" class="burguer-option">Deslogar</a>
        </div>
        <div id="menu-burguer-side" class="side"></div>
    </div>
    <!-- ///////////////////////// -->
    <!-- Abas acessadas pelo Perfil -->
    <form id="adicionar-produtoForm" action="" method="post" enctype="multipart/form-data">
        <div id="adicionar-produto" class="produto-tab out-tab">
            <div class="titulo_tab fixed">
                <a id="adicionar-produto-btn-voltar" class=""><i class=" material-icons">chevron_left</i></a>
                <h4 class="pd-r0">Adicionar Produto</h4>
                <button type="submit" value="Upload Image" name="submit" class="btn-check"><i class="material-icons">check</i></button>
            </div>
            <div class="row">
                <div class="removerImagem">
                    <a id="remover1"><i class="font18em material-icons">close</i></a>
                </div>
                <div class="removerImagem">
                    <a id="remover2"><i class="font18em material-icons">close</i></a>
                </div>

                <div class="criar-produto-imgs">
                    <div class="img-g">
                        <input type="file" accept=".jpg,.png,.jpeg" name="fileToUpload" id="fileToUpload">
                        <label for="fileToUpload">
                            <div id="img-preview">
                                <img id="previewUpload" src="" alt="">
                            </div>
                        </label>
                    </div>
                    <div class="img-p">
                        <div>
                            <input type="file" accept=".jpg,.png,.jpeg" name="fileToUpload1" id="fileToUpload1"
                                disabled>
                            <label for="fileToUpload1">
                                <div id="img-preview1" class="label-disabled">
                                    <img id="previewUpload1" src="" alt="">
                                </div>
                            </label>
                        </div>
                        <div>
                            <input type="file" accept=".jpg,.png,.jpeg" name="fileToUpload2" id="fileToUpload2"
                                disabled>
                            <label for="fileToUpload2">
                                <div id="img-preview2" class="label-disabled">
                                    <img id="previewUpload2" src="" alt="">
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="input-field col s12">
                        <input id="nomeProduto" placeholder="Nome do Produto" type="text" class="validate">
                    </div>
                    <div class="input-field col s12">
                        <textarea id="descricao" placeholder="Descrição" class="materialize-textarea"></textarea>
                    </div>
                    <div class="input-field col s6">
                        <select id="sexo">
                            <option value="1" selected="selected">Masculino</option>
                            <option value="2">Feminino</option>
                        </select>
                        <label>Sexo</label>
                    </div>
                    <div class="input-field col s6">
                        <select id="categoria">
                            <option value="1">Infantil</option>
                            <option value="2" selected="selected">Adulto</option>
                        </select>
                        <label>Categoria</label>
                    </div>
                    <div class="input-field col s6">
                        <select id="tipo">
                            <option value="1" selected="selected">Roupas</option>
                            <option value="2">Acessórios</option>
                            <option value="3">Calçados</option>
                        </select>
                        <label>Tipo</label>
                    </div>
                    <div class="input-field col s6">
                        <select id="estado">
                            <option value="1" selected="selected">Novo</option>
                            <option value="2">Usado</option>
                        </select>
                        <label>Estado</label>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    <form id="editar-produtoForm" action="" method="post" enctype="multipart/form-data">
        <div id="editar-produto" style="" class="produto-tab out-tab">
            <div class="titulo_tab fixed">
                <a id="editar-produto-btn-voltar" class=""><i class=" material-icons">chevron_left</i></a>
                <h4 class="pd-r0">Editar Produto</h4>
                <input hidden id="idProdutoEditar">
                <button type="submit" value="Upload Image" name="submit" class="btn-check"><i class="material-icons">check</i></button>
            </div>
            <div class="row">
                <div class="removerImagem">
                    <a id="remover3"><i class="font18em material-icons">close</i></a>
                </div>
                <div class="removerImagem">
                    <a id="remover4"><i class="font18em material-icons">close</i></a>
                </div>
                <div class="criar-produto-imgs">
                <div class="img-g">
                        <input type="file" accept=".jpg,.png,.jpeg" name="fileToUpload3" id="fileToUpload3">
                        <label for="fileToUpload3">
                            <div id="img-preview3">
                                <img id="previewUpload3" src="" alt="">
                            </div>
                        </label>
                    </div>
                    <div class="img-p">
                        <div>
                            <input type="file" accept=".jpg,.png,.jpeg" name="fileToUpload4" id="fileToUpload4">
                            <label for="fileToUpload4">
                                <div id="img-preview4" class="">
                                    <img id="previewUpload4" src="" alt="">
                                </div>
                            </label>
                        </div>
                        <div>
                            <input type="file" accept=".jpg,.png,.jpeg" name="fileToUpload5" id="fileToUpload5" disabled>
                            <label for="fileToUpload5">
                                <div id="img-preview5" class="label-disabled">
                                    <img id="previewUpload5" src="" alt="">
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="input-field col s12">
                        <input id="editarNome" type="text" placeholder="Nome do Produto" class="validate">
                    </div>
                    <div class="input-field col s12">
                        <textarea id="editarDescricao" placeholder="Descrição" class="materialize-textarea"></textarea>
                    </div>
                    <div class="input-field col s6">
                        <select id="editarSexo">
                            <option value="1">Masculino</option>
                            <option value="2">Feminino</option>
                        </select>
                        <label>Sexo</label>
                    </div>
                    <div class="input-field col s6">
                        <select id="editarCategoria">
                            <option value="1">Infantil</option>
                            <option value="2">Adulto</option>
                        </select>
                        <label>Categoria</label>
                    </div>
                    <div class="input-field col s6">
                        <select id="editarTipo">
                            <option value="1">Roupas</option>
                            <option value="2">Acessórios</option>
                            <option value="3">Calçados</option>
                        </select>
                        <label>Tipo</label>
                    </div>
                    <div class="input-field col s6">
                        <select id="editarEstado">
                            <option value="1">Usado</option>
                            <option value="2">Novo</option>
                        </select>
                        <label>Estado</label>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div id="visualizar-produtoUsuario" style="" class="visualizar-produtoUsuario-tab view-tab">
        <div class="titulo_tab">
            <a id="visualizar-produtoUsuario-btn-voltar" class=""><i class=" material-icons">chevron_left</i></a>
        </div>
        <div class="produto-imagens">
            <div id="visualizarImagens" class="swiper-wrapper">
                <div id="produto-view-img1" class="swiper-slide"><img id="produto-imagem1" src="View/img/camiseta.jpg" alt=""></div>
                <div id="produto-view-img2" class="swiper-slide"><img id="produto-imagem2" src="View/img/camiseta.jpg" alt=""></div>
                <div id="produto-view-img3" class="swiper-slide"><img id="produto-imagem3" src="View/img/camiseta.jpg" alt=""></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="info mg-0 row">
            <a id="" class="dono"><i class=" material-icons">person</i><span id="visualizaProdutoDono">Luis Henrique Jacinto</span></a>
            <div class="col s12">
                <h4 id="visualizaProdutoNome" class="nome-p">Camiseta Azul Manga Curta</h4>
                <div class="divisoria"></div>
            </div>

            <div class="tx-l col s12">
                <span id="visualizaProdutoDescricao">Camiseta XXXXXX, tamanho M, cor Azul, produzida em poliester.</span>
                <div class="divisoria"></div>
            </div>

            <div id="visualizarProdutoTags" class="tx-l col s12">
                <span >TAGS:</span>
                <span class="tag">MASCULINA</span>
                <span class="tag">INFANTIL</span>
                <span class="tag">ROUPA</span>
                <span class="tag">USADA</span>
                <span class="tag">NOVA</span>
                <div class="divisoria"></div>
            </div>

        </div>
    </div>

    <div id="produtos-usuario" class="produtos-usuario-tab out-tab">
        <div class="titulo_tab fixed">
            <a id="produtos-usuario-btn-voltar" class=""><i class=" material-icons">chevron_left</i></a>
            <h4 class="">Meus Produtos</h4>
        </div>
        <div id="produtos-user-preloader">
            <div  class="preloader-wrapper active">
                <div class="spinner-layer">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
                </div>
            </div>
        </div>
        <div id="produtos-user" class="div_produtos">
            <div class="no_produtos">
                <span>Você não possui produtos!</span>
                <div class="divisoria"></div>
            </div>

            <div id="produtos" class="produtos">
                <!--
                <div id="produto" class="produto">
                    <div class="row">
                        <div class="col s4 visualizar-produto">
                            <div class="produto_imagem">
                                <img class="" src="/View/img/camiseta.jpg">
                            </div>
                        </div>
                        <div class="produto_info col s6 visualizar-produto">
                            <span class="nome_produto">Camisa Azul Manga Curta</span>
                            <br>
                            <i class="material-icons icons">remove_red_eye</i>
                            <span>0</span>
                            <i class="material-icons icons">favorite</i>
                            <span>0</span>
                        </div>
                        <div id="editarProduto_btn" class="btn-generic col s2">
                            <a class="editar-produto-btn"><i class="material-icons">create</i></a>
                        </div>
                    </div>
                </div>
            -->
            </div>

        </div>
        <a id="addProduto_btn" class="addProduto_btn btn-generic">
            <i class="material-icons">add</i>
        </a>
    </div>

    <div id="credibilidade-usuario" class="produtos-usuario-tab out-tab">
        <div class="titulo_tab fixed">
            <a id="credibilidade-usuario-btn-voltar" class=""><i class=" material-icons">chevron_left</i></a>
            <h4 class="">Crediblidade</h4>
        </div>
        <br>
        <div class="row">
            <div class=" dados-credibilidade pd-l0 pd-r0 col s12">
                <div class="col s4">
                    <i class="material-icons">star_half</i>
                </div>
                <div class="credibilidade-atual tx-l pd-l0 col s8">
                    <?php 
                        $credibilidade=$_SESSION["usuario"]["credibilidade"];
                        $credibilidadeNome="";
                        $credibilidadeLimite="";
                        $credibilidadePorcentagem="";
                        if($credibilidade<20){
                            $credibilidadeNome="BRONZE";
                            $credibilidadePorcentagem=($credibilidade/20)*100;
                            $credibilidadeLimite=20;   
                        }else if($credibilidade<100){
                            $credibilidadeNome="PRATA";
                            $credibilidadePorcentagem=($credibilidade-20/80)*100;
                            $credibilidadeLimite=100;
                        }else if($credibilidade<160){
                            $credibilidadeNome="OURO";
                            $credibilidadePorcentagem=($credibilidade-100/60)*100;
                            $credibilidadeLimite=160;
                        }else if($credibilidade<300){
                            $credibilidadeNome="PLATINA";
                            $credibilidadePorcentagem=($credibilidade-160/140)*100;
                            $credibilidadeLimite=300;
                        }else if($credibilidade<1000){
                            $credibilidadeNome="DIAMANTE";
                            $credibilidadePorcentagem=($credibilidade-300/700)*100;
                            $credibilidadeLimite=1000;
                        }
                    ?>
                    <span><?php echo("NIVEL ".$credibilidadeNome);?></span>
                    <br>
                    <span><?php echo($credibilidade."/".$credibilidadeLimite."XP");?></span>
                </div>
                <div class="col s1"></div>
                <div class="col pd-0 s10">
                    <div class="barraDeXP">
                        <div class="xp-atual" style="width:<?php echo($credibilidadePorcentagem.'%');?>"></div>
                    </div>
                </div>
                <div class="col s1"></div>
            </div>
        </div>
    </div>
    <!-- ///////////////////////// -->
    <!-- Abas acessadas pelo Descobir -->
    <div id="filtro" class="busca_tab out-tab">
        <div class="titulo_tab">
            <a id="filtro-btn-voltar" class=""><i class=" material-icons">chevron_left</i></a>
            <h4 class="">Filtro de Busca</h4>
        </div>

        <div class="row">
            <div class="col s1 "></div>
            <div class="col s10 corpo">

                <h5 class="titulo_filtro">Distância: <span id="span-value"></span></h5>

                <input id="input-dist" type="range" name="dist" min="0" max="150">

                <div class="divisoria"></div>

                <h5 class="titulo_filtro">Sexo:</h5>
                <div class="row switch">
                    <div class="col s9">
                        <span class="">MASCULINA</span>
                    </div>
                    <div class="col s3">
                        <label>
                            <input id="switch-masculina" type="checkbox">
                            <span class="lever"></span>
                        </label>
                    </div>
                    <div class="col s9">
                        <span class="">FEMININA</span>
                    </div>
                    <div class="col s3">
                        <label>
                            <input id="switch-feminina" type="checkbox">
                            <span class="lever"></span>
                        </label>
                    </div>
                </div>
                <div class="divisoria"></div>

                <h5 class="titulo_filtro">Categoria:</h5>
                <div class="row switch">
                    <div class="col s9">
                        <span class="">INFANTIL</span>
                    </div>
                    <div class="col s3">
                        <label>
                            <input id="switch-infantil" type="checkbox">
                            <span class="lever"></span>
                        </label>
                    </div>
                    <div class="col s9">
                        <span class="">ADULTO</span>
                    </div>
                    <div class="col s3">
                        <label>
                            <input id="switch-adulto" type="checkbox">
                            <span class="lever"></span>
                        </label>
                    </div>
                </div>
                <div class="divisoria"></div>

                <h5 class="titulo_filtro">Tipo:</h5>
                <div class="row switch">
                    <div class="col s9">
                        <span class="">ROUPAS</span>
                    </div>
                    <div class="col s3">
                        <label>
                            <input id="switch-roupa" type="checkbox">
                            <span class="lever"></span>
                        </label>
                    </div>
                    <div class="col s9">
                        <span class="">ACESSORIOS</span>
                    </div>
                    <div class="col s3">
                        <label>
                            <input id="switch-acessorio" type="checkbox">
                            <span class="lever"></span>
                        </label>
                    </div>
                    <div class="col s9">
                        <span class="">CALÇADOS</span>
                    </div>
                    <div class="col s3">
                        <label>
                            <input id="switch-calcado" type="checkbox">
                            <span class="lever"></span>
                        </label>
                    </div>
                </div>
                <div class="divisoria"></div>

                <h5 class="titulo_filtro">Estado:</h5>
                <div class="row switch">
                    <div class="col s9">
                        <span class="">USADA</span>
                    </div>
                    <div class="col s3">
                        <label>
                            <input id="switch-usada" type="checkbox">
                            <span class="lever"></span>
                        </label>
                    </div>
                    <div class="col s9">
                        <span class="">NOVA</span>
                    </div>
                    <div class="col s3">
                        <label>
                            <input id="switch-nova" type="checkbox">
                            <span class="lever"></span>
                        </label>
                    </div>
                </div>
                <div class="divisoria"></div>

            </div>
            <div class="col s1 "></div>
        </div>
    </div>

    <div id="perfis" class="produtos-usuario-tab out-tab">
        <div class="titulo_tab fixed">
            <a id="perfis-btn-voltar" class=""><i class=" material-icons">chevron_left</i></a>
            <h4 class="">Perfis aleatorios</h4>
        </div>
        <br>
        <div class="row">
            <div class="perfil_dados col s12">
                <div class="col s3 pd-r0">
                    <div class="pic">
                        <img src="/View/img/random.jpg" alt="">
                    </div>
                </div>
                <div class="pd-r0 tx-l col s8">
                    <h5 class="nome">
                        <div class="nome_tx"><span>John Connor</span></div>
                    </h5>
                    <i class="material-icons meritos-perfil">star_half</i><i class="material-icons meritos-perfil">check_circle</i>
                </div>
                <div class="tituloProdutos col s12">
                    <div class="divisoria"></div>
                    <span>Produtos</span>
                </div>
            </div>
            <div class="perfis-produtos div_produtos col s12 pd-0">
                <div class="no_produtos">
                    <span>Esse usuario não possui produtos!</span>
                    <div class="divisoria"></div>
                </div>

                <div class="produtos">

                    <div id="produto" class="produto">
                        <div class="row">
                            <div class="col s4 visualizar-produto">
                                <div class="produto_imagem">
                                    <img class="" src="">
                                </div>
                            </div>
                            <div class="produto_info col s7 visualizar-produto">
                                <span class="nome_produto">Camisa Azul Manga Curta</span>
                                <br>
                                <i class="material-icons icons">remove_red_eye</i>
                                <span>0</span>
                                <i class="material-icons icons">favorite</i>
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="action-btns bt-2">
                <button id="btn-deslike2" class="btn-g swiper-no-swiping">
                    <i class="btn-deslike material-icons">close</i>
                </button>
                <button id="btn-superlike2" class="btn-p swiper-no-swiping">
                    <i class="btn-superlike material-icons">grade</i>
                </button>
                <button id="btn-like2" class="btn-g swiper-no-swiping">
                    <i class="btn-like material-icons">favorite</i>
                </button>
            </div>
        </div>
    </div>
    <!-- ///////////////////////// -->
    <!-- Abas acessadas pelo Mensagens -->
    <div id="conversa" class="chat out-tab">


        <form action="" id="enviarMensagem" >
            <div class="row">
                <div class="col s10"><input class="writeMsg mg-0" placeholder="Digite sua mensagem..." id="" type="text" class="validate"></div>
                <div class="col s2"><button type="submit"  value="" name="submit" class="btn-generic sendMsg"><i class="material-icons">send</i></button></div>
            </div>
        </form>
    </div>
    <!-- ///////////////////////// -->
</body>