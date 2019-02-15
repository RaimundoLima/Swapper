navigator.geolocation.getCurrentPosition(Location,function(){console.log("error")},{timeout:10000});
function Location(pos) {
    console.log("entrou função\n")
    var coordenadas = pos.coords;
    var Position = { coords: {Latitude: coordenadas.latitude, Longitude: coordenadas.longitude, H:coordenadas.heading} };
    $.ajax({
        url: "/atualizarPos",
        type: "post",
        data:{
            'latitude':pos.coords.latitude,
            'longitude':pos.coords.longitude
        }
                            /* <!--<div class="cards swiper-no-swiping">

                                <div class="card-imgs tx-c swiper-no-swiping">
                                    <div class="swiper-wrapper">
                                        <div id="card-view-img1" class="swiper-slide r"><img id="card-imagem1" class="i" src="View/img/camiseta.jpg" alt=""></div>
                                        <div id="card-view-img2" class="swiper-slide r"><img id="card-imagem2" class="i" src="View/img/camiseta.jpg" alt=""></div>
                                        <div id="card-view-img3" class="swiper-slide r"><img id="card-imagem3" class="i" src="View/img/camiseta.jpg" alt=""></div>
                                    </div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>

                                </div>

                                <div class="card-dados row swiper-no-swiping">
                                    <div class="col s3"></div>
                                    <div class="col s9"><span class="card-dadosNome">Jonh Connor<span>-7KM</span></span></div>

                                </div>
                                <div class="dados swiper-no-swiping">
                                    <img id="perfis-btn" src="/View/img/rai.jpg" alt="">
                                    <span>
                                        <i class="meritos-perfil material-icons">star_half</i>
                                        <i class="meritos-perfil material-icons">check_circle</i>
                                    </span>
                                </div>
                            </div>   */   
    }).done(function(data){
        //console.log('éoq')
        gerarCards(data)

    })

    //console.log("Latitude:" + Position.coords.Latitude + "Longitude:" + Position.coords.Longitude);
}
function gerarCards(data){
    dataCard=JSON.parse(data)
    var html=""
    for(var i=0;i<Object.keys(dataCard).length;i++){
    console.log('éoq')
    html+='<div class="cards swiper-no-swiping">'
                                +'<div class="card-imgs tx-c swiper-no-swiping">'
                                +    '<div class="swiper-wrapper">'
                                +        '<div id="card-view-img1" class="swiper-slide r"><img id="card-imagem1" class="i" src="View/img/camiseta.jpg" alt=""></div>'
                                +        '<div id="card-view-img2" class="swiper-slide r"><img id="card-imagem2" class="i" src="View/img/camiseta.jpg" alt=""></div>'
                                +        '<div id="card-view-img3" class="swiper-slide r"><img id="card-imagem3" class="i" src="View/img/camiseta.jpg" alt=""></div>'
                                +    '</div>'
                                +    '<div class="swiper-button-prev"></div>'
                                +    '<div class="swiper-button-next"></div>'
                                +'</div>'
                                +'<div class="card-dados row swiper-no-swiping">'
                                +    '<div class="col s3"></div>'
                                +    '<div class="col s9"><span id="'+dataCard[0].usuario.id+'"></span><span class="card-dadosNome">'+dataCard[0].usuario.nome+'<span>-'+dataCard[0].usuario.distancia+'KM</span></span></div>'
                                +'</div>'
                                +'<div class="dados swiper-no-swiping">'
                                +    '<img id="perfis-btn" src="data:image/jpeg;base64,'+dataCard[0].usuario.foto+'" alt="">'
                                +    '<span>'
                                +        '<i class="meritos-perfil material-icons">star_half</i>'
                                +        '<i class="meritos-perfil material-icons">check_circle</i>'
                                +    '</span>'
                                +'</div>'
                            +'</div> ';
    }
    console.log(dataCard);
    $("#cards").html(html);
    resizeImg($(".r"),$(".i"));
    
    cardImageSwipe();
}

