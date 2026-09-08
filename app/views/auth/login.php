<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PARADOXA26 — Acceso</title>
  <link rel="stylesheet" href="../../public/css/style.css" />
</head>
<body>
  <div class="window">
    <div class="title-bar">
      <div class="title-left">
        <span class="title-icon" data-letter="P"></span>
        <span>Paradoxa26 — Acceso al foro</span>
      </div>
      <div class="window-controls">
        <div class="ctrl">_</div>
        <div class="ctrl">□</div>
        <div class="ctrl">×</div>
      </div>
    </div>

    <div class="menu-bar">
      <span>Archivo</span>
      <span>Ver</span>
      <span>Ayuda</span>
    </div>

    <div class="content-2col">
      <section class="panel-col">
        <div class="panel">
          <h1>PARADOXA26</h1>
          <p>Un caso, un foro, sin nombres reales. Registrate para empezar a investigar.</p>
        </div>

        <div class="panel">
          <strong>Cómo funciona</strong>
          <p>Al crear tu cuenta se te asigna un alias anónimo. Nadie en el foro ve tu nombre real ni tu correo — solo vos y el sistema.</p>
          <div class="terminal">
            CASE FILE: ACTIVO<br>
            REGISTROS ABIERTOS: SÍ<br>
            IDENTIDAD: ANONIMIZADA<br>
            ÚLTIMA ACTUALIZACIÓN DEL CASO: HOY
          </div>
        </div>

        <div class="panel panel--warning">
          <strong>Antes de continuar</strong><br>
          Este foro contiene contenido de misterio y suspenso. Cualquier pista que compartas queda visible para el resto de los investigadores.
        </div>
      </section>

      <section class="panel-col">
        <div class="panel" id="authPanel">
          <div class="menu-bar" style="margin: -18px -18px 18px -18px;">
            <span class="tab active" id="tabLogin">Iniciar sesión</span>
            <a class="tab" href="register.php" style="text-decoration:none; color:inherit;">Crear cuenta</a>
          </div>

          <!-- LOGIN -->
          <form id="loginForm">
            <p style="margin-bottom:16px;">Ingresá con tu alias o tu correo registrado.</p>

            <div class="field">
              <label for="loginUser">Alias o correo</label>
              <input type="text" id="loginUser" placeholder="Ej: investigador_07" autocomplete="off" required />
            </div>

            <div class="field">
              <label for="loginPassword">Contraseña</label>
              <input type="password" id="loginPassword" placeholder="Contraseña" autocomplete="off" required />
            </div>

            <div class="field-check">
              <input type="checkbox" id="rememberMe" />
              <label for="rememberMe">Mantener la sesión iniciada</label>
            </div>

            <div class="button-row">
              <button type="submit" class="primary">Iniciar sesión</button>
              <button type="button" id="forgotBtn">Olvidé mi contraseña</button>
            </div>
          </form>

          <div class="message" id="authMessage"></div>
        </div>
      </section>
    </div>

    <div class="bottom-bar">
      <div class="status-pill">Conectado a P26-NET</div>
      <div class="status-pill">Capa de seguridad activa</div>
      <div class="status-pill">Build 1.0</div>
    </div>
  </div>

  <script>
    const loginForm = document.getElementById('loginForm');
    const authMessage = document.getElementById('authMessage');

    loginForm.addEventListener('submit', function (event) {
      event.preventDefault();
      // Simulación de login para el front-end
      authMessage.classList.add('success');
      authMessage.textContent = 'Acceso concedido. Redirigiendo al foro...';
      setTimeout(() => { window.location.href = '../home/index.php'; }, 900);
    });

    document.getElementById('forgotBtn').addEventListener('click', function () {
      authMessage.classList.remove('success');
      authMessage.textContent = 'Se envió un enlace de recuperación a tu correo registrado (simulado).';
    });
  </script>
</body>
</html>
