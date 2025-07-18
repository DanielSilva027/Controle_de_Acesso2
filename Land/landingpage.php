<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      defer
    ></script>
    <link rel="stylesheet" href="../Land/Styles.css" />
    <script>
      function mostrarFormulario() {
        const form = document.getElementById("formFeedback");
        form.style.display = form.style.display === "none" ? "block" : "none";
      }

      function adicionarFeedback() {
        const nome = document.getElementById("nome").value;
        const comentario = document.getElementById("comentario").value;

        if (nome && comentario) {
          const container = document.getElementById("feedbackContainer");
          const div = document.createElement("div");
          div.className = "card blue";
          div.innerHTML = `
          <p>“${comentario}”</p>
          <p class="author">${nome}<br><small>Cliente</small></p>
        `;
          container.appendChild(div);

          document.getElementById("formFeedback").reset();
          document.getElementById("formFeedback").style.display = "none";
        } else {
          alert("Preencha todos os campos.");
        }
      }
    </script>
    <title>Smartcam</title>
  </head>

  <body>
    <header class="header">
      <div class="logo">
        <img src="assets/imagem/teste.png" alt="Logo" />
        <span>Smartcam</span>
      </div>
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
          <a class="navbar-brand text-white" href="/HTML/index.php"
            >SmartCam</a
          >
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
          >
            <span class="navbar-toggler-icon bg-light"></span>
          </button>
          <div
            class="collapse navbar-collapse justify-content-end"
            id="navbarNav"
          >
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link text-white" href="#servicos">Serviços</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#produto">Produto</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#sobre">Sobre nós</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#localizacao"
                  >Localização</a
                >
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <section class="iniciopag">
      <div class="fundo">
        <h1 class="subtitulo">
          Monitoramento em <br />
          tempo real
        </h1>
        <p class="texto">
          Receba notificações imediatas caso um rosto não identificado seja
          detectado, permitindo ação rápida para prevenir incidentes.
        </p>
        <button class="registro">
          <a href="../HTML/index.php">Acesse já →</a>
        </button>
      </div>
      <img
        src="assets/imagem/ChatGPT Image 20 de mai. de 2025, 16_31_53.jpg"
        class="imgseguranca"
        alt="Reconhecimento facial"
      />
    </section>

    <section class="resumo">
      <div class="fundo2">
        <h2 class="subtitulo">
          Segurança<br /><span class="destaque">Aprimorada</span>
        </h2>
        <p class="texto">
          Sua câmera inteligente identifica rostos e sinaliza desconhecidos,
          ajudando<br />a evitar acessos não autorizados e aumentando a
          segurança do ambiente
        </p>
        <button class="registro">
          <a href="/HTML/index.php">Iniciar →</a>
        </button>
      </div>
      <img
        src="assets/imagem/camera-de-seguranca.webp"
        class="imgseguranca"
        alt="Reconhecimento facial"
      />
    </section>

    <section id="produto" class="infproduto">
      <div class="fundo2">
        <h2 class="subtitulo">
          Tecnologia com<br /><span class="destaque">IA Aprimorada</span>
        </h2>
        <p class="texto">
          Sistema evolui continuamente para garantir a máxima precisão na
          <br />identificação
        </p>
        <button class="registro">
          <a href="/HTML/index.php">Começar agora →</a>
        </button>
      </div>
      <img
        src="assets/imagem/image-removebg-preview.png"
        class="img5"
        alt="Reconhecimento facial"
      />
    </section>

    <section class="casa">
      <div class="fundo3">
        <h2 class="subtitulo2">
          Tecnologia com<br /><span class="destaque">IA Aprimorada</span>
        </h2>
        <p class="caracteristica">
          Proteja sua casa, escritório, condomínio ou qualquer outro espaço<br />com
          tecnologia de ponta
        </p>
        <button class="registro">
          <a href="/HTML/index.php">Vamos lá →</a>
        </button>
      </div>
      <img src="assets/imagem/Domótica.jpg" class="img5" alt="casa" />
    </section>

    <section class="iniciopag">
      <div class="fundo2">
        <section id="sobre">
          <div class="minitexto2">
            <h2 class="subtitulo">Sobre <span class="destaque">Nós</span></h2>
            <p class="texto">
              Somos um grupo de três estudantes do curso técnico em Informática
              do IFES – Campus Serra, formado por Thyago, Daniel e Guilherme.<br />
              Nosso projeto, chamado SmartCam, é uma solução inteligente de
              segurança que utiliza inteligência artificial para identificar
              rostos por meio de câmeras.<br />
              Desenvolvido como parte de nossa formação técnica, o SmartCam
              busca aliar tecnologia e inovação para tornar sistemas de
              monitoramento mais eficientes e precisos.
            </p>
            <h2 class="subtitulo">Parcerias</h2>
            <img
              src="assets/imagem/305188163_486985403436985_6813042172280648107_n.jpg"
              class="img6"
              alt="ifes"
            />
          </div>
        </section>
      </div>
    </section>

    <section class="iniciopag">
      <div class="fundo2">
        <section id="servicos">
          <div class="minitexto2">
            <h2 class="subtitulo">Serviços</h2>
            <p class="texto">
              O SmartCam é um sistema de monitoramento inteligente desenvolvido
              especialmente para profissionais da área de segurança. Utilizando
              tecnologia de reconhecimento facial por inteligência artificial, o
              serviço permite identificar e registrar rostos em tempo real,
              oferecendo mais agilidade e precisão na tomada de decisões. Nossa
              solução foi pensada para reforçar a segurança de ambientes
              monitorados, trazendo inovação, confiabilidade e praticidade ao
              dia a dia de vigilantes e agentes de segurança.
            </p>
          </div>
        </section>
      </div>
    </section>
    <section id="localizacao" class="mapasecao">
      <img src="assets/imagem/ac_0039_17_site_mapa.gif" alt="Mapa" />
      <h2>
        Atendemos em <br />
        toda grande Vitória
      </h2>
    </section>

    <h2 class="sub">
      O que os nossos <span class="destaque">clientes</span> acham
    </h2>

    <div class="feedback-container" id="feedbackContainer">
      <div class="card">
        <p>
          “Depois que eu coloquei este produto, eu me senti mais seguro, diminui
          gastos e gostei bastante.”
        </p>
        <p class="author">
          Gabriel Buffon<br /><small>Primeiro cliente</small>
        </p>
      </div>
      <div class="card blue">
        <p>“Muito interessante! Amei.”</p>
        <p class="author">LuzDark<br /><small>Cliente</small></p>
      </div>
      <div class="card blue">
        <p>“Muito funcional, me ajudou bastante.”</p>
        <hr />
        <p class="author">David<br /><small>Cliente</small></p>
      </div>
    </div>
    <div class="container-botao">
      <button class="botao-feedback" onclick="mostrarFormulario()">
        Deixar Feedback
      </button>
    </div>
    <form id="formFeedback">
      <input type="text" id="nome" placeholder="Seu nome" required /><br />
      <textarea id="comentario" placeholder="Seu comentário" required></textarea
      ><br />
      <button type="button" onclick="adicionarFeedback()">Enviar</button>
    </form>
    <footer class="bg-dark text-white py-4 mt-5">
      <div
        class="container d-flex flex-column flex-md-row justify-content-between align-items-center"
      >
        <div>
          <span>Smartcam © 2025</span>
        </div>
        <div class="mt-3 mt-md-0">
          <a href="#" class="text-white text-decoration-none me-3"
            >Termos & Privacidade</a
          >
          <a href="#" class="text-white text-decoration-none me-3">Segurança</a>
          <a href="#" class="text-white text-decoration-none">Status</a>
        </div>
      </div>
    </footer>
  </body>
</html>
