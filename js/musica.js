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
musica.volume = 0.3;

const musicaSalva = sessionStorage.getItem("musicaAtual");
const tempoSalvo = parseFloat(sessionStorage.getItem("tempoMusica"));

if (musicaSalva === musica.src && !isNaN(tempoSalvo)) {
    musica.currentTime = tempoSalvo;
}

function tocarMusica() {
    musica.play().catch(() => {});
}

function salvarMusica() {
    sessionStorage.setItem("musicaAtual", musica.src);
    sessionStorage.setItem("tempoMusica", musica.currentTime);
}

musica.addEventListener("timeupdate", salvarMusica);

window.addEventListener("beforeunload", salvarMusica);

document.addEventListener("click", tocarMusica, { once: true });
document.addEventListener("keydown", tocarMusica, { once: true });

tocarMusica();