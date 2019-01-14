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


});

function atualizaChat() {
    if ($('#estado').text() == 'Enviando') {
        return (false);
    }
    $('#estado').text('Enviando');
    $.ajax({
        url: '/chatUpdate',
        type: 'post',
        dataType: 'html',
        data: {

        }
    }).done(function (data) {
        $('#chat').html(data)
        $('#estado').text('parado');
        $("#chat").scrollTop(2000)
    });
    
    //clearInterval(intervalo);
    intervalo = setInterval(function () {
        if ($('#estado').text() == 'Enviando') {
            return (false);
        }
        $('#estado').text('Enviando');
        var mili= new Date();
        $.ajax({
            url: '/chatUpdate',
            type: 'post',
            dataType: 'html',
            data: {
                "date":mili.valueOf()
            }
        }).done(function (data) {
            $('#chat').html(data)
            $('#estado').text('parado');
        });
    }, 1000);
}

function paraChat() {
    clearInterval(intervalo);
}