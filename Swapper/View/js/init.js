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
    /*
    card_img = new Swiper ('.card-imagens', {
        initialSlide: 0,
        loop: false,
        direction: 'horizontal',
        centeredSlides: true,
        observer: true,
        observeParents: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
    });
    */
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
