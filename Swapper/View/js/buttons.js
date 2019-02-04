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

$(".vizualizar-produto").click(function() {
    $(".vizualizar-produtoUsuario-tab").removeClass("right-left-ltab");
    $(".vizualizar-produtoUsuario-tab").addClass("left-right-ltab");
});
$("#vizualizar-produtoUsuario-btn-voltar").click(function() {
    $(".vizualizar-produtoUsuario-tab").removeClass("left-right-ltab");
    $(".vizualizar-produtoUsuario-tab").addClass("right-left-ltab");
});

$("#editarProduto_btn").click(function() {
    $("#editar-produto").removeClass("right-left-ltab");
    $("#editar-produto").addClass("left-right-ltab");
});
$("#editar-produto-btn-voltar").click(function() {
    $("#editar-produto").removeClass("left-right-ltab");
    $("#editar-produto").addClass("right-left-ltab");
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