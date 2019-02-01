var buscaFiltro=0;
var buscaRoupas=0
$(document).ready(function(){
    mySwiper = new Swiper ('.main-container', {
        direction: 'horizontal',
        loop: false,
        speed: 500,
        initialSlide: 1,
        noSwipingClass: 'swiper-no-swiping',
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            bulletElement: 'span',
            clickable: true,
            renderBullet: function (index, className) {
                var tabs = ['account_circle','explore','chat'];
                var nav = ['perfil-nav','descobrir-nav','mensagens-nav'];
                return '<span id="'+nav[index]+'" class="tab col s4 ' + className + '">'+ 
                '<i class="medium material-icons icons">'+tabs[index]+'</i>'+'</span>';
            }
          },
    });
    mySwiper.on('slideChangeTransitionStart', function () {
        if($('#perfil').hasClass('swiper-slide-active') == true){
            $('#perfil-nav').addClass('swiper-pagination-bullet-active');
            $('#descobrir-nav').removeClass('swiper-pagination-bullet-active');
            $('#mensagens-nav').removeClass('swiper-pagination-bullet-active');
        }
        if($('#descobrir').hasClass('swiper-slide-active') == true){
            $('#perfil-nav').removeClass('swiper-pagination-bullet-active');
            $('#descobrir-nav').addClass('swiper-pagination-bullet-active');
            $('#mensagens-nav').removeClass('swiper-pagination-bullet-active');
        }
        if($('#mensagens').hasClass('swiper-slide-active') == true){
            $('#perfil-nav').removeClass('swiper-pagination-bullet-active');
            $('#descobrir-nav').removeClass('swiper-pagination-bullet-active');
            $('#mensagens-nav').addClass('swiper-pagination-bullet-active');
        }
    });

    $('select').formSelect();

    redimensionar();

    $(window).resize(function(){
        redimensionar();
    });
    
    $("#filtro-btn").click(function() {
        buscarFiltro();
        $("#filtro").removeClass("down-up");
        $("#filtro").addClass("up-down");
      });
    $("#filtro-btn-voltar").click(function() {
        atualizarFiltro();
        $("#filtro").removeClass("up-down");
        $("#filtro").addClass("down-up");
        preventDefault()
    });

    // TESTEEEEE ////////////////////////////////////////

    $("#perfis-btn").click(function() {
        botoesAcaoPrincipal(1);
        botoesAcaoSecundario(0);
        $("#perfis").removeClass("down-up");
        $("#perfis").addClass("up-down");
      });
    $("#perfis-btn-voltar").click(function() {
        botoesAcaoPrincipal(0);
        botoesAcaoSecundario(1);
        $("#perfis").removeClass("up-down");
        $("#perfis").addClass("down-up");
        preventDefault()
    });



    ////////////////////////////////////////////////////

    $("#produtos-usuario-btn").click(function() {
        buscarRoupas();
        $("#produtos-usuario").removeClass("right-left-ltab");
        $("#produtos-usuario").addClass("left-right-ltab");
    });
    $("#produtos-usuario-btn-voltar").click(function() {
        $("#produtos-usuario").removeClass("left-right-ltab");
        $("#produtos-usuario").addClass("right-left-ltab");
    });

    $("#addProduto_btn").click(function() {
        inserirRoupas();
        $("#adicionar-produto").removeClass("right-left-ltab");
        $("#adicionar-produto").addClass("left-right-ltab");
    });
    $("#adicionar-produto-btn-voltar").click(function() {
        $("#adicionar-produto").removeClass("left-right-ltab");
        $("#adicionar-produto").addClass("right-left-ltab");
    });

    $(".vizualizar-produto").click(function() {
        $(".vizualizar-produtoUsuario-tab").removeClass("right-left-ltab");
        $(".vizualizar-produtoUsuario-tab").addClass("left-right-ltab");
    });
    $("#vizualizar-produtoUsuario-btn-voltar").click(function() {
        $(".vizualizar-produtoUsuario-tab").removeClass("left-right-ltab");
        $(".vizualizar-produtoUsuario-tab").addClass("right-left-ltab");
    });

    $("#editarProduto_btn").click(function() {
        $("#editar-produto").removeClass("right-left-ltab");
        $("#editar-produto").addClass("left-right-ltab");
    });
    $("#editar-produto-btn-voltar").click(function() {
        $("#editar-produto").removeClass("left-right-ltab");
        $("#editar-produto").addClass("right-left-ltab");
    });


    /*
    $("#filtro-btn").click(function() {
        $("#filtro").removeClass("right-left-ltab");
        $("#filtro").addClass("left-right-ltab");
    });
    $("#filtro-btn-voltar").click(function() {
        $("#filtro").removeClass("left-right-ltab");
        $("#filtro").addClass("right-left-ltab");
    });

    $("#filtro-btn").click(function() {
        $("#filtro").removeClass("left-right-rtab");
        $("#filtro").addClass("right-left-rtab");
    });
    $("#filtro-btn-voltar").click(function() {
        $("#filtro").removeClass("right-left-rtab");
        $("#filtro").addClass("left-right-rtab");
    });*/
});
function inserirRoupas(){
    $.ajax({
        url: '/atualizarFiltro',
        type: 'post',
        dataType: 'json',
        data: {
        }
    }).done(function(){
        //zerar campus tbm
        $("#adicionar-produto").removeClass("left-right-ltab");
        $("#adicionar-produto").addClass("right-left-ltab");
    })
}
function atualizarFiltro(){
    $.ajax({
        url: '/atualizarFiltro',
        type: 'post',
        dataType: 'json',
        data: {
          'distancia':$("#input-dist").val(),
          'masculino':$("#switch-masculina").is(':checked'), 
          'feminino':$("#switch-feminina").is(':checked'), 
          'adulto':$("#switch-adulto").is(':checked'),
          'infantil':$("#switch-infantil").is(':checked'),
          'roupa':$("#switch-roupa").is(':checked'), 
          'acessorio':$("#switch-acessorio").is(':checked'), 
          'calcado':$("#switch-calcado").is(':checked'), 
          'novo':$("#switch-nova").is(':checked'),
          'usado':$("#switch-usada").is(':checked')  
        }
    })
}
function buscarFiltro(){
    if(!buscaFiltro){
        $.ajax({
            url: '/buscarFiltro'
        }).done(function(data){
            var filtro=(JSON.parse(data));
            $("#span-value").text(filtro.distancia+"KM");
            $("#input-dist").val(filtro.distancia);
            $("#switch-masculina").prop('checked',filtro.masculino*1)
            $("#switch-feminina").prop('checked',filtro.feminino*1)
            $("#switch-infantil").prop('checked',filtro.infantil*1)
            $("#switch-adulto").prop('checked',filtro.adulto*1)
            $("#switch-roupa").prop('checked',filtro.roupa*1)
            $("#switch-acessorio").prop('checked',filtro.acessorio*1)
            $("#switch-calcado").prop('checked',filtro.calcado*1)
            $("#switch-usada").prop('checked',filtro.usado*1)
            $("#switch-nova").prop('checked',filtro.novo*1)
            checkSwitchs();
        })
        buscaFiltro=1;
    }
}
function buscarRoupas(){
    if(!buscaRoupas){
        $.ajax({
            url: '/buscarRoupas'
        }).done(function(data){
            console.log(data)
        })
        buscaRoupas=1;
    }
}

