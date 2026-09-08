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

          <form action="/index.php?c=Auth&a=register" method="POST" id="registerForm">
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

          <?php if (isset($error)): ?>
            <div class="message"><?php echo $error; ?></div>
          <?php endif; ?>
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
    document.getElementById('backBtn').addEventListener('click', function () {
      window.location.href = 'login.php';
    });
  </script>
</body>
</html>
