function bloquearBotoes() {

    const botoes = document.querySelectorAll(".acoes button");

    botoes.forEach(function(botao) {
        botao.disabled = true;
    });

}

function mensagemTurno(mensagem) {

    const elemento = document.getElementById("mensagem");

    elemento.innerText = mensagem;

}
function atacar(formulario) {

    bloquearBotoes();

    mensagemTurno("Você atacou!");

    setTimeout(function() {

        const acao = document.createElement("input");

        acao.type = "hidden";
        acao.name = "acao";
        acao.value = "atacar";

        formulario.appendChild(acao);

        formulario.submit();

    }, 1000);

}

function turnoInimigo() {

    bloquearBotoes();

    mensagemTurno("O inimigo vai atacar...");

    setTimeout(function() {

        const formulario = document.querySelector(".acoes form");

        const acao = document.createElement("input");

        acao.type = "hidden";
        acao.name = "acao";
        acao.value = "turno_inimigo";

        formulario.appendChild(acao);

        formulario.submit();

    }, 1000);

}