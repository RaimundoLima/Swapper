$(document).ready(function(){
    $('ul.tabs').tabs();
    $('ul.tabs').tabs({ swipeable: true });
    
    $(".tabs-content").css('height', ($(window).height()*0.87)+'px');

});