// Formula da distancia entre duas distancias Math.round(6371*Math.acos(Math.cos(degrees_to_radians(90-Latitude_1))*Math.cos(degrees_to_radians(90-Latitude_2))+Math.sin(degrees_to_radians(90-Latitude_1))*Math.sin(degrees_to_radians(90-Latitude_2))*Math.cos(degrees_to_radians(Longitude_1-Longitude_2)))*1)

function degrees_to_radians(degrees)
{
  var pi = Math.PI;
  return degrees * (pi/180);
}

var buscaFiltro=0;
var buscaRoupas=0

$("#filtro-btn").click(function() {
    buscarFiltro();
  });
$("#filtro-btn-voltar").click(function() {
    atualizarFiltro();
});

$("#perfis-btn").click(function() {
    botoesAcaoPrincipal(1);
    botoesAcaoSecundario(0);
  });
$("#perfis-btn-voltar").click(function() {
    botoesAcaoPrincipal(0);
    botoesAcaoSecundario(1);
});

$("#produtos-usuario-btn").click(function() {
    buscarRoupas();
});

$("#adicionar-produto-btn-voltar").click(function() {
    resetAddForm();
    $("#remover1").css('display', 'none');
    $("#remover2").css('display', 'none');
});
///////
$("#editar-produto-btn-voltar").click(function() {
    $("#remover3").css('display', 'none');
    $("#remover4").css('display', 'none');
});
//////////
$("#adicionar-produtoForm").submit(function(e){
    e.preventDefault();
    inputRequired();
})
$("#editar-produtoForm").submit(function(e){
    e.preventDefault();
    inputRequiredEdit();
})
$("#confirmarFoto").click(function(){
    atualizarPerfil();
    $("#confirmarFotoPerfil").removeClass("show-tab");
    $("#confirmarFotoPerfil").addClass("un-show-tab");
    setTimeout(function(){$("#fotoPerfilPreview").attr('src', ''); $("#confirmarFotoPerfil").css('display', 'none');}, 300);
})
function atualizarPerfil(){
    var data = new FormData();
    jQuery.each(jQuery('#fotoPerfilUpload')[0].files, function(i, file) {
        data.append('img', file);
    });
        $.ajax({
        url: '/atualizarPerfil',
        contentType: false,
        processData: false,
        type: 'post',
        data:data
    }).done(function(foto){
        $("#fotoPerfil").attr("src","data:image/jpeg;base64,"+foto)
        M.toast({html: 'Foto de perfil alterada'}) 
    })

}
function inserirRoupas(){
    var data = new FormData();
    jQuery.each(jQuery('#fileToUpload')[0].files, function(i, file) {
        data.append('img1', file);
    });
    jQuery.each(jQuery('#fileToUpload1')[0].files, function(i, file) {
        data.append('img2', file);
    });
    jQuery.each(jQuery('#fileToUpload2')[0].files, function(i, file) {
        data.append('img3', file);
    });
    data.append("nome",$("#nomeProduto").val());
    data.append("descricao",$("#descricao").val());
    data.append("sexo",$("#sexo").val());
    data.append("categoria",$("#categoria").val());
    data.append("tipo",$("#tipo").val());
    data.append("estado",$("#estado").val());
    $.ajax({
        url: '/adicionarRoupas',
        contentType: false,
        processData: false,
        async: false ,
        type: 'post',
        data:data
    }).done(function(){
        resetAddForm();
        $("#remover1").css('display', 'none');
        $("#remover2").css('display', 'none');
        $("#adicionar-produto").removeClass("left-right-ltab");
        $("#adicionar-produto").addClass("right-left-ltab");
    })
}
function atualizarRoupasEnviar(){
    var data = new FormData();
    jQuery.each(jQuery('#fileToUpload3')[0].files, function(i, file) {
        data.append('img1', file);
    });
    jQuery.each(jQuery('#fileToUpload4')[0].files, function(i, file) {
        data.append('img2', file);
    });
    jQuery.each(jQuery('#fileToUpload5')[0].files, function(i, file) {
        data.append('img3', file);
    });
    data.append("id",$("#idProdutoEditar").val())
    data.append("nome",$("#editarNome").val());
    data.append("descricao",$("#editarDescricao").val());
    data.append("sexo",$("#editarSexo").val());
    data.append("categoria",$("#editarCategoria").val());
    data.append("tipo",$("#editarTipo").val());
    data.append("estado",$("#editarEstado").val());
    $.ajax({
        url: '/atualizarRoupasEnviar',
        contentType: false,
        processData: false,
        async: false ,
        type: 'post',
        data:data
    }).done(function(){
        resetAddForm();
        $("#remover3").css('display', 'none');
        $("#remover4").css('display', 'none');
        $("#editar-produto").removeClass("left-right-ltab");
        $("#editar-produto").addClass("right-left-ltab");
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
            gerarRoupas(data)
        })
        buscaRoupas=1;
    }
}
function gerarRoupas(data){
    var html=""
    roupas=JSON.parse(data)
    for(var i=Object.keys(roupas).length;i>=1;i--){
    //for(var i=1;i<=Object.keys(roupas).length;i++){
       html+='<div id="produto-'+roupas[i]["id"]+'" class="produto"><div class="row"><div onclick="visualizarProduto('+roupas[i]["id"]+')" class="col s4 visualizar-produto"><div id="produto-img-ref'+roupas[i]["id"]+'" class="produto_imagem"><img id="produto-img'+roupas[i]["id"]+'" class="" src="data:image/jpeg;base64,'+roupas[i]["foto1"]+'"></div></div><div class="produto_info col s6 visualizar-produto"><span class="nome_produto">'+roupas[i]["nome"]+'</span><br><i class="material-icons icons">remove_red_eye</i><span>0</span><i class="material-icons icons">favorite</i><span>0</span></div><div onclick="editarProduto('+roupas[i]["id"]+')" id="editarProduto_btn" class="btn-generic col s2"><a class="editar-produto-btn"><i class="material-icons">create</i></a></div></div></div>'
    }
    $("#produtos").html(html);
    
    $("#produtos-user-preloader").css('display', 'none');
    $("#produtos-user").css('display', 'block');
    $(".addProduto_btn").css('display', 'inline-block');
    for(var i=Object.keys(roupas).length;i>=1;i--){
        resizeImg($("#produto-img-ref"+roupas[i]["id"]),$("#produto-img"+roupas[i]["id"]));
    }
}
function visualizarProduto(idProduto){
    $(".visualizar-produtoUsuario-tab").removeClass("right-left-ltab");
    $(".visualizar-produtoUsuario-tab").addClass("left-right-ltab");
     $.ajax({
        url: '/buscarRoupasPorId?'+idProduto
     }).done(function(data){
        var roupa=JSON.parse(data)
        var imgs=''
        if(roupa["foto1"] !=""){
            imgs+=' <div id="produto-view-img1" class="swiper-slide"><img id="produto-imagem1" src="data:image/jpeg;base64,'+roupa["foto1"]+'" alt=""></div>'
        }
        if(roupa["foto2"] !=""){
            imgs+=' <div id="produto-view-img2" class="swiper-slide"><img id="produto-imagem2" src="data:image/jpeg;base64,'+roupa["foto2"]+'" alt=""></div>'
        }
        if(roupa["foto3"] !=""){
            imgs+=' <div id="produto-view-img3" class="swiper-slide"><img id="produto-imagem3" src="data:image/jpeg;base64,'+roupa["foto3"]+'" alt=""></div>'
        }
        $("#visualizarImagens").html(imgs)
        resizeImg($("#produto-view-img1"),$("#produto-imagem1"));
        resizeImg($("#produto-view-img2"),$("#produto-imagem2"));
        resizeImg($("#produto-view-img3"),$("#produto-imagem3"));
        $("#visualizaProdutoDono").text(roupa["usuario_id"])
        $("#visualizaProdutoNome").text(roupa["nome"])
        $("#visualizaProdutoDescricao").text(roupa["descricao"])
        var html=""
        var sexo=(roupa["sexo"]==1) ? "MASCULINA" : "FEMININA"
        var categoria=(roupa["categoria"]==1) ? "INFANTIL" : "ADULTO"
        var tipo="";
        if(roupa["tipo"]==1){
            tipo="ROUPA"
        } 
        else if(roupa["tipo"]==2){
            tipo="ACESSÓRIO"
        }else{
            tipo="CALÇADO"
        } 
        var estado=(roupa["estado"]==1) ? "NOVA" : "USADA"
        html='<span>TAGS:</span><span class="tag">'+sexo+'</span><span class="tag">'+categoria+'</span><span class="tag">'+tipo+'</span><span class="tag">'+estado+'</span>'
        $("#visualizarProdutoTags").html(html)
     })
}
function editarProduto(idProduto){
    $("#editar-produto").removeClass("right-left-ltab");
    $("#editar-produto").addClass("left-right-ltab");
     $.ajax({
        url: '/atualizarRoupas?'+idProduto,
        type: 'post'}).done(function(data){
            var produto=(JSON.parse(data));
            $("#idProdutoEditar").val(idProduto)
            $("#previewUpload3").attr("src","data:image/jpeg;base64,"+produto["foto1"])
            $("#previewUpload4").attr("src","data:image/jpeg;base64,"+produto["foto2"])
            if(produto["foto3"]!=""){
                $("#fileToUpload5").attr("disabled",false);
                $("#img-preview5").removeClass("label-disabled")
                $("#previewUpload5").attr("src","data:image/jpeg;base64,"+produto["foto3"])
            }
            //$("#fileToUpload3").val(produto["foto1"])
            //$("#fileToUpload4").val(produto["foto2"])
            //$("#fileToUpload5").val(produto["foto3"])
            resizeImg($("#img-preview3"),$("#previewUpload3"))
            resizeImg($("#img-preview4"),$("#previewUpload4"))
            resizeImg($("#img-preview5"),$("#previewUpload5"))
            $("#editarNome").val(produto["nome"])
            $("#editarDescricao").val(produto["descricao"])
            $("#editarSexo").val(produto["sexo"]).formSelect()
            $("#editarTipo").val(produto["sexo"]).formSelect()
            $("#editarCategoria").val(produto["sexo"]).formSelect();
            $("#editarEstado").val(produto["sexo"]).formSelect();
        })
}
//Desabilitar e habilitar botoes de ação
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

