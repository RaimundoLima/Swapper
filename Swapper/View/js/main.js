navigator.geolocation.getCurrentPosition(Location,function(){console.log("error")},{timeout:10000});
function Location(pos) {
    var coordenadas = pos.coords;
    var Position = { coords: {Latitude: coordenadas.latitude, Longitude: coordenadas.longitude, H:coordenadas.heading} };
    $.ajax({
        url: "/atualizarPos",
        type: "post",
        data:{
            'latitude':pos.coords.latitude,
            'longitude':pos.coords.longitude
        }
    }).done(function(data){
        gerarCards(data)
    })
}
function gerarCards(data){
    dataCard=JSON.parse(data)
    var html=""
    var htmlRoupas=""
    $("#cards-preloader").css('display','inline-block');
    $("#cards").html("");
    for(var i=0;i<Object.keys(dataCard).length;i++){
        htmlRoupas=""
        for(var j=0;j<Object.keys(dataCard[i].roupa).length;j++){
            htmlRoupas+='<div id="'+j+'" class="swiper-slide card-slide refCard'+dataCard[i].roupa[j].id+'">'
                        + '<img id="" class="imgCard'+dataCard[i].roupa[j].id+'" src="data:imagem/jpeg;base64,'+dataCard[i].roupa[j].foto+'" alt="">'
                        +'</div>'
        }  
        html+='<div id="'+dataCard[i].usuario.id+'" class="cards swiper-no-swiping">'
                                    +'<div class="card-imgs tx-c swiper-no-swiping">'
                                    +    '<div class="swiper-wrapper">'
                                    +  htmlRoupas
                                    +    '</div>'
                                    +    '<div class=""></div>'
                                    +    '<div class=""></div>'
                                    +'</div>'
                                    +'<div class="card-dados row swiper-no-swiping">'
                                    +    '<div class="col s3"></div>'
                                    +    '<div class="col s6 pd-r0" ><span id=usuario-"'+dataCard[i].usuario.id+'"></span><span class="card-dadosNome">'+dataCard[i].usuario.nome+'</span></div>'
                                    +    '<div class="col s3"><span class="tx-r">'+dataCard[i].usuario.distancia+'KM</span></div>'
                                    +'</div>'
                                    +'<div class="dados swiper-no-swiping">'
                                    +    '<img onclick="buscarPerfil('+dataCard[i].usuario.id+')" id="perfis-btn" src="data:image/jpeg;base64,'+dataCard[i].usuario.foto+'" alt="">'
                                    +    '<span>'
                                    +        '<i class="meritos-perfil material-icons">star_half</i>'
                                    +        '<i class="meritos-perfil material-icons">check_circle</i>'
                                    +    '</span>'
                                    +'</div>'
                                +'</div> ';
    }
    //console.log(dataCard);
    //console.log("entrou função\n")
    $("#cards").html(html);
    
    if($("#cards").html() == ""){
      $("#cards-preloader").css('display','inline-block'); 
      //M.toast({html: 'Nenhum usuario encontrado'});
    }else{
        $("#cards-preloader").css('display','none'); 
        var y = 0;
        for(var i=0;i<Object.keys(dataCard).length;i++){
            for(var j=0;j<Object.keys(dataCard[i].roupa).length;j++){
                resizeImg($(".refCard"+dataCard[i].roupa[j].id),$(".imgCard"+dataCard[i].roupa[j].id));
                y = j;
            }
        }
        cardImageSwipe(y);
    }
}

// Formula da distancia entre duas distancias Math.round(6371*Math.acos(Math.cos(degrees_to_radians(90-Latitude_1))*Math.cos(degrees_to_radians(90-Latitude_2))+Math.sin(degrees_to_radians(90-Latitude_1))*Math.sin(degrees_to_radians(90-Latitude_2))*Math.cos(degrees_to_radians(Longitude_1-Longitude_2)))*1)

function degrees_to_radians(degrees)
{
  var pi = Math.PI;
  return degrees * (pi/180);
}

var buscaFiltro=0;
var buscaRoupas=0;
var buscaChats=0;
var alteraImagem1=0
var alteraImagem2=0
var alteraImagem3=0

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
    history.pushState( "burguer", null, "" ); atual = window.history.state;
})

