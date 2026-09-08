<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PARADOXA26 — Foro</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <div class="window" style="max-width: 1080px;">
    <div class="title-bar">
      <div class="title-left">
        <span class="title-icon" data-letter="P"></span>
        <span>Paradoxa26 — <span id="viewTitle">Foro</span></span>
      </div>
      <div class="window-controls">
        <div class="ctrl">_</div>
        <div class="ctrl">□</div>
        <div class="ctrl">×</div>
      </div>
    </div>

    <div class="content-sidebar">
      <nav class="side-nav">
        <button class="nav-item active" data-view="viewForo">Foro</button>
        <button class="nav-item" data-view="viewAcertijos">Acertijos</button>
        <button class="nav-item" data-view="viewCuenta">Mi cuenta</button>
        <button class="nav-item" data-view="viewConfig">Configuración</button>
      </nav>

      <main class="main-area">

        <!-- foro -->
        <section id="viewForo" class="view active">
          <div class="panel">
            <h2>Hilos activos del caso</h2>
            <p>Anónimo entre anónimos. Compartí lo que encontraste, preguntá lo que te falta.</p>
          </div>

          <div class="thread-card">
            <h3>¿Alguien más encontró el patrón en el segundo archivo?</h3>
            <div class="meta">investigador_07 · hace 2 horas · 14 respuestas</div>
            <p>Las coordenadas del margen no coinciden con el mapa que compartieron ayer. Puede ser una capa distinta del cifrado...</p>
          </div>

          <div class="thread-card">
            <h3>Registro de acceso sospechoso en el nodo ARG-26</h3>
            <div class="meta">investigador_19 · hace 5 horas · 6 respuestas</div>
            <p>El terminal muestra una sesión incompleta. No sé si es parte del caso o un error real del sitio.</p>
          </div>

          <div class="thread-card">
            <h3>Guía para nuevos: cómo empezar sin spoilers</h3>
            <div class="meta">investigador_02 · hace 1 día · 31 respuestas</div>
            <p>Antes de tocar los acertijos avanzados, empiecen por el módulo de bienvenida. Ahí está la primera pista real.</p>
          </div>
        </section>

        <!-- acertij -->
        <section id="viewAcertijos" class="view">
          <div class="panel">
            <h2>Acertijos del caso</h2>
            <p>Cada acertijo resuelto desbloquea el siguiente. El progreso es individual, no se comparte entre cuentas.</p>
          </div>

          <div class="riddle-card unlocked">
            <span class="lock-tag">DESBLOQUEADO</span>
            <h3>01 — El archivo incompleto</h3>
            <p>Encontrá lo que falta en el registro de la última sesión.</p>
          </div>

          <div class="riddle-card unlocked">
            <span class="lock-tag">DESBLOQUEADO</span>
            <h3>02 — El nodo ARG-26</h3>
            <p>Algo en el estado del sistema no es lo que parece.</p>
          </div>

          <div class="riddle-card locked">
            <span class="lock-tag">BLOQUEADO</span>
            <h3>03 — ???</h3>
            <p>Resolvé el acertijo anterior para revelar este contenido.</p>
          </div>

          <div class="panel" style="margin-top: 16px;">
            <div class="field">
              <label for="riddleCode">Ingresar código de desbloqueo</label>
              <input type="text" id="riddleCode" placeholder="Código encontrado en el acertijo" />
            </div>
            <div class="button-row">
              <button class="primary" id="unlockBtn">Desbloquear</button>
            </div>
            <div class="message" id="riddleMessage"></div>
          </div>
        </section>

        <!-- my acc -->
        <section id="viewCuenta" class="view">
          <div class="panel">
            <h2>Mi cuenta</h2>
            <p>Tu alias es lo único visible para el resto de los investigadores.</p>
          </div>

          <div class="panel">
            <div class="field">
              <label for="aliasField">Alias público</label>
              <input type="text" id="aliasField" value="investigador_07" />
              <div class="field-hint">Este es el nombre que ven los demás usuarios del foro.</div>
            </div>

            <div class="field">
              <label for="bioField">Descripción breve</label>
              <textarea id="bioField" rows="3" placeholder="Contá algo sobre tu forma de investigar (opcional)"></textarea>
            </div>

            <div class="field-hint" style="margin-bottom: 14px;">Progreso del caso: 2 de 8 acertijos resueltos.</div>

            <div class="button-row">
              <button class="primary">Guardar cambios</button>
            </div>
          </div>
        </section>

        <!-- config -->
        <section id="viewConfig" class="view">
          <div class="panel">
            <h2>Configuración</h2>
            <p>Ajustes de cuenta y de apariencia.</p>
          </div>

          <div class="panel">
            <div class="field-check">
              <input type="checkbox" id="darkModeToggle" />
              <label for="darkModeToggle">Modo oscuro</label>
            </div>

            <div class="field-check">
              <input type="checkbox" id="notifToggle" checked />
              <label for="notifToggle">Notificarme respuestas a mis hilos</label>
            </div>

            <div class="field">
              <label for="newPassword">Cambiar contraseña</label>
              <input type="password" id="newPassword" placeholder="Nueva contraseña" />
            </div>

            <div class="button-row">
              <button class="primary">Guardar configuración</button>
            </div>
          </div>

          <div class="panel panel--warning">
            <strong>Zona de riesgo</strong>
            <p>Eliminar tu cuenta borra tu progreso en el caso de forma permanente.</p>
            <div class="button-row">
              <button>Eliminar cuenta</button>
            </div>
          </div>
        </section>

      </main>
    </div>

    <div class="bottom-bar">
      <div class="status-pill">investigador_07</div>
      <div class="status-pill">Conectado a P26-NET</div>
      <div class="status-pill">Build 1.0</div>
    </div>
  </div>

  <script>
   
    const navItems = document.querySelectorAll('.nav-item');
    const views = document.querySelectorAll('.view');
    const viewTitle = document.getElementById('viewTitle');

    const titles = {
      viewForo: 'Foro',
      viewAcertijos: 'Acertijos',
      viewCuenta: 'Mi cuenta',
      viewConfig: 'Configuración'
    };

    navItems.forEach(item => {
      item.addEventListener('click', () => {
        navItems.forEach(i => i.classList.remove('active'));
        item.classList.add('active');

        const target = item.getAttribute('data-view');
        views.forEach(v => v.classList.remove('active'));
        document.getElementById(target).classList.add('active');
        viewTitle.textContent = titles[target];
      });
    });

    document.getElementById('unlockBtn').addEventListener('click', () => {
      const code = document.getElementById('riddleCode').value.trim();
      const msg = document.getElementById('riddleMessage');
      if (!code) {
        msg.classList.remove('success');
        msg.textContent = 'Ingresá un código antes de continuar.';
        return;
      }
      
      msg.classList.remove('success');
      msg.textContent = 'Código incorrecto o acertijo aún no disponible.';
    });
  </script>
</body>
</html>
