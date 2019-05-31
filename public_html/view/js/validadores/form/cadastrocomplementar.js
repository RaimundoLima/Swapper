const FORM = document.querySelector('form');
const DATA_NASC = document.querySelector('#data-nasc');
const SPAN_ERRO = document.querySelector('#mensagem-erro');
const DIV_ERRO = document.querySelector('.error-message');


FORM.addEventListener('submit', function(e) {
    SPAN_ERRO.textContent = '';
    const date = new Date();
    const maxYear = date.getFullYear() - 12;
    const dataArray = DATA_NASC.value.split('-');
    const ano = dataArray[0];

    if (ano > maxYear) {
        SPAN_ERRO.innerHTML += 'O ano não pode ser maior que: '+maxYear+'.';
        DATA_NASC.value = '';
        DATA_NASC.focus();

        e.preventDefault();
        DIV_ERRO.style.display = 'block';

        return false;
    }
});