// Input preview e UX
function readURL(input) {
    var size = input.files[0].size;
    inp = input.files;
    if(size < 1048576) {       
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //INPUT FOTO DE PERFIL
            if(input.id == "fotoPerfilUpload"){
                reader.onload = function (e) {
                    $("#confirmarFotoPerfil").removeClass("un-show-tab");
                    $("#confirmarFotoPerfil").addClass("show-tab");
                    $("#confirmarFotoPerfil").css('display', 'inline-block');
                    $("#fotoPerfilPreview").attr('src', e.target.result);
                }
            }
            //INPUTS DE IMAGEM DO ADICIONAR PRODUTO
            if(input.id == "fileToUpload"){
                reader.onload = function (e) {
                    $("#previewUpload").attr('src', e.target.result);
                    resizeImg($("#img-preview"),$("#previewUpload"));
                    $("#fileToUpload1").prop('disabled', false);
                    $("#img-preview1").addClass('able');
                    $("#img-preview1").removeClass('label-disabled');  
                }
            }
            if(input.id == "fileToUpload1"){
                reader.onload = function (e) {
                    $("#previewUpload1").attr('src', e.target.result);
                    resizeImg($("#img-preview1"),$("#previewUpload1"));
                    $("#fileToUpload2").prop('disabled', false);
                    $("#img-preview2").removeClass('dis-able');
                    $("#img-preview2").addClass('able');
                    $("#img-preview2").removeClass('label-disabled');
                    if($("#remover2").css('display') == 'none') $("#remover1").css('display', 'block');
                }
            }
            if(input.id == "fileToUpload2"){
                reader.onload = function (e) {
                    $("#previewUpload2").attr('src', e.target.result);
                    resizeImg($("#img-preview2"),$("#previewUpload2"));
                    $("#remover1").css('display', 'none');
                    $("#remover2").css('display', 'block');
                }
            }

            //////////////// teste //////////////////////////////
            if(input.id == "fileToUpload3"){
                reader.onload = function (e) {
                    $("#previewUpload3").attr('src', e.target.result);
                    resizeImg($("#img-preview3"),$("#previewUpload3"));
                    $("#fileToUpload4").prop('disabled', false);
                    $("#img-preview4").addClass('able');
                    $("#img-preview4").removeClass('label-disabled');  
                }
            }
            if(input.id == "fileToUpload4"){
                reader.onload = function (e) {
                    $("#previewUpload4").attr('src', e.target.result);
                    resizeImg($("#img-preview4"),$("#previewUpload4"));
                    $("#fileToUpload5").prop('disabled', false);
                    $("#img-preview5").removeClass('dis-able');
                    $("#img-preview5").addClass('able');
                    $("#img-preview5").removeClass('label-disabled');
                    if($("#remover4").css('display') == 'none') $("#remover3").css('display', 'block');
                }
            }
            if(input.id == "fileToUpload5"){
                reader.onload = function (e) {
                    $("#previewUpload5").attr('src', e.target.result);
                    resizeImg($("#img-preview4"),$("#previewUpload4"));
                    $("#remover3").css('display', 'none');
                    $("#remover4").css('display', 'block');
                }
            }

            /////////////////////////////////////////////////

            reader.readAsDataURL(input.files[0]);
        }
    }else{           
        M.toast({html: 'Imagem muito grande!'}) 
        input.value = "";        
    }
}

