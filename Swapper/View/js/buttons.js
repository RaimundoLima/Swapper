$("#filtro-btn").click(function() {
    history.pushState( "filtro", null, "" ); atual = window.history.state;
    $("#filtro").removeClass("down-up");
    $("#filtro").addClass("up-down");
  });
$("#filtro-btn-voltar").click(function() {
    history.pushState( "descobrir", null, "" );
    $("#filtro").removeClass("up-down");
    $("#filtro").addClass("down-up");
});

$("#perfis-btn-voltar").click(function() {
    if (atual == 'usuario2'){
        history.pushState( "conversa", null, "" ); atual = window.history.state;
        $("#perfis").removeClass("right-left-rtab");
        $("#perfis").addClass("left-right-rtab");
        $(".produtos").empty();
    }else if(atual == "usuario"){
        history.pushState( "descobrir", null, "" ); atual = window.history.state;
        $("#perfis").removeClass("up-down");
        $("#perfis").addClass("down-up");
        $(".produtos").empty();
    }
});

$("#credibilidade-usuario-btn").click(function() {
    history.pushState( "credibilidade", null, "" ); atual = window.history.state;
    $("#credibilidade-usuario").removeClass("right-left-ltab");
    $("#credibilidade-usuario").addClass("left-right-ltab");
});
$("#credibilidade-usuario-btn-voltar").click(function() {
    history.pushState( "perfil", null, "" );
    $("#credibilidade-usuario").removeClass("left-right-ltab");
    $("#credibilidade-usuario").addClass("right-left-ltab");
});

$("#produtos-usuario-btn").click(function() {
    history.pushState( "produtos", null, "" ); atual = window.history.state;
    $("#produtos-usuario").removeClass("right-left-ltab");
    $("#produtos-usuario").addClass("left-right-ltab");
});
$("#produtos-usuario-btn-voltar").click(function() {
    history.pushState( "perfil", null, "" );
    $("#produtos-usuario").removeClass("left-right-ltab");
    $("#produtos-usuario").addClass("right-left-ltab");
});

$("#addProduto_btn").click(function() {
    history.pushState( "add-produto", null, "" ); atual = window.history.state;
    $("#adicionar-produto").removeClass("right-left-ltab");
    $("#adicionar-produto").addClass("left-right-ltab");
});
$("#adicionar-produto-btn-voltar").click(function() {
    history.pushState( "produtos", null, "" ); atual = window.history.state;
    $("#adicionar-produto").removeClass("left-right-ltab");
    $("#adicionar-produto").addClass("right-left-ltab");
});
$(".visualizar-produto").click(function() {
    $(".visualizar-produtoUsuario-tab").removeClass("right-left-ltab");
    $(".visualizar-produtoUsuario-tab").addClass("left-right-ltab");
});

$("#visualizar-produtoUsuario-btn-voltar").click(function() {
    switch(atual){
        case 'produto':
            history.pushState( "produtos", null, "" ); atual = window.history.state;
            $(".visualizar-produtoUsuario-tab").removeClass("left-right-ltab");
            $(".visualizar-produtoUsuario-tab").addClass("right-left-ltab");
        break;
        case 'produto-usuario':
            history.pushState( "usuario", null, "" ); atual = window.history.state;
            $(".visualizar-produtoUsuario-tab").removeClass("up-down");
            $(".visualizar-produtoUsuario-tab").addClass("down-up");
        break;
        case 'produto-usuario2':
            history.pushState( "usuario2", null, "" ); atual = window.history.state;
            $(".visualizar-produtoUsuario-tab").removeClass("right-left-rtab");
            $(".visualizar-produtoUsuario-tab").addClass("left-right-rtab");
        break;
    }
});

$("#editarProduto_btn").click(function() {
    history.pushState( "edit-produto", null, "" ); atual = window.history.state;
    $("#editar-produto").removeClass("right-left-ltab");
    $("#editar-produto").addClass("left-right-ltab");
});

$("#editar-produto-btn-voltar").click(function() {
    history.pushState( "produtos", null, "" );
    $("#editar-produto").removeClass("left-right-ltab");
    $("#editar-produto").addClass("right-left-ltab");
});