$("#deslogarBtn").click(function(){
    history.pushState( "logout", null, "" ); atual = window.history.state;
    $("#confirmarDeslogar").css("display", "inline-block");
    $("#confirmarDeslogar").removeClass("un-show-tab");
    $("#confirmarDeslogar").addClass("show-tab");
})

$("#rejeitarLogout").click(function(){
    history.pushState( "burguer", null, "" ); atual = window.history.state;
    $("#confirmarDeslogar").removeClass("show-tab");
    $("#confirmarDeslogar").addClass("un-show-tab");
    setTimeout(function(){ $("#confirmarDeslogar").css('display', 'none');}, 300);
})

$("#deletarBtn").click(function(){
    $("#deletarProduto").css("display", "inline-block");
    $("#deletarProduto").removeClass("un-show-tab");
    $("#deletarProduto").addClass("show-tab");
})



$("#rejeitarDeletar").click(function(){
    $("#deletarProduto").removeClass("show-tab");
    $("#deletarProduto").addClass("un-show-tab");
    setTimeout(function(){ $("#deletarProduto").css('display', 'none');}, 300);
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

    if(document.getElementById("fileToUpload3").value != "") alteraImagem1=1; 

    if(document.getElementById("fileToUpload4").value == "" &&  $("#previewUpload4").attr("src") == "") alteraImagem2 = 2; 

    if(document.getElementById("fileToUpload4").value != "") alteraImagem2 = 1;

    if(document.getElementById("fileToUpload5").value == "" &&  $("#previewUpload5").attr("src") == "") alteraImagem3 = 2; 
    
    if(document.getElementById("fileToUpload5").value != "") alteraImagem3 = 1;

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
    data.append("alteraImagem1",alteraImagem1)
    data.append("alteraImagem2",alteraImagem2)
    data.append("alteraImagem3",alteraImagem3)
    $.ajax({
        url: '/atualizarRoupasEnviar',
        contentType: false,
        processData: false,
        async: false ,
        type: 'post',
        data:data
    }).done(function(){
        resetEditForm();
        $("#remover3").css('display', 'none');
        $("#remover4").css('display', 'none');
        $("#editar-produto").removeClass("left-right-ltab");
        $("#editar-produto").addClass("right-left-ltab");
        alteraImagem1=0;
        alteraImagem2=0;
        alteraImagem3=0;
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
$('#enviarMensagem').submit(function (e) {
    e.preventDefault();
    if ($('#estado').text() == 'Enviando') {
        return (false);
    }
    $('#estado').text('Enviando');
    $.ajax({
        url: '/enviaMsg',
        type: 'post',
        data: {
            'text': $("#text").val(),
            'idChat':$("#idChat").text()
        }
    }).done(function (data) {
        //alert(data)
        console.log(data)
        if (data != "") {
            $('#text').val('');
        }
        $('#estado').text('Parado');
    });
});
function buscarChats(){
    if(!buscaChats){
        $.ajax({
            url: '/buscarChats'
        }).done(function(data){
            dataChat=JSON.parse(data)
            console.log(dataChat);

            html=''
            for(var i=0;i<Object.keys(dataChat).length;i++){
                var horario=time_format(new Date(dataChat[i].horarioMensagem*1))
                html+='<div class="combinacoes_msg_card" onclick="buscarMensagens('+dataChat[i].idChat+')">'
                                +' <div class="row">'
                                +'    <div class="col s3">'
                                +'        <div class="pic_msgs"><img src="data:image/jpeg;base64,'+dataChat[i].fotoUsuario+'" alt=""></div>'
                                +'    </div>'
                                +'    <div class="dados_msgs col s8">'
                                +'        <span class="nome_msg">'+dataChat[i].nomeUsuario+'</span>'
                                +'        <br>'
                                +'        <span class="ultima_msg">'+dataChat[i].conteudoMensagem+'</span>'
                                +'        <br>'
                                +'        <span class="hora_msg">'+horario+'</span>'
                                +'    </div>'
                                +'    <div class="col s1">'
                                +'        <div class="msg_nãolida"></div>'
                                +'    </div>'
                                +'</div>'
                            +'</div>'
            }
            $('#msgs').html(html)
        })
        buscaChats=1
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
    for(var i=Object.keys(roupas).length-1;i>=0;i--){
    //for(var i=1;i<=Object.keys(roupas).length;i++){
       html+='<div id="produto-'+roupas[i].id+'" class="produto"><div class="row">'
       +'<div onclick="visualizarProduto('+roupas[i].id+')" class="col s4 visualizar-produto">'
       +'<div id="produto-img-ref'+roupas[i].id+'" class="refPerfil'+roupas[i].id+' produto_imagem">'
       +'<img id="produto-img'+roupas[i].id+'" class="imgPerfil'+roupas[i].id+'" src="data:image/jpeg;base64,'+roupas[i].foto1+'">'
       +'</div></div><div onclick="visualizarProduto('+roupas[i].id+')" class="produto_info col s6 visualizar-produto">'
       +'<span class="nome_produto">'+roupas[i].nome+'</span>'
       +'<br>'
       +'<span>0</span><i class="material-icons icons">remove_red_eye</i>'
       +'</div>'
       +'<div onclick="editarProduto('+roupas[i].id+')" id="editarProduto_btn" class="btn-generic col s2">'
       +'<a class="editar-produto-btn"><i class="material-icons">create</i>'
       +'</a></div></div></div>'
    }
    $("#produtos").html(html);    
    $("#produtos-user-preloader").css('display', 'none');
    $("#produtos-user").css('display', 'block');
    $(".addProduto_btn").css('display', 'inline-block');
    for(var i=Object.keys(roupas).length-1;i>=0;i--){
        resizeImg($(".refPerfil"+roupas[i].id),$(".imgPerfil"+roupas[i].id));
    }
}
function deletarProduto(idProduto){
    //animações
    $.ajax({
        url: '/deletarproduto?'+idProduto
    }).done(function(data){
    })
    buscaRoupas=0;
    buscarRoupas();
    $("#anBlock").css("display", "inline");
    $("#deletarProduto").removeClass("show-tab");
    $("#deletarProduto").addClass("un-show-tab");
    setTimeout(function(){
        $("#deletarProduto").css('display', 'none');
        $("#editar-produto").removeClass("left-right-ltab");
        $("#editar-produto").addClass("right-left-ltab");
        $("#anBlock").css("display", "none");
    }, 300);
    M.toast({html: 'Produto deletado!'}) 
}
function time_format(d) {
    hours = format_two_digits(d.getHours());
    minutes = format_two_digits(d.getMinutes());
    return hours + ":" + minutes
}
function format_two_digits(n) {
    return n < 10 ? '0' + n : n;
}
function buscarMensagens(idChat){
    history.pushState( "conversa", null, "" ); atual = window.history.state;
    $("#conversa").css('display','inline-block');
    $("#conversa").removeClass("left-right-rtab");
    $("#conversa").addClass("right-left-rtab");
    var html=''

    $.ajax({
        url: '/buscarMensagens?'+idChat
    }).done(function(data){
        msgs=JSON.parse(data);
        for(var i=Object.keys(msgs['msgs']).length-1;i>=0;i--){
            var horario=time_format(new Date(msgs['msgs'][i]['horario']*1))
            if(msgs['msgs'][i].usuario==0){
                html+='<div id="" class="msgSystem tx-c">'
                        +'<span style="display:none;" id="idChat">'+idChat+'</span>'
                        + msgs['msgs'][i]['conteudo']
                        +'</div>'
            }else if(msgs['msgs'][i].usuario==1){
                html+='<div class="msgSent tx-r">'
                    +'     <div>'
                    +'        <div class="cont tx-l" ><span>'+msgs['msgs'][i]['conteudo']+'</span></div>'
                    +'        <i class="vizu material-icons">done</i>'
                    +'        <span  class="hora">'+horario+'</span>'
                    +'        </div>'
                    +'    </div>'

            }else{
                html+='<div class="msgReceive tx-l">'
                    +'     <div>'
                    +'        <div class="cont tx-l" ><span>'+msgs['msgs'][i]['conteudo']+'</span></div>'
                    +'        <i class="vizu material-icons">done</i>'
                    +'        <span  class="hora">'+horario+'</span>'
                    +'        </div>'
                    +'    </div>'

            }
        }
        $("#fotoChat").attr('src',"data:image/jpeg;base64,"+msgs['usuario']['foto'])
        $("#nomeChat").text(msgs['usuario']['nome'])
        $("#mensagens-chat").html(html)
    })
    $("#mensagens-chat").scrollTop($("#mensagens-chat").height());
}

function buscarPerfil(idPerfil){
    history.pushState( "usuario", null, "" ); atual = window.history.state;
    $("#perfis").removeClass("down-up");
    $("#perfis").addClass("up-down");
     $.ajax({
        url: '/buscarPerfisPorId?'+idPerfil
     }).done(function(data){
        dados=JSON.parse(data)
        $("#fotoUserAleatorio").attr("src","data:image/jpeg;base64,"+dados.usuario.foto)
        $("#nomeUserAleatorio").text(dados.usuario.nome)
        html=""
        $("#produtosUserAleatorio").html(html)
        for(var i=0;i<Object.keys(dados.roupa).length;i++){
           html+='<div onclick="visualizarProduto2('+dados.roupa[i].id+','+dados.usuario.id+')" id="produto-'+dados.roupa[i].id+'" class="produto"><div class="row"><div class="col s4 visualizar-produto"><div id="produto-img-ref'+dados.roupa[i].id+'" class="refPerfilUsers'+dados.roupa[i].id+' produto_imagem"><img id="produto-img'+dados.roupa[i].id+'" class="imgPerfilUsers'+dados.roupa[i].id+'" src="data:image/jpeg;base64,'+dados.roupa[i].foto1+'"></div></div><div class="produto_info col s6 visualizar-produto"><span class="nome_produto">'+dados.roupa[i].nome+'</span><br><i class="material-icons icons">remove_red_eye</i><span>0</span><i class="material-icons icons">favorite</i><span>0</span></div><div></div></div></div>'
        }
        $("#produtosUserAleatorio").html(html);
        for(var i=0;i<Object.keys(dados.roupa).length;i++){
            resizeImg($(".refPerfilUsers"+dados.roupa[i].id),$(".imgPerfilUsers"+dados.roupa[i].id));
        }
     })

}
  

function visualizarProduto2(idProduto,idUsuario){
    history.pushState( "produto-usuario", null, "" ); atual = window.history.state;
    $(".visualizar-produtoUsuario-tab").removeClass("right-left-ltab");
    $(".visualizar-produtoUsuario-tab").addClass("left-right-ltab");
     $.ajax({
        url: '/buscarRoupasPorId?'+idProduto+','+idUsuario
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

function visualizarProduto(idProduto){
    history.pushState( "produto", null, "" ); atual = window.history.state; 
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
    history.pushState( "edit-produto", null, "" );
    atual = window.history.state;
    $("#editar-produto").removeClass("right-left-ltab");
    $("#editar-produto").addClass("left-right-ltab");
     $.ajax({
        url: '/atualizarRoupas?'+idProduto,
        type: 'post'}).done(function(data){
            var produto=(JSON.parse(data));
            $("#idProdutoEditar").val(idProduto)
            if(produto["foto1"]!= "") $("#previewUpload3").attr("src","data:image/jpeg;base64,"+produto["foto1"])
            if(produto["foto2"]!= "") $("#previewUpload4").attr("src","data:image/jpeg;base64,"+produto["foto2"])
            if(produto["foto3"]!=""){
                $("#fileToUpload5").attr("disabled",false);
                $("#img-preview5").removeClass("label-disabled")
                $("#previewUpload5").attr("src","data:image/jpeg;base64,"+produto["foto3"])
            }
            if($("#previewUpload4").attr("src") != ""){
                $("#fileToUpload5").attr("disabled",false);
                $("#img-preview5").removeClass("label-disabled")
                $("#remover3").css('display', 'block');
            }
            if($("#previewUpload5").attr("src") != ""){
                $("#remover3").css('display', 'none');
                $("#remover4").css('display', 'block');
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
            $("#confirmarDeletar").attr('onclick',"deletarProduto("+idProduto+")")
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
                history.pushState( "foto-perfil", null, "" ); atual = window.history.state;
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

function resetEditForm(){
    $("#previewUpload3").attr('src','');
    $("#previewUpload4").attr('src','');
    $("#previewUpload5").attr('src', '');
    $("#img-preview4").addClass('label-disabled');
    $("#img-preview4").removeClass('able');
    $("#img-preview5").addClass('label-disabled');
    $("#img-preview5").removeClass('able');
    document.getElementById("fileToUpload3").value = "";
    document.getElementById("fileToUpload4").value = "";
    document.getElementById("fileToUpload5").value = "";
    document.getElementById("editar-produtoForm").reset();
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
    //console.log("function \n")
    if($("#editarNome").val() == "" || $("#editarDescricao").val() == ""){
        if($("#editarNome").val() == "") M.toast({html: 'Nome necessário!'}) 
        if($("#editarDescricao").val() == "") M.toast({html: 'Descrição necessária!'}) 
    }else{
        atualizarRoupasEnviar();
        buscaRoupas=0;
        buscarRoupas();
    }
}

function cardImageSwipe(img){
    if($("#cards").children().length != 0){
        $("#cards").children().last().find('div')[0].className += " card-imagens";
        $("#cards").children().last().find('div')[3+img].className += " swiper-button-prev";
        $("#cards").children().last().find('div')[4+img].className += " swiper-button-next";
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
        //console.log("SUPER lIKE ?");
        like(2)
        $("#cards").children().last().css({
            transition: "transform 0.3s",
            transform: 'scale(0.01) translateY(-500%)',
        });
        setTimeout(function(){$("#cards").children().last().remove(); cardImageSwipe();},300);
    }else{
        if((130*moveX) >= 70 && (130*moveX) > 0){//like
            like(1)
            $("#cards").children().last().css({
                transition: "transform 0.3s",
                transform: 'translateX(130%) rotate(12deg)',
            });
            setTimeout(function(){$("#cards").children().last().remove(); cardImageSwipe();},300);
        }
        if((130*moveX) <= -70 && (130*moveX) < 0){
        //console.log("DISlIKE ?");
        like(0)
            $("#cards").children().last().css({
                transition: "transform 0.3s",
                transform: 'translateX(-130%) rotate(-12deg)',
            });
            setTimeout(function(){$("#cards").children().last().remove(); cardImageSwipe();},300);
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

function like(status){
    if($("#cards").html() != ""){
         $.ajax({
            url: "/like?"+status,
            type: "post",
            data:{
                'usuario':$("#cards").children().last().attr("id")
            }
        }).done(function(data){
            console.log(data)
        }) 
    }
}

////////// Botoes de ação ///////////

$("#btn-rever").click(function() {
    $("#cards").children().last().addClass("rever-action");
    setTimeout(function(){$("#cards").children().last().removeClass("rever-action");}, 400);
    //teste
    setTimeout(function(){$("#cards").children().last().remove();}, 800);
});
$("#btn-deslike").click(function() {
    like(0);
    $("#cards").children().last().addClass("deslike-action");
    setTimeout(function(){$("#cards").children().last().removeClass("deslike-action"); }, 400);
    //teste
    setTimeout(function(){$("#cards").children().last().remove();}, 800);    
});
$("#btn-like").click(function() {
    like(1);
    $("#cards").children().last().addClass("like-action");
    setTimeout(function(){$("#cards").children().last().removeClass("like-action");}, 400);
});
$("#btn-superlike").click(function() {
    like(2);
    $("#cards").children().last().addClass("superlike-action");
    setTimeout(function(){$("#cards").children().last().removeClass("superlike-action");}, 400);
    //teste
    setTimeout(function(){$("#cards").children().last().remove();}, 800);    
});

///// Botoes de ação do perfil de user/////
$("#btn-deslike2").click(function() {
    $("#anBlock").css("display", "inline");
    $("#perfis").removeClass("up-down");
    $("#perfis").addClass("down-up");
    setTimeout(function(){$("#cards").children().last().addClass("deslike-action");}, 400);
    $("#anBlock").css("display", "none");
    //teste
    setTimeout(function(){$("#cards").children().last().remove();}, 800);
});
$("#btn-like2").click(function() {
    $("#anBlock").css("display", "inline");
    $("#perfis").removeClass("up-down");
    $("#perfis").addClass("down-up");
    setTimeout(function(){$("#cards").children().last().addClass("like-action");}, 400);
    $("#anBlock").css("display", "none");
        //teste
    setTimeout(function(){$("#cards").children().last().remove();}, 800);
});
$("#btn-superlike2").click(function() {
    $("#anBlock").css("display", "inline-block");
    $("#perfis").removeClass("up-down");
    $("#perfis").addClass("down-up");
    setTimeout(function(){$("#cards").children().last().addClass("superlike-action");}, 400);
    $("#anBlock").css("display", "none");
    //teste
    setTimeout(function(){$("#cards").children().last().remove();}, 800);
});

/////////////////////////////////
        /*$("#deletarProduto").css('display', 'none');
        $("#editar-produto").removeClass("left-right-ltab");
        $("#editar-produto").addClass("right-left-ltab");
        $("#anBlock").css("display", "none");*/