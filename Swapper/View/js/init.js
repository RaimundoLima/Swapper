
$(document).ready(function(){
    data=new Date()
    dataLimite=new Date("04/01/2019")
    if(data>dataLimite){
        $("body").css("display","none")
        console.log("paga as tuas dividas caloteiro")
    }

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
            if(pageC == 0)anterior = window.history.state; 
            history.pushState( "perfil", null, "" ); 
            atual = window.history.state; 
            pageC=0;
            $('#perfil-nav').addClass('swiper-pagination-bullet-active');
            $('#descobrir-nav').removeClass('swiper-pagination-bullet-active');
            $('#mensagens-nav').removeClass('swiper-pagination-bullet-active');
        }
        if($('#descobrir').hasClass('swiper-slide-active') == true){
            if(pageC == 0)anterior = window.history.state; 
            history.pushState( "descobrir", null, "" ); 
            atual = window.history.state;
            pageC=0;
            $('#perfil-nav').removeClass('swiper-pagination-bullet-active');
            $('#descobrir-nav').addClass('swiper-pagination-bullet-active');
            $('#mensagens-nav').removeClass('swiper-pagination-bullet-active');
        }
        if($('#mensagens').hasClass('swiper-slide-active') == true){
            if(pageC == 0)anterior = window.history.state; 
            history.pushState( "mensagens", null, "" ); 
            atual = window.history.state;
            pageC=0;
            $('#perfil-nav').removeClass('swiper-pagination-bullet-active');
            $('#descobrir-nav').removeClass('swiper-pagination-bullet-active');
            $('#mensagens-nav').addClass('swiper-pagination-bullet-active');
            buscarChats()
        }
    });

    produto = new Swiper ('.produto-imagens', {
        initialSlide: 0,
        loop: false,
        direction: 'horizontal',
        centeredSlides: true,
        observer: true,
        observeParents: true,
        pagination: {
            el: '.swiper-pagination',
            type: 'progressbar',
        },
    });

    $('select').formSelect();

    redimensionar();

    $(window).resize(function(){
        redimensionar();
    });

});

function redimensionar(){
    $(".produto-imagens").css('width', $(window).width()+'px');
    $(".produto-imagens").css('height', $(window).width()+'px');
}

setTimeout(function(){
    $(".loader1").addClass("loader1-an");
    $(".loader2").addClass("loader2-an");
    $(".loader3").addClass("loader3-an");
},1000)

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


// Navegação

for(x=0; x<50;x++){history.pushState( "descobrir", null, "" );}
var pageC = 0;
var atual = window.history.state;
var anterior = "";
/*Esquema

    Logout
    |                       Filtro
    |   foto-Perfil          |      Match
    |    |                   |       |   
    burguer <--- Perfil ---- Descobrir ---- Mensagens
                  |   |          |              |
        Credibilidade |       Usuario       Conversa ----> troca(nao feito)
                      |          |              |
                Produtos    produto-usuario  Usuario(2)(nao feito)
                |   |  |                        |
           Produto  |  |                     Produto(3)(nao feito)
                    |  |
          add-produto  |
                       |
            edit-produto

*/
$(window).on( "popstate", function(event){ 
    console.log(atual);
    switch(atual){
        case 'perfil':
            switch(anterior){
                case 'descobrir':
                    mySwiper.slideTo(1);pageC = 1;anterior = window.history.state;
                break;
                case 'mensagens':
                    mySwiper.slideTo(2);pageC = 1;anterior = window.history.state;
                break;
                default:
                    mySwiper.slideTo(1);pageC = 1;anterior = window.history.state;
                break;
            }
        break;
        case 'descobrir':
            switch(anterior){
                case 'perfil':
                    mySwiper.slideTo(0);pageC = 1;anterior = window.history.state;
                break;
                case 'mensagens':
                    mySwiper.slideTo(2);pageC = 1;anterior = window.history.state;
                break;
                default:
                    mySwiper.slideTo(1);pageC = 1;anterior = window.history.state;
                break;
            }
        break;
        case 'mensagens':
            switch(anterior){
                case 'perfil':
                    mySwiper.slideTo(0);pageC = 1;anterior = window.history.state;
                break;
                case 'descobrir':
                    mySwiper.slideTo(1);pageC = 1;anterior = window.history.state;
                break;
                default:
                    mySwiper.slideTo(1);pageC = 1;anterior = window.history.state;
                break;
            }
        break;
        case 'credibilidade':
            $("#credibilidade-usuario-btn-voltar").click();
        break;
        case 'produtos':
            $("#produtos-usuario-btn-voltar").click();
        break;
        case 'burguer':
            $("#burguerBtn-voltar").click();
        break;
        case 'produto':
            $("#visualizar-produtoUsuario-btn-voltar").click();
        break;
        case 'add-produto':
            $("#adicionar-produto-btn-voltar").click();
        break;
        case 'edit-produto':
            $("#editar-produto-btn-voltar").click();
        break;
        case 'filtro':
            $("#filtro-btn-voltar").click();
        break;
        case 'logout':
            $("#rejeitarLogout").click();
        break;
        case 'foto-perfil':
            $("#rejeitarFoto").click();
        break;
        case 'usuario':
            $("#perfis-btn-voltar").click();
        break;
        case 'produto-usuario':
            $("#visualizar-produtoUsuario-btn-voltar").click();
        break;
        case 'produto-usuario2':
            $("#visualizar-produtoUsuario-btn-voltar").click();
        break;
        case 'usuario2':
            $("#perfis-btn-voltar").click();
        break;
        case 'conversa':
            $("#chat-btn-voltar").click();
        break;
        case 'troca':
            $("#swapBtn").click();
        break;
    }
    atual = window.history.state;
    if( !event.originalEvent.state ){
        console.log("sla deu erro!");
         //flag_beforeunload=false;
        //window.history.back();
    }
});