$('body').on("change", "input[type=file]", function() {
    readURL(this);
});

//ajustar imagem
function resizeImg(ref, img){
    ref.css("padding-top", "0px");
    img.css("height","auto");
    img.css("width","auto");
    if(img.height() < img.width()){
        img.css("width","100%");
        ref.css("padding-top",((ref.height()/2)-(img.height()/2))+"px");
    }else img.css("height","100%");
}


//resetar formulario
function resetAddForm(){
    $("#previewUpload").attr('src','');
    $("#previewUpload1").attr('src','');
    $("#previewUpload2").attr('src', '');
    $("#img-preview1").addClass('label-disabled');
    $("#img-preview1").removeClass('able');
    $("#img-preview2").addClass('label-disabled');
    $("#img-preview2").removeClass('able');
    document.getElementById("fileToUpload").value = "";
    document.getElementById("fileToUpload1").value = "";
    document.getElementById("fileToUpload2").value = "";
    document.getElementById("adicionar-produtoForm").reset();
}

function inputRequired(){
    if(document.getElementById("fileToUpload").value == "" || $("#nomeProduto").val() == "" || $("#descricao").val() == ""){
        if(document.getElementById("fileToUpload").value == "") M.toast({html: 'Foto necessária!'})
        if($("#nomeProduto").val() == "") M.toast({html: 'Nome necessário!'}) 
        if($("#descricao").val() == "") M.toast({html: 'Descrição necessária!'}) 
    }else{
        inserirRoupas();
        buscaRoupas=0;
        buscarRoupas();
    }
}
function inputRequiredEdit(){
    console.log("function \n")
    if(document.getElementById("fileToUpload3").value == "" || $("#editarNome").val() == "" || $("#editarDescricao").val() == ""){
        if(document.getElementById("fileToUpload3").value == "") M.toast({html: 'Foto necessária!'})
        if($("#editarNome").val() == "") M.toast({html: 'Nome necessário!'}) 
        if($("#editarDescricao").val() == "") M.toast({html: 'Descrição necessária!'}) 
    }else{
        console.log("else")
        atualizarRoupasEnviar();
        buscaRoupas=0;
        buscarRoupas();
    }
}