function redimensionar(){
    $(".tabs-content").css('height', ($(window).height()*0.90)+'px');
    $(".perfil_tab").css('height', ($(window).height()*0.90)+'px');
    $(".combinacoes_tab").css('height', ($(window).height()*0.90)+'px');
    $(".produto-imagens").css('width', $(window).width()+'px');
    $(".produto-imagens").css('height', $(window).width()+'px');
}

function checkSwitchs(){
    checkSwitchs_Sexo();
    checkSwitchs_Categoria();
    checkSwitchs_Tipo();
    checkSwitchs_Estado();
}

function checkSwitchs_Sexo(){
    if(document.getElementById('switch-masculina').checked == false){
        document.getElementById('switch-feminina').disabled = true;
    }else{
        document.getElementById('switch-feminina').disabled = false;
    }
    if(document.getElementById('switch-feminina').checked == false){
        document.getElementById('switch-masculina').disabled = true;
    }else{
        document.getElementById('switch-masculina').disabled = false;
    }
}
function checkSwitchs_Categoria(){
    if(document.getElementById('switch-infantil').checked == false){
        document.getElementById('switch-adulto').disabled = true;
    }else{
        document.getElementById('switch-adulto').disabled = false;
    }
    if(document.getElementById('switch-adulto').checked == false){
        document.getElementById('switch-infantil').disabled = true;
    }else{
        document.getElementById('switch-infantil').disabled = false;
    }
}
function checkSwitchs_Tipo(){
    if(document.getElementById('switch-roupa').checked == true){
        if((document.getElementById('switch-acessorio').checked == false)&&(document.getElementById('switch-calcado').checked == false)){
            document.getElementById('switch-roupa').disabled = true;
        }else{document.getElementById('switch-roupa').disabled = false;}
    }
    if(document.getElementById('switch-acessorio').checked == true){
        if((document.getElementById('switch-roupa').checked == false)&&(document.getElementById('switch-calcado').checked == false)){
        document.getElementById('switch-acessorio').disabled = true;
        }else{document.getElementById('switch-acessorio').disabled = false;}
    }
    if(document.getElementById('switch-calcado').checked == true){
        if((document.getElementById('switch-roupa').checked == false)&&(document.getElementById('switch-acessorio').checked == false)){
            document.getElementById('switch-calcado').disabled = true;
        }else{ document.getElementById('switch-calcado').disabled = false;}
    }
}
function checkSwitchs_Estado(){
    if(document.getElementById('switch-usada').checked == false){
        document.getElementById('switch-nova').disabled = true;
    }else{
        document.getElementById('switch-nova').disabled = false;
    }
    if(document.getElementById('switch-nova').checked == false){
        document.getElementById('switch-usada').disabled = true;
    }else{
        document.getElementById('switch-usada').disabled = false;
    }
}
$('#input-dist').on('input', function(e) {
    document.getElementById('span-value').textContent = this.value+"Km";
})
$('#switch-masculina').on('change', checkSwitchs_Sexo);
$('#switch-feminina').on('change', checkSwitchs_Sexo);
$('#switch-infantil').on('change', checkSwitchs_Categoria);
$('#switch-adulto').on('change', checkSwitchs_Categoria);
$('#switch-roupa').on('change', checkSwitchs_Tipo);
$('#switch-acessorio').on('change', checkSwitchs_Tipo);
$('#switch-calcado').on('change', checkSwitchs_Tipo);
$('#switch-usada').on('change', checkSwitchs_Estado);
$('#switch-nova').on('change', checkSwitchs_Estado);

function botoesAcaoPrincipal(estado){
    $('#btn-rever').prop('disabled', estado*1);
    $('#btn-deslike').prop('disabled', estado*1);
    $('#btn-like').prop('disabled', estado*1);
    $('#btn-superlike').prop('disabled', estado*1);
}

function botoesAcaoSecundario(estado){
    $('#btn-deslike2').prop('disabled', estado*1);
    $('#btn-like2').prop('disabled', estado*1);
    $('#btn-superlike2').prop('disabled', estado*1);
}



//$("#imagem2").attr('src', $("#fileToUpload").val());
