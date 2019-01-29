<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>

<body>

    <div class="row swiper-container main-container">
        <div class="swiper-wrapper">
            <div id="perfil" class="col s12 swiper-slide">

                <div class="row">
                    <div class="perfil_tab col s12">

                        <h4 class="titulo_tab fixed">Perfil</h4>
                        <br>
                        <div class="perfil_dados col s12">
                            <div class="row">
                                <div class="col s3 pd-r0">
                                    <div class="pic">
                                        <img src="/View/img/luis.jpg" alt="">
                                    </div>
                                </div>
                                <div class="pd-r0 tx-l col s7">
                                    <h5 class="nome">
                                        <div class="nome_tx"><span>Luis Henrique Jacinto</span></div>
                                    </h5>
                                    <i class="tiny material-icons">star_half</i><i class="tiny material-icons">check_circle</i>
                                </div>
                                <div class="editarBtn_perfil col s2">
                                    <a class=""><i class="font18em material-icons icons">create</i></a>
                                </div>
                            </div>
                            <div class="row" id="borda_perfil">
                                <div class="col s12 borda_perfil">
                                </div>
                            </div>

                            <div class="row perfil-btns">
                                <div class="col s6">
                                    <a id="" class=""><i class="material-icons">star_half</i></a>
                                    <br>
                                    <span>Credibilidade</span>
                                </div>
                                <div class="col s6">
                                    <a id="produtos-usuario-btn" class="produtos-usuario-btn"><i class="material-icons">shopping_basket</i></a>
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

                        <a id="filtro-btn" class="set_btn">
                            <i class="font18em material-icons">settings</i>
                        </a>

                        <div class="cards swiper-no-swiping">

                            <div class="card-imgs swiper-no-swiping">

                            </div>

                            <div class="card-dados row swiper-no-swiping">
                                <div class="col s3"></div>
                                <div class="col s9"><span class="card-dadosNome">Luis Henrique 7Km</span></div>

                            </div>
                            <div class="dados swiper-no-swiping">
                                <img src="/View/img/luis.jpg" alt="">
                                <i class="material-icons">check_circle</i>
                            </div>
                        </div>

                        <div class="action-btns">
                            <a class="btn-p swiper-no-swiping">
                                <i class="btn-rever material-icons">replay</i>
                            </a>
                            <a class="btn-g swiper-no-swiping">
                                <i class="btn-deslike material-icons">close</i>
                            </a>
                            <a class="btn-g swiper-no-swiping">
                                <i class="btn-like material-icons">favorite</i>
                            </a>
                            <a class="btn-p swiper-no-swiping">
                                <i class="btn-superlike material-icons">grade</i>
                            </a>
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

    <!-- Abas acessadas pelo Perfil -->
    <div id="adicionar-produto" class="produto-tab out-tab">
        <div class="titulo_tab fixed">
            <a id="adicionar-produto-btn-voltar" class=""><i class=" material-icons">chevron_left</i></a>
            <h4 class="pd-r0">Adicionar Produto</h4>
            <a class="btn-check"><i class="material-icons">check</i></a>
        </div>
        <div class="row">
            <div class="criar-produto-imgs">
                <div class="img-g">
                    <input type="image" id="" src="/View/img/camiseta.jpg">
                </div>
                <div class="img-p">
                    <div>
                        <input type="image" id="" src="/View/img/camiseta.jpg">                    
                    </div>
                    <div>
                        <input type="image" id="" src="/View/img/camiseta.jpg">                    
                    </div>
                </div>
            </div>
            <div>           
                <div class="input-field col s12">
                    <input id="first_name" type="text" class="validate">
                    <label for="first_name">Nome do Produto</label>
                </div>
                <div class="input-field col s12">
                    <textarea id="textarea1" class="materialize-textarea"></textarea>
                    <label for="textarea1">Descrição</label>
                </div>  
                <div class="input-field col s6">
                    <select>
                    <option value="1">Masculino</option>
                    <option value="2">Feminino</option>
                    </select>
                    <label>Sexo</label>
                </div>
                <div class="input-field col s6">
                    <select>
                    <option value="1">Infantil</option>
                    <option value="2">Adulto</option>
                    </select>
                    <label>Categoria</label>
                </div>
                <div class="input-field col s6">
                    <select>
                    <option value="1">Roupas</option>
                    <option value="2">Acessórios</option>
                    <option value="3">Calçados</option>
                    </select>
                    <label>Tipo</label>
                </div>
                <div class="input-field col s6">
                    <select>
                    <option value="1">Usado</option>
                    <option value="2">Novo</option>
                    </select>
                    <label>Estado</label>
                </div>
            </div> 
        </div>
    </div>

    <div id="editar-produto" class="produto-tab out-tab">
        <div class="titulo_tab fixed">
            <a id="editar-produto-btn-voltar" class=""><i class=" material-icons">chevron_left</i></a>
            <h4 class="pd-r0">Editar Produto</h4>
            <a class="btn-check"><i class="material-icons">check</i></a>
        </div>
        <div class="row">
            <div class="criar-produto-imgs">
                <div class="img-g">
                    <input type="image" id="" alt="" src="">
                </div>
                <div class="img-p">
                    <div>
                        <input type="image" id="" alt="" src="">                    
                    </div>
                    <div>
                        <input type="image" id="" alt="" src="">                    
                    </div>
                </div>
            </div>
            <div>           
                <div class="input-field col s12">
                    <input id="first_name" type="text" class="validate">
                    <label for="first_name">Nome do Produto</label>
                </div>
                <div class="input-field col s12">
                    <textarea id="textarea1" class="materialize-textarea"></textarea>
                    <label for="textarea1">Descrição</label>
                </div>  
                <div class="input-field col s6">
                    <select>
                    <option value="1">Masculino</option>
                    <option value="2">Feminino</option>
                    </select>
                    <label>Sexo</label>
                </div>
                <div class="input-field col s6">
                    <select>
                    <option value="1">Infantil</option>
                    <option value="2">Adulto</option>
                    </select>
                    <label>Categoria</label>
                </div>
                <div class="input-field col s6">
                    <select>
                    <option value="1">Roupas</option>
                    <option value="2">Acessórios</option>
                    <option value="3">Calçados</option>
                    </select>
                    <label>Tipo</label>
                </div>
                <div class="input-field col s6">
                    <select>
                    <option value="1">Usado</option>
                    <option value="2">Novo</option>
                    </select>
                    <label>Estado</label>
                </div>
            </div> 
        </div>
    </div>

    <div id="vizualizar-produtoUsuario" class="vizualizar-produtoUsuario-tab produto-view-tab">
        <div class="titulo_tab">
            <a id="vizualizar-produtoUsuario-btn-voltar" class=""><i class=" material-icons">chevron_left</i></a>
        </div>
        <div class="produto-imagens">
       
        </div>
        <div class="info mg-0 row">
            <div class="col s12">
                <h4>Camiseta Azul Manga Curta</h4>
                <div class="divisoria"></div>
            </div>
            
            <div class="tx-l col s12">
                <span>Camiseta XXXXXX, tamanho M, cor Azul, produzida em poliester.</span>
                <div class="divisoria"></div>
            </div>
            
            <div class="tx-l col s12">
                <span>TAGS:</span>
                <span class="tag">MASCULINA</span>
                <span class="tag">FEMININA</span>
                <span class="tag">INFANTIL</span>
                <span class="tag">ADULTA</span>
                <span class="tag">ROUPA</span>
                <span class="tag">ACESSÓRIO</span>
                <span class="tag">CALÇADO</span>
                <span class="tag">USADA</span>
                <span class="tag">NOVA</span>
                <div class="divisoria"></div>
            </div>
            
        </div>
    </div>

    <div id="produtos-usuario" class="produtos-usuario-tab out-tab">
        <div class="titulo_tab fixed">
            <a id="produtos-usuario-btn-voltar" class=""><i class=" material-icons">chevron_left</i></a>
            <h4 class="">Produtos</h4>
        </div>
        <div class="div_produtos">
            <div class="no_produtos">
                <span>Você não possui produtos!</span>
                <div class="divisoria"></div>
            </div>

            <div class="produtos">

                <div id="produto" class="produto">
                    <div class="row">
                        <div class="col s4 vizualizar-produto">
                            <div class="produto_imagem">
                                <img class="" src="/View/img/camiseta.jpg">
                            </div>
                        </div>
                        <div class="produto_info col s6 vizualizar-produto">
                            <span class="nome_produto">Camisa Azul Manga Curta</span>
                            <br>
                            <i class="material-icons icons">remove_red_eye</i>
                            <span>0</span>
                            <i class="material-icons icons">favorite</i>
                            <span>0</span>
                        </div>
                        <div id="editarProduto_btn" class="col s2">
                            <a  class="editar-produto-btn"><i class="material-icons">create</i></a>
                        </div>
                    </div>
                </div>
                -->
            </div>

        </div>
        <a id="addProduto_btn" class="addProduto_btn">
            <i class="material-icons">add</i>
        </a>
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
    <!-- ///////////////////////// -->
    <!-- Abas acessadas pelo Mensagens -->
    <!-- ///////////////////////// -->


</body>
<?php include("footer.php"); ?>
</html>