function cardImageSwipe(){
    $("#cards").children().last().find('div')[0].className += " card-imagens";
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
}



/// SWIPEABLE CARDS
var X, Y, T, S, moveX, moveY = 0

$("#cards").on('touchstart', function(event) {
    X = event.originalEvent.touches[0].pageX;
    Y = event.originalEvent.touches[0].pageY;
    T = ($("#cards").width());
    S = ($("#cards").children().last().height());
});

$("#cards").on('touchmove', function(event) {
    $("#cards").children().last().css('transform', 'translateX('+130*((event.changedTouches[event.changedTouches.length-1].pageX-X)/T)+'%) rotate('+12*((event.changedTouches[event.changedTouches.length-1].pageX-X)/T)+'deg) translateY('+(100*(event.changedTouches[event.changedTouches.length-1].pageY-Y)/S)+'%)');
    moveX = (event.changedTouches[event.changedTouches.length-1].pageX-X)/T;
    moveY = (100*(event.changedTouches[event.changedTouches.length-1].pageY-Y)/S);
});

$("#cards").on('touchend', function(event) {    
    //console.log("oi");
    if(moveY <= -65){
        $("#cards").children().last().css({
            transition: "transform 0.3s",
            transform: 'scale(0.01) translateY(-500%)',
        });
        setTimeout(function(){$("#cards").children().last().remove()},300);
    }else{
        if((130*moveX) >= 70 && (130*moveX) > 0){
            $("#cards").children().last().css({
                transition: "transform 0.3s",
                transform: 'translateX(130%) rotate(12deg)',
            });
            setTimeout(function(){$("#cards").children().last().remove()},300);
        }
        if((130*moveX) <= -70 && (130*moveX) < 0){
            $("#cards").children().last().css({
                transition: "transform 0.3s",
                transform: 'translateX(-130%) rotate(-12deg)',
            });
            setTimeout(function(){$("#cards").children().last().remove()},300);
        }
        if((130*moveX) < 70 && (130*moveX) > -70){
            $("#cards").children().last().css({
                transition: "transform 0.3s",
                transform: 'translateX(0%) rotate(0deg)',
            });
            setTimeout(function(){$("#cards").children().last().css( { transition: "none" } );},300);
        }
    }
       //$("#cards").children().last().remove();
        //$("#cards").children().last().css( { transition: "none" } ); //$("#cards").children().last().css('transform', 'translateX(0%) rotate(0deg)'); moveY = 0;
        moveX = 0;
        T = 0;
        S = 0;
        X = 0;
        Y = 0;
});



////////// Botoes de ação ///////////

$("#btn-rever").click(function() {
    $("#cards").children().last().addClass("rever-action");
    setTimeout(function(){$("#cards").children().last().removeClass("rever-action");}, 400);
});
$("#btn-deslike").click(function() {
    $("#cards").children().last().addClass("deslike-action");
    setTimeout(function(){$("#cards").children().last().removeClass("deslike-action"); }, 400);
    
});
$("#btn-like").click(function() {
    $("#cards").children().last().addClass("like-action");
    //setTimeout(function(){$("#cards").children().last().remove(); lastChild();}, 400);
    setTimeout(function(){$("#cards").children().last().removeClass("like-action");}, 400);
});
$("#btn-superlike").click(function() {
    $("#cards").children().last().addClass("superlike-action");
    setTimeout(function(){$("#cards").children().last().removeClass("superlike-action");}, 400);
});
/////////////////////////////////