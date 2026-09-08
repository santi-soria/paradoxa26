<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PARADOXA26 — Crear cuenta</title>
  <link rel="stylesheet" href="../../public/css/style.css" />
</head>
<body>
  <div class="window">
    <div class="title-bar">
      <div class="title-left">
        <span class="title-icon" data-letter="P"></span>
        <span>Paradoxa26 — Crear cuenta</span>
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
          <p>Un caso, un foro, sin nombres reales.</p>
        </div>

        <div class="panel">
          <strong>Qué pasa al registrarte</strong>
          <p>Se te asigna un alias anónimo. Nadie en el foro ve tu nombre real ni tu correo.</p>
          <div class="terminal">
            REGISTROS ABIERTOS: SÍ<br>
            IDENTIDAD: ANONIMIZADA<br>
            NODO: ARG-26
          </div>
        </div>

        <div class="panel panel--warning">
          <strong>Antes de continuar</strong>
          <p>Este foro contiene contenido de misterio y suspenso. Toda pista que compartas queda visible para el resto.</p>
        </div>
      </section>

      <section class="panel-col">
        <div class="panel">
          <h2>Crear cuenta</h2>
  
          <form id="registerForm">
            <div class="field">
              <label for="regUsername">Nombre de usuario</label>
              <input type="text" id="regUsername" name="username" placeholder="Solo para vos, no es público" autocomplete="off" required />
            </div>

            <div class="field">
              <label for="regEmail">Correo</label>
              <input type="email" id="regEmail" name="email" placeholder="nombre@correo.com" autocomplete="off" required />
            </div>

            <div class="field">
              <label for="regPassword">Contraseña</label>
              <input type="password" id="regPassword" name="password" placeholder="Mínimo 8 caracteres" autocomplete="off" required />
            </div>

            <div class="field">
              <label for="regPasswordConfirm">Confirmar contraseña</label>
              <input type="password" id="regPasswordConfirm" placeholder="Repetí la contraseña" autocomplete="off" required />
            </div>

            <div class="field-hint">Tu alias anónimo se genera automáticamente. Podés cambiarlo después desde Configuración.</div>

            <div class="button-row">
              <button type="submit" class="primary">Crear cuenta</button>
              <button type="button" id="backBtn">Ya tengo cuenta</button>
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
    const registerForm = document.getElementById('registerForm');
    const authMessage = document.getElementById('authMessage');

    registerForm.addEventListener('submit', async function (event) {
      event.preventDefault();
      const pass = document.getElementById('regPassword').value;
      const confirm = document.getElementById('regPasswordConfirm').value;

      if (pass.length < 8) {
        authMessage.classList.remove('success');
        authMessage.textContent = 'La contraseña necesita al menos 8 caracteres.';
        return;
      }

      if (pass !== confirm) {
        authMessage.classList.remove('success');
        authMessage.textContent = 'Las contraseñas no coinciden.';
        return;
      }

      const formData = new FormData(registerForm);
      try {
        const response = await fetch('../../controllers/register_handler.php', {
          method: 'POST',
          body: formData
        });
        const result = await response.json();

        if (result.success) {
          authMessage.classList.add('success');
          authMessage.textContent = result.message + ' Tu ID es: ' + result.userId;
          setTimeout(() => { window.location.href = 'login.php'; }, 2000);
        } else {
          authMessage.classList.remove('success');
          authMessage.textContent = result.message;
        }
      } catch (error) {
        authMessage.classList.remove('success');
        authMessage.textContent = 'Error de conexión con el servidor.';
      }
    });

    document.getElementById('backBtn').addEventListener('click', function () {
      window.location.href = 'login.php';
    });
  </script>
</body>
</html>
