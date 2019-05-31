const FORM = document.querySelector('form');
const SENHA = document.querySelector('#password');
const CONF_SENHA = document.querySelector('#confirm-password');
const DATA_NASC = document.querySelector('#data-nasc');
const SPAN_ERRO = document.querySelector('#mensagem-erro');
const DIV_ERRO = document.querySelector('.error-message');

FORM.addEventListener('submit', function(e) {
    SPAN_ERRO.textContent = '';
    let erros = 0;
    const date = new Date();
    const maxYear = date.getFullYear() - 12;
    const dataArray = DATA_NASC.value.split('-');
    const ano = dataArray[0];

    if (SENHA.value !== CONF_SENHA.value) {
        SPAN_ERRO.textContent = 'Os campos de senha não coincidem.';
        SENHA.value = '';
        CONF_SENHA.value = '';
        SENHA.focus();
        erros++;
    }

    if (SENHA.value.length < 8) {
        SPAN_ERRO.textContent = 'Sua senha deve conter ao menos 8 caracteres.';
        SENHA.value = '';
        CONF_SENHA.value = '';
        SENHA.focus();
        erros++;
    }

    if (ano > maxYear) {
        SPAN_ERRO.innerHTML += '<br><br> O ano não pode ser maior que: '+maxYear+'.';
        DATA_NASC.value = '';
        DATA_NASC.focus();
        erros++;
    }

    if (erros !== 0) {
        e.preventDefault();
        DIV_ERRO.style.display = 'block';

        return false;
    }
});
