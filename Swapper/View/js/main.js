$(document).ready(function(){
    $('ul.tabs').tabs();
    $('ul.tabs').tabs({ swipeable: true });
    
    redimensionar();

    $(window).resize(function(){
        redimensionar();
    });
});

function redimensionar(){
    $(".tabs-content").css('height', ($(window).height()*0.90)+'px');
    $(".perfil_tab").css('height', ($(window).height()*0.90)+'px');
    $(".combinacoes_tab").css('height', ($(window).height()*0.90)+'px');
    $(".card").css('height', ($(window).height()*0.75)+'px');
}


$('.op-sexo1').click(function(){
    console.log("oi");
    if($('.op-sexo1')[0].checked == true || $('.op-sexo1')[1].checked == true){
        $('.op-sexo2').attr("checked", false);
    }
    
    if($('.op-sexo1')[0].checked == false && $('.op-sexo1')[1].checked == true){
        $('.op-sexo2').attr("checked", true);
    }
});