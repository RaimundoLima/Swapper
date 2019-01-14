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
                        <img src="/View/img/rai.jpg" alt="">
                    </div>

                    
                    <h5 class="nome">Rai Lima</h5>
                    <h6 class="cidade">Rio Grande, RS</h6>

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
                        <div class="pic col s3">
                            <img src="/View/img/rai.jpg" alt="">
                        </div>
                        <div class="dados_msg col s9">
                            <h6 class="nome_msg">Raimundo Nonato</h6>
                            <span class="ultima_msg">Oi eu sou Raimundo Nonato</span>
                            <br>
                            <span class="hora_msg">18:54 - 7Km</span>
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