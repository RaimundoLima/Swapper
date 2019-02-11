$("#filtro-btn").click(function() {
    $("#filtro").removeClass("down-up");
    $("#filtro").addClass("up-down");
  });
$("#filtro-btn-voltar").click(function() {
    $("#filtro").removeClass("up-down");
    $("#filtro").addClass("down-up");
});

// TESTEEEEE ////////////////////////////////////////

$("#perfis-btn").click(function() {
    $("#perfis").removeClass("down-up");
    $("#perfis").addClass("up-down");
  });
$("#perfis-btn-voltar").click(function() {
    $("#perfis").removeClass("up-down");
    $("#perfis").addClass("down-up");
});

////////////////////////////////////////////////////

$("#credibilidade-usuario-btn").click(function() {
    $("#credibilidade-usuario").removeClass("right-left-ltab");
    $("#credibilidade-usuario").addClass("left-right-ltab");
});
$("#credibilidade-usuario-btn-voltar").click(function() {
    $("#credibilidade-usuario").removeClass("left-right-ltab");
    $("#credibilidade-usuario").addClass("right-left-ltab");
});

$("#produtos-usuario-btn").click(function() {
    $("#produtos-usuario").removeClass("right-left-ltab");
    $("#produtos-usuario").addClass("left-right-ltab");
});
$("#produtos-usuario-btn-voltar").click(function() {
    $("#produtos-usuario").removeClass("left-right-ltab");
    $("#produtos-usuario").addClass("right-left-ltab");
});

$("#addProduto_btn").click(function() {
    $("#adicionar-produto").removeClass("right-left-ltab");
    $("#adicionar-produto").addClass("left-right-ltab");
});
$("#adicionar-produto-btn-voltar").click(function() {
    $("#adicionar-produto").removeClass("left-right-ltab");
    $("#adicionar-produto").addClass("right-left-ltab");
});
$(".visualizar-produto").click(function() {
    $(".visualizar-produtoUsuario-tab").removeClass("right-left-ltab");
    $(".visualizar-produtoUsuario-tab").addClass("left-right-ltab");
});
$("#visualizar-produtoUsuario-btn-voltar").click(function() {
    $(".visualizar-produtoUsuario-tab").removeClass("left-right-ltab");
    $(".visualizar-produtoUsuario-tab").addClass("right-left-ltab");
});

$("#editarProduto_btn").click(function() {
    $("#editar-produto").removeClass("right-left-ltab");
    $("#editar-produto").addClass("left-right-ltab");
});
$("#editar-produto-btn-voltar").click(function() {
    $("#editar-produto").removeClass("left-right-ltab");
    $("#editar-produto").addClass("right-left-ltab");
});

$("#burguerBtn").click(function() {
    $("#menu-burguer").removeClass("right-left-ltab");
    $("#menu-burguer").css('display', 'flex');
    $("#menu-burguer").addClass("left-right-ltab");
});   
$("#burguerBtn-voltar").click(function() {
    $("#menu-burguer").removeClass("left-right-ltab");
    $("#menu-burguer").addClass("right-left-ltab");
});

$("#menu-burguer-side").click(function() {
    $("#menu-burguer").removeClass("left-right-ltab");
    $("#menu-burguer").addClass("right-left-ltab");
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

$("#rejeitarFoto").click(function() {
    if($("#confirmarFotoPerfil").hasClass("show-tab") == true){
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

/////////////////////////// teste //////////////////////////////////
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
