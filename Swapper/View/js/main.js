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
    $(".card").css('height', ($(window).height()*0.75)+'px');
}