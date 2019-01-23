$(document).ready(function(){
    mySwiper = new Swiper ('.swiper-container', {
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

    $('.carousel').carousel();

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
    });


    $("#produtos-usuario-btn").click(function() {
        $("#produtos-usuario").removeClass("right-left-ltab");
        $("#produtos-usuario").addClass("left-right-ltab");
    });
    $("#produtos-usuario-btn-voltar").click(function() {
        $("#produtos-usuario").removeClass("left-right-ltab");
        $("#produtos-usuario").addClass("right-left-ltab");
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
}

function redimensionar(){
    $(".tabs-content").css('height', ($(window).height()*0.90)+'px');
    $(".perfil_tab").css('height', ($(window).height()*0.90)+'px');
    $(".combinacoes_tab").css('height', ($(window).height()*0.90)+'px');
}

function checkSwitchs(){
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


//Input de distancia
document.getElementById('input-dist').addEventListener('input', function(e) {
    document.getElementById('span-value').textContent = this.value+"Km";
})

//Input de sexo
document.getElementById('switch-masculina').addEventListener('change', function(e) {
    if(document.getElementById('switch-masculina').checked == false){
        document.getElementById('switch-feminina').disabled = true;
    }else{
        document.getElementById('switch-feminina').disabled = false;
    }
});

document.getElementById('switch-feminina').addEventListener('change', function(e) {
    if(document.getElementById('switch-feminina').checked == false){
        document.getElementById('switch-masculina').disabled = true;
    }else{
        document.getElementById('switch-masculina').disabled = false;
    }
});

//Input de Categoria
document.getElementById('switch-usada').addEventListener('change', function(e) {
    if(document.getElementById('switch-usada').checked == false){
        document.getElementById('switch-nova').disabled = true;
    }else{
        document.getElementById('switch-nova').disabled = false;
    }
});

document.getElementById('switch-nova').addEventListener('change', function(e) {
    if(document.getElementById('switch-nova').checked == false){
        document.getElementById('switch-usada').disabled = true;
    }else{
        document.getElementById('switch-usada').disabled = false;
    }
});

//Input de Tipo 
document.getElementById('switch-roupa').addEventListener('change', function(e) {
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
});

document.getElementById('switch-acessorio').addEventListener('change', function(e) {
    if(document.getElementById('switch-roupa').checked == true){
        if((document.getElementById('switch-acessorio').checked == false)&&(document.getElementById('switch-calcado').checked == false)){
            document.getElementById('switch-roupa').disabled = true;
        }else{document.getElementById('switch-roupa').disabled = false;}
        }
        if(document.getElementById('switch-calcado').checked == true){
            if((document.getElementById('switch-roupa').checked == false)&&(document.getElementById('switch-acessorio').checked == false)){
                document.getElementById('switch-calcado').disabled = true;
            }else{ document.getElementById('switch-calcado').disabled = false;}
        }
});

document.getElementById('switch-calcado').addEventListener('change', function(e) {
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
});

//Input de estado
document.getElementById('switch-infantil').addEventListener('change', function(e) {
    if(document.getElementById('switch-infantil').checked == false){
        document.getElementById('switch-adulto').disabled = true;
    }else{
        document.getElementById('switch-adulto').disabled = false;
    }
});

document.getElementById('switch-adulto').addEventListener('change', function(e) {
    if(document.getElementById('switch-adulto').checked == false){
        document.getElementById('switch-infantil').disabled = true;
    }else{
        document.getElementById('switch-infantil').disabled = false;
    }
});
