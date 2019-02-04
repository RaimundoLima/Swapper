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
    
});
$("#adicionar-produtoForm").submit(function(e){
    e.preventDefault();
    inserirRoupas();
})

function inserirRoupas(){
    data = new FormData();
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
        type: 'post',
        data:data
    }).done(function(result){
        console.log(result)
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
                $("#img-preview2").addClass('able');
                $("#img-preview2").removeClass('label-disabled');
            }
        }
        if(input.id == "fileToUpload2"){
            reader.onload = function (e) {
                $("#previewUpload2").attr('src', e.target.result);
                resizeImg($("#img-preview2"),$("#previewUpload2"));
            }
        }
        //////    /////////     ////////////
        //INPUTS DE IMAGEM DO EDITAR PRODUTO
        //////    /////////     ////////////
        reader.readAsDataURL(input.files[0]);
    }
}

$('body').on("change", "input[type=file]", function() {
    readURL(this);
});

//INPUTS DE IMAGEM DO ADICIONAR PRODUTO
$("#fileToUpload").on("change", function(e) {
    var size = this.files[0].size;
    if(size < 1048576) {       
    } else {           
        M.toast({html: 'Imagem muito grande!'}) 
        this.value = "";        
    }
});

$("#fileToUpload1").on("change", function(e) {
    var size = this.files[0].size;
    if(size < 1048576) {       
    } else {           
        M.toast({html: 'Imagem muito grande!'}) 
        this.value = "";        
    }
});

$("#fileToUpload2").on("change", function(e) {
    var size = this.files[0].size;
    if(size < 1048576) {       
    } else {           
        M.toast({html: 'Imagem muito grande!'}) 
        this.value = "";        
    }
});
//INPUTS DE IMAGEM DO eDITAR PRODUTO


/////////////////////////////////////////

function resizeImg(ref, img){
    ref.css("padding-top", "0px");
    img.css("height","auto");
    img.css("width","auto");
    if(img.height() < img.width()){
        img.css("width","100%");
        ref.css("padding-top",((ref.height()/2)-(img.height()/2))+"px");
    }else img.css("height","100%");
}