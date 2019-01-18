<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>
<body>

    <div class="row">
        <div id="test1" class="col s12">

             <div class="row">
                <div class="perfil_tab col s12">
                
                    <h4 class="titulo_tab fixed" >Perfil</h4>
                    <br>                    
                    <div class="perfil_dados col s12">
                        <div class="row">
                            <div class="col s3 pd-r0">
                                <div class="pic">
                                    <img src="/View/img/luis.jpg" alt="">
                                </div>
                            </div>
                            <div class="pd-r0 col s7">
                                <h5 class="nome">
                                    <div class="nome_tx"><span>Luis Henrique Jacinto</span></div><i class="tiny material-icons">check_circle</i>
                                </h5>
                                
                                <h6 class="cidade">Rio Grande, RS</h6>
                            </div>
                            <div class="editarBtn_perfil col s2">
                                <a class=""><i class="font18em material-icons icons">create</i></a>  
                            </div>
                        </div>
                        

                        <div class="row" id="borda_perfil" >
                            <div class="col s12 borda_perfil">
                            </div>
                        </div>

                        <h5 class="titulo_produtos">Produtos</h5>
                        
                        <br>
                        <div class="divisoria"></div>

                        <div id="produtos_usuario" class="div_produtos" >
                            <div class="no_produtos">
                                <span>Você não possui produtos!</span>
                                <div class="divisoria"></div>
                            </div> 

                            <div class="produtos">

                                <div class="produto">
                                    <div class="row">
                                        <div class="col s4">
                                            <div class="produto_imagem">
                                                <img class="" src="/View/img/camiseta.jpg">
                                            </div>
                                        </div>
                                        <div class="produto_info col s8">
                                            <span class="nome_produto">Camisa Azul Manga Curta</span>
                                            <br>
                                            <i class="material-icons icons">remove_red_eye</i>
                                            <span>0</span>
                                            <i class="material-icons icons">favorite</i>
                                            <span>0</span>
                                        </div>
                                    </div>
                                    <div class="divisoria"></div>
                                </div>

                            </div>
                            <br>
                            <div class="adicionarBtn_perfil">
                                <a class="btn-floating btn-large "><i class="font18em material-icons icons">add</i></a>
                                <br>
                                <span>Adicionar Produto</span>
                            </div>

                        </div>

                        <br>

                    </div>

                </div>
            </div>
        </div>

        <div id="test2" class="col s12">

            <div class="row">
                <div class="descobrir_tab col s12">

                    <h4 class="titulo_tab" >Descobrir</h4>
                    
                    <div class="descobrir_btns">
                        <a class="favoritos_btn">
                            <i class="font18em material-icons">favorite</i>
                        </a>

                        <a class="set_btn">
                            <i class="font18em material-icons">settings</i>
                        </a>
                        
                    </div>

                    <div class="cards">

                    </div>


                </div>
            </div>

        </div>

        <div id="test3" class="col s12">

            <div class="row">
                <div class="combinacoes_tab col s12">
                
                    <h4 class="titulo_tab fixed" >Combinações</h4>
                    <div id="msgs">
                
                        <div class="combinacoes_msg_card">
                            <div class="row">
                                <div class="col s3">
                                    <div class="pic_msgs"><img src="/View/img/rai.jpg" alt=""></div> 
                                </div>
                                <div class="dados_msgs col s8">
                                    <span class="nome_msg">Raimundo Nonato</span>
                                    <i class="tiny material-icons">check_circle</i>
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
        <div class="col s12">
            <ul class="tabs">
                <li class="tab col s4"><a id="perfil_tbn" href="#test1">
                    <i class="medium material-icons icons">account_circle</i>
                </a></li>
                <li class=" tab col s4"><a id="explore_btn" class=" active" href="#test2">  
                    <i class="medium material-icons icons">explore</i>
                </a></li>
                <li class=" tab col s4"><a id="match_btn" href="#test3">  
                    <i class="medium material-icons icons">chat</i>
                </a></li>
            </ul>
        </div>
    </div>



                    <div class="busca_tab">  

                        <div class="titulo_tab">
                            <a class=""><i class=" material-icons">chevron_left</i></a>
                            <h4 class="">Filtro de Busca</h4>
                        </div>
                        
                        

                        <div class="row">
                            <div class="col s1 "></div>
                            <div class="col s10 corpo">

                                <h5 class="titulo_filtro mg17em">Distância:</h5>
                                <div class="range-field range-values">
                                    <input type="range" min="1" max="150" />
                                    <div class="row">
                                        <div class="col s6 tx-l">1km</div>
                                        <div class="col s6 tx-r">150km</div>
                                    </div>
                                </div>
                                

                                <h5 class="titulo_filtro">Sexo:</h5>


                               <p>
                                <label>
                                    <input type="checkbox" class="filled-in op-sexo1"/>
                                    <span>Filled in</span>
                                </label>
                                </p><p>
                                <label>
                                    <input type="checkbox" class="filled-in op-sexo1"/>
                                    <span>Filled in</span>
                                </label>
                                </p><p>
                                <label>
                                    <input type="checkbox" class="filled-in op-sexo2" checked/>
                                    <span>Filled in</span>
                                </label>
                                </p>

                                <div class="select-sexo">
                                    <input type="checkbox" name="m" id="masculino"/>
                                    <input type="checkbox" name="f" id="feminino"/>
                                    <input type="checkbox" name="t" id="todos1" checked/>

                                    <label for="masculino">MASCULINO</label>
                                    <label for="feminino">FEMININO</label>
                                    <label for="todos1">TUDO</label>
                                </div>
                                
                                <h5 class="titulo_filtro">Categoria:</h5>
                                <div class="select-categoria">
                                    <input type="checkbox" name="i" id="infantil"/>
                                    <input type="checkbox" name="a" id="adulto" />
                                    <input type="checkbox" name="t" id="todos2" checked/>

                                    <label for="infantil">INFANTIL</label>
                                    <label for="adulto">ADULTO</label>
                                    <label for="todos2">TUDO</label>
                                </div>

                                <h5 class="titulo_filtro">Tipo:</h5>
                                <div class="select-tipo">
                                    <input type="checkbox" name="r" id="roupas"/>
                                    <input type="checkbox" name="a" id="acessorios" />
                                    <input type="checkbox" name="c" id="calcados"/>
                                    <input type="checkbox" name="t" id="todos3" checked/>

                                    <label for="roupas">ROUPAS</label>
                                    <label for="acessorios">ACESSORIOS</label>
                                    <label for="calcados">CALÇADOS</label>
                                    <label for="todos3">TUDO</label>
                                </div>

                                <h5 class="titulo_filtro">Estado:</h5>
                                <div class="select-estado">
                                    <input type="checkbox" name="u" id="usada"/>
                                    <input type="checkbox" name="n" id="nova" />
                                    <input type="checkbox" name="t" id="todos4" checked/>

                                    <label for="usada">USADA</label>
                                    <label for="nova">NOVA</label>
                                    <label for="todos4">TUDO</label>
                                </div>


                                <div class="divisoria"></div>
                            </div>
                            <div class="col s1 "></div>
                        </div>

                    </div>

</body>
<?php include("footer.php"); ?>
</html>