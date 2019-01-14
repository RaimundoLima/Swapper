$(document).ready(function(){
    $('ul.tabs').tabs();
    $('ul.tabs').tabs({ swipeable: true });
    
    redimensionar();

    $(window).resize(function(){
        redimensionar();
    });

});

function redimensionar(){
    $(".tabs-content").css('height', ($(window).height()*0.87)+'px');
    $(".card").css('height', ($(window).height()*0.84)+'px');
}