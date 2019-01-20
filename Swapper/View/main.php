<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>
<body>

    <div class="row swiper-container">
        <div class="swiper-wrapper">
            <div id="test1" class="col s12 swiper-slide">

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

            <div id="test2" class="col s12 swiper-slide">

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

                            <div class="card-imgs">
                                
                            </div>
                            
                            <div class="card-dados row">
                                <div class="col s3"></div>
                                <div class="col s9"><span class="card-dadosNome">Luis Henrique 7Km</span></div>
                                
                            </div>
                            <div class="dados">
                                <img src="/View/img/luis.jpg" alt="">
                                <i class="material-icons">check_circle</i>            
                            </div>
                        </div>

                        <div class="action-btns">
                                <a class="btn-p">
                                    <i class="btn-rever material-icons">replay</i>
                                </a>
                                <a class="btn-g">
                                    <i class="btn-deslike material-icons">close</i>
                                </a>
                                <a class="btn-g">
                                    <i class="btn-like material-icons">favorite</i>
                                </a>
                                <a class="btn-p">
                                    <i class="btn-superlike material-icons">grade</i>
                                </a>
                        </div>


                    </div>
                </div>

            </div>

            <div id="test3" class="col s12 swiper-slide">

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
        </div>
        <div class="col s12">
            <ul class="tabs swiper-pagination">
                <li class="tab col s4"><a id="perfil_tbn" href="#test1">
                    <i class="medium material-icons icons">account_circle</i>
                </a></li>
                <li class=" tab col s4"><a id="explore_btn" class=" active" href="#test2">  
                    <i class="medium material-icons icons">explore</i>
                </a></li>
                <li class=" tab  col s4"><a id="match_btn" href="#test3">  
                    <i class="medium material-icons icons">chat</i>
                </a></li>
            </ul>
        </div>
    </div>

</body>
<?php include("footer.php"); ?>
</html>