$("#burguerBtn").click(function() {
    history.pushState( "burguer", null, "" ); atual = window.history.state;
    $("#menu-burguer").removeClass("right-left-ltab");
    $("#menu-burguer").css('display', 'flex');
    $("#menu-burguer").addClass("left-right-ltab");
});   
$("#burguerBtn-voltar").click(function() {
    history.pushState( "perfil", null, "" ); atual = window.history.state;
    $("#menu-burguer").removeClass("left-right-ltab");
    $("#menu-burguer").addClass("right-left-ltab");
});

$("#menu-burguer-side").click(function() {
    history.pushState( "perfil", null, "" ); atual = window.history.state;
    $("#menu-burguer").removeClass("left-right-ltab");
    $("#menu-burguer").addClass("right-left-ltab");
});

$("#chat-btn-voltar").click(function() {
    if(atual == "troca"){
        $("#anBlock").css("display", "inline");
        $("#troca").removeClass("right-left-rtab");
        $("#troca").addClass("left-right-rtab");
        setTimeout(function(){
            $("#troca").css('display','none');
            $(".produtoLista").removeClass("listaActive");
            desfazerChat();
            $("#anBlock").css("display", "none");
        },300)
    }else{
        desfazerChat();
    }
});

function desfazerChat(){
    history.pushState( "mensagens", null, "" ); atual = window.history.state;
    $("#conversa").removeClass("right-left-rtab");
    $("#conversa").addClass("left-right-rtab");
    setTimeout(function(){
        $("#conversa").css('display','none');
        $("#fotoChat").attr('src', '');
        $("#fotoChat").attr('onclick', '');
        $("#nomeChat").html('');
        $("#mensagens-chat").empty();
        $("#text").val('');
    },300)
}

$("#mensagens-chat").click(function(){
    if(atual == "troca"){
        $("#swapBtn").click();
    }
});


$("#swapBtn").click(function(){
    if(atual == "conversa"){
        history.pushState( "troca", null, "" ); atual = window.history.state;
        $("#troca").css('display','inline-block');
        $("#troca").removeClass("left-right-rtab");
        $("#troca").addClass("right-left-rtab");
    }else if(atual == "troca"){
        history.pushState( "conversa", null, "" ); atual = window.history.state;
        $("#troca").removeClass("right-left-rtab");
        $("#troca").addClass("left-right-rtab");
        setTimeout(function(){
            $("#troca").css('display','none');
            $(".produtoLista").removeClass("listaActive");
        },300)
    }
});

$("#rejeitarFoto").click(function() {
    if($("#confirmarFotoPerfil").hasClass("show-tab") == true){
        history.pushState( "burguer", null, "" ); atual = window.history.state;
        $("#confirmarFotoPerfil").removeClass("show-tab");
        $("#confirmarFotoPerfil").addClass("un-show-tab");
        setTimeout(function(){$("#fotoPerfilPreview").attr('src', ''); $("#confirmarFotoPerfil").css('display', 'none');}, 300);
        document.getElementById("fotoPerfilUpload").value = "";
    }
});

$("#remover1").click(function() {
    document.getElementById("fileToUpload1").value = "";
    $("#previewUpload1").attr('src','');
    $("#remover1").css('display', 'none');
    $("#fileToUpload2").prop('disabled', );
    $("#img-preview2").removeClass('able');
    $("#img-preview2").addClass('dis-able');
    $("#fileToUpload2").prop('disabled', true);
});

$("#remover2").click(function() {
    document.getElementById("fileToUpload2").value = "";
    $("#previewUpload2").attr('src','');
    $("#remover2").css('display', 'none');
    $("#remover1").css('display', 'block');
});


$("#remover3").click(function() {
    document.getElementById("fileToUpload4").value = "";
    $("#previewUpload4").attr('src','');
    $("#remover3").css('display', 'none');
    $("#fileToUpload5").prop('disabled', );
    $("#img-preview5").removeClass('able');
    $("#img-preview5").addClass('dis-able');
    $("#fileToUpload5").prop('disabled', true);
});

$("#remover4").click(function() {
    document.getElementById("fileToUpload5").value = "";
    $("#previewUpload5").attr('src','');
    $("#remover4").css('display', 'none');
    $("#remover3").css('display', 'block');
});


$(".produtoLista").click(function(){
    if($(this).hasClass("listaActive")){
        $(this).removeClass("listaActive");
    }else{
        $(this).addClass("listaActive");
    }
});