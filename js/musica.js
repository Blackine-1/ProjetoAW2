const pagina = window.location.pathname;

const dentroDasSalas = pagina.includes("/salas/");

const caminhoExploracao = dentroDasSalas
    ? "../musicas/Mlabirinto.mp4"
    : "musicas/Mlabirinto.mp4";

const caminhoBatalha = dentroDasSalas
    ? "../musicas/Mbatalha.mp3"
    : "musicas/Mbatalha.mp3";

const batalha =
    pagina.includes("combate.php") ||
    pagina.includes("boss.php");

const musica = new Audio(
    batalha ? caminhoBatalha : caminhoExploracao
);

musica.loop = true;

const volumeSalvo = parseFloat(
    sessionStorage.getItem("volumeMusica")
);

musica.volume = isNaN(volumeSalvo) ? 0.3 : volumeSalvo;

const musicaSalva = sessionStorage.getItem("musicaAtual");
const tempoSalvo = parseFloat(
    sessionStorage.getItem("tempoMusica")
);

if (musicaSalva === musica.src && !isNaN(tempoSalvo)) {
    musica.currentTime = tempoSalvo;
}

function tocarMusica() {
    musica.play().catch(() => {});
}

function salvarMusica() {
    sessionStorage.setItem("musicaAtual", musica.src);
    sessionStorage.setItem("tempoMusica", musica.currentTime);
    sessionStorage.setItem("volumeMusica", musica.volume);
}

musica.addEventListener("timeupdate", salvarMusica);

window.addEventListener("beforeunload", salvarMusica);

document.addEventListener("click", tocarMusica, { once: true });
document.addEventListener("keydown", tocarMusica, { once: true });

window.addEventListener("beforeunload", () => {
    sessionStorage.setItem(
        "scrollPosicao",
        window.scrollY
    );
});

document.addEventListener("DOMContentLoaded", () => {

    const scrollSalvo = sessionStorage.getItem("scrollPosicao");

    if (scrollSalvo !== null) {
        window.scrollTo(0, parseInt(scrollSalvo));
    }

    const controle = document.createElement("div");
    controle.id = "controle-musica";

    const icone = document.createElement("span");
    icone.id = "icone-volume";
    icone.textContent = "🔊";

    const barra = document.createElement("input");

    barra.type = "range";
    barra.id = "volume-musica";
    barra.min = "0";
    barra.max = "1";
    barra.step = "0.01";
    barra.value = musica.volume;

    barra.addEventListener("input", () => {

        musica.volume = parseFloat(barra.value);

        sessionStorage.setItem(
            "volumeMusica",
            musica.volume
        );

        if (musica.volume == 0) {
            icone.textContent = "🔇";
        } else if (musica.volume < 0.5) {
            icone.textContent = "🔉";
        } else {
            icone.textContent = "🔊";
        }
    });

    controle.appendChild(icone);
    controle.appendChild(barra);

    document.body.appendChild(controle);
});

tocarMusica();