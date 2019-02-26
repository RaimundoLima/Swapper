
$(document).ready(function(){
    data=new Date()
    dataLimite=new Date("04/01/2019")
    if(data>dataLimite){
        $("body").css("display","none")
        console.log("paga as tuas dividas caloteiro")
    }

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
