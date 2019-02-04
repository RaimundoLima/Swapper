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

$("#addProduto_btn").click(function() {
    inserirRoupas();
});

function inserirRoupas(){
    $.ajax({
        url: '/atualizarFiltro',
        type: 'post',
        dataType: 'json',
        data: {
        }
    }).done(function(){
        //zerar campus tbm
        $("#adicionar-produto").removeClass("left-right-ltab");
        $("#adicionar-produto").addClass("right-left-ltab");
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
            console.log(data)
        })
        buscaRoupas=1;
    }
}


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

//////////////////////////////// TESTE DOS INPUT //////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        //INPUTS DE IMAGEM DO ADICIONAR PRODUTO
        if(input.id == "fileToUpload"){
            reader.onload = function (e) {
                $("#previewUpload").attr('src', e.target.result);
            }
        }
        if(input.id == "fileToUpload1"){
            reader.onload = function (e) {
                $("#previewUpload1").attr('src', e.target.result);
            }
        }
        if(input.id == "fileToUpload2"){
            reader.onload = function (e) {
                $("#previewUpload2").attr('src', e.target.result);
            }
        }
        //////    /////////     ////////////
        //INPUTS DE IMAGEM DO EDITAR PRODUTO
        if(input.id == "fileToUpload3"){
            reader.onload = function (e) {
                $("#previewUpload3").attr('src', e.target.result);
            }
        }
        if(input.id == "fileToUpload4"){
            reader.onload = function (e) {
                $("#previewUpload4").attr('src', e.target.result);
            }
        }
        if(input.id == "fileToUpload5"){
            reader.onload = function (e) {
                $("#previewUpload5").attr('src', e.target.result);
            }
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

$('body').on("change", "input[type=file]", function() {
    readURL(this);
});

//INPUTS DE IMAGEM DO ADICIONAR PRODUTO
document.getElementById("fileToUpload").addEventListener("change", function(e) {
    var size = this.files[0].size;
    if(size < 1048576) { //1MB         
      alert('Permitido'); //Abaixo do permitido
    } else {           
      alert('Não permitido'); //Acima do limite
      this.value = ""; //Limpa o campo          
    }
    e.preventDefault();
});

document.getElementById("fileToUpload1").addEventListener("change", function(e) {
    var size = this.files[0].size;
    if(size < 1048576) { //1MB         
      alert('Permitido'); //Abaixo do permitido
    } else {           
      alert('Não permitido'); //Acima do limite
      this.value = ""; //Limpa o campo          
    }
    e.preventDefault();
});

document.getElementById("fileToUpload2").addEventListener("change", function(e) {
    var size = this.files[0].size;
    if(size < 1048576) { //1MB         
      alert('Permitido'); //Abaixo do permitido
    } else {           
      alert('Não permitido'); //Acima do limite
      this.value = ""; //Limpa o campo          
    }
    e.preventDefault();
});

//INPUTS DE IMAGEM DO eDITAR PRODUTO

document.getElementById("fileToUpload3").addEventListener("change", function(e) {
    var size = this.files[0].size;
    if(size < 1048576) { //1MB         
      alert('Permitido'); //Abaixo do permitido
    } else {           
      alert('Não permitido'); //Acima do limite
      this.value = ""; //Limpa o campo          
    }
    e.preventDefault();
});

document.getElementById("fileToUpload4").addEventListener("change", function(e) {
    var size = this.files[0].size;
    if(size < 1048576) { //1MB         
      alert('Permitido'); //Abaixo do permitido
    } else {           
      alert('Não permitido'); //Acima do limite
      this.value = ""; //Limpa o campo          
    }
    e.preventDefault();
});

document.getElementById("fileToUpload5").addEventListener("change", function(e) {
    var size = this.files[0].size;
    if(size < 1048576) { //1MB         
      alert('Permitido'); //Abaixo do permitido
    } else {           
      alert('Não permitido'); //Acima do limite
      this.value = ""; //Limpa o campo          
    }
    e.preventDefault();
});

/*
$("fileToUpload").on("change", verificarTamanhoImagem(this), true);
$("fileToUpload1").on("change", verificarTamanhoImagem(this));
$("fileToUpload2").on("change", verificarTamanhoImagem(this));


function verificarTamanhoImagem(upload) {
    var size = upload.files[0].size;
    if(size < 1048576) { //1MB         
      alert('Permitido'); //Abaixo do permitido
    } else {           
      alert('Não permitido'); //Acima do limite
      upload.value = ""; //Limpa o campo          
    }
}*/