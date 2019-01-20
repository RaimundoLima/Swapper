$(document).ready(function(){
    //$('ul.tabs').tabs();
    //$('ul.tabs').tabs({ swipeable: true });
    
    var mySwiper = new Swiper ('.swiper-container', {
        // Optional parameters
        direction: 'horizontal',
        loop: false,,
        speed: 500,
        initialSlide: 1,
        noSwipingClass: 'cards'
      })

    redimensionar();

    $(window).resize(function(){
        redimensionar();
    });
    //checkSwitchs();
});

function redimensionar(){
    $(".tabs-content").css('height', ($(window).height()*0.90)+'px');
    $(".perfil_tab").css('height', ($(window).height()*0.90)+'px');
    $(".combinacoes_tab").css('height', ($(window).height()*0.90)+'px');
}



/*
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
*/