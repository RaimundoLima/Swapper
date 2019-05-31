var intervalo //global
$(document).ready(function () {

    $('#mensagem').submit(function (e) {
        e.preventDefault();
        if ($('#estado').text() == 'Enviando') {
            return (false);
        }
        $('#estado').text('Enviando');
        $.ajax({
            url: '/enviaMsg',
            type: 'post',
            dataType: 'html',
            data: {
                'text': $("#text").val()
            }
        }).done(function (data) {
            //alert(data)
            if (data != "") {
                $('#text').val('');
            }
            $('#estado').text('parado');
        });
    });

    //atualizaChat()
    $("#chat").scroll(function() {
        if($("chat").scrollTop()==0){
            $('#estado').text('Enviando');
            $.ajax({
                url: '/Ainda não criado',
                type: 'post',
                dataType: 'html',
                data: {
                    "ultimamsg":$("linkdela")
                }
            }).done(function (data) {
                $('#chat').html(data+$('#chat').html)
                $('#estado').text('parado');
            });

        }
    })

});

function atualizaChat() {
    if ($('#estado').text() == 'Enviando') {
        return (false);
    }
    $('#estado').text('Enviando');
    $.ajax({
        url: '/chatupdate',
        type: 'post',
        dataType: 'html',
        data: {
        }
    }).done(function (data) {
        $('#chat').html(data)
        $('#estado').text('parado');
        setTimeout(function(){
            $("#chat").scrollTop(10000)
        },100)
    });

    intervalo = setInterval(function () {
        if ($('#estado').text() == 'Enviando') {
            return (false);
        }
        $('#estado').text('Enviando');
        var mili= new Date();
        $.ajax({
            url: '/chatupdate',
            type: 'post',
            dataType: 'html',
            data: {
                "date":mili.getTime()
            }
        }).done(function (data) {
            $('#chat').html(data)
            $('#estado').text('parado');
        });
    }, 3000);
}

function paraChat() {
    clearInterval(intervalo);
}