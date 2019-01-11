var intervalo//global
$(document).ready(function(){
    $('#mensagem').submit(function(e){
        e.preventDefault();
        if($('#estado').text() == 'Enviando'){
			return(false);
		}
        $('#estado').text('Enviando');
        $.ajax({
			url: '/teste',
			type: 'post',
            dataType: 'html',
            data:{
                'text':$("#text").val()
            }
        }).done(function(data){
           //alert(data)
           if(data!=""){
            $('#text').val('');
           }
            $('#estado').text('parado');
        });
    });
    atualizaChat()

});
function atualizaChat(){
            //clearInterval(intervalo);
             intervalo= setInterval(function(){
                if($('#estado').text() == 'Enviando'){
                    return(false);
                }
                $('#estado').text('Enviando');
                $.ajax({
                    url: '/chatUpdate',
                    type: 'post',
                    dataType: 'html',
                    data:{
                        
                    }
                }).done(function(data){
                    $('#chat').html(data)
                    $('#estado').text('parado');
                });
            },1000);
}
function paraChat(){
    clearInterval(intervalo);
}