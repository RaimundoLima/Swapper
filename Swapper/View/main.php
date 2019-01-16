<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>
<body>

    <div class="row">
        <div id="test1" class="col s12">

             <div class="row">
                <div class="perfil_tab col s12">
                
                    <h4 class="titulo_tab" >Perfil</h4>
                    <br>
                    
                    <div class="col s1"></div>
                    <div class="perfil_dados col s10">
                        
                        <div class="pic">
                            <img src="/View/img/luis.jpg" alt="">
                        </div>

                        
                        <h5 class="nome">Luis Henrique Jacinto</h5>
                        <h6 class="cidade">Rio Grande, RS</h6>

                        <div class="editarBtn_perfil">
                            <a class="btn-floating btn-large"><i class="font18em material-icons">create</i></a>
                            <br>
                            <span>Editar Perfil</span>
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
                                            <span>Camisa Azul Manga Curta</span>
                                            <br>
                                            <i class="material-icons">remove_red_eye</i>
                                            <span>0</span>
                                            <i class="material-icons">favorite</i>
                                            <span>0</span>
                                        </div>
                                    </div>
                                    <div class="divisoria"></div>
                                </div>

                            </div>
                        
                        <br>

                            <div class="adicionarBtn_perfil">
                                <a class="btn-floating btn-large "><i class="font18em material-icons">add</i></a>
                                <br>
                                <span>Adicionar Produto</span>
                            </div>

                        </div>

                        <br>

                    </div>
                    <div class="col s1"></div>

                </div>
            </div>
        </div>

        <div id="test2" class="col s12">

            <h4 class="titulo_tab" >Explorar</h4>
                
            <div class="row">
                <div class=" col s12 m7">
                    <div class="card">
                        <div class="card-content">
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div id="test3" class="col s12">

            <div class="row">
                <div class="combinacoes_tab col s12">
                
                <h4 class="titulo_tab" >Combinações</h4>
                <div id="msgs">
                
                    <div class="combinacoes_msg_card">
                        <div class="row">
                            <div class="col s3">
                                <div class="pic_msgs"><img src="/View/img/rai.jpg" alt=""></div> 
                            </div>
                            <div class="dados_msgs col s8">
                                <span class="nome_msg">Raimundo Nonato</span>
                                <br>
                                <div class="ultima_msg"><span class="msg_text">Para para paradise, uhhhhh uhhhh uhh aaaaaa</span></div>
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
                    <i class="medium material-icons">account_circle</i>
                </a></li>
                <li class=" tab col s4"><a id="explore_btn" class=" active" href="#test2">  
                    <i class="medium material-icons">explore</i>
                </a></li>
                <li class=" tab col s4"><a id="match_btn" href="#test3">  
                    <i class="medium material-icons">chat</i>
                </a></li>
            </ul>
        </div>
    </div>

</body>
<?php include("footer.php"); ?>
</html>