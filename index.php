<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PHYLLO OS — System Login</title>
  <link rel="stylesheet" href="app/public/css/style.css" />
  <style>
    body {
      overflow: hidden;
      position: relative;
      height: 100vh;
      width: 100vw;
      margin: 0;
      padding: 0;
    }

    .desktop {
      position: absolute;
      inset: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1;
    }

    .window {
      position: absolute;
      cursor: default;
      z-index: 2;
    }

    .title-bar {
      cursor: move;
      user-select: none;
    }

    .hidden-artifact {
      position: absolute;
      top: 15%;
      left: 10%;
      width: 200px;
      height: 150px;
      background: var(--color-panel);
      border: 2px solid var(--color-titlebar-start);
      box-shadow: 2px 2px 10px rgba(0,0,0,0.5);
      z-index: 0;
      cursor: pointer;
      transition: transform 0.3s ease;
      padding: 10px;
      user-select: none;
    }

    .hidden-artifact:hover {
      transform: translate(10px, 10px);
    }

    .hidden-artifact .title-bar {
      font-size: 10px;
      height: 20px;
    }

    .hidden-artifact .content {
      font-size: 11px;
      color: var(--color-muted);
      margin-top: 5px;
      text-align: center;
    }

    .taskbar {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 30px;
      background: var(--color-panel);
      border-top: 2px solid var(--border-raised-light);
      display: flex;
      align-items: center;
      padding: 0 5px;
      z-index: 10;
      font-size: 12px;
    }

    .start-button {
      padding: 2px 8px;
      border: 2px solid;
      border-color: var(--border-raised-light) var(--border-raised-darker) var(--border-raised-darker) var(--border-raised-light);
      background: var(--color-panel);
      font-weight: bold;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .start-button:active {
      border-color: var(--border-raised-darker) var(--border-raised-light) var(--border-raised-light) var(--border-raised-darker);
    }
  </style>
</head>
<body onload="centerWindow()">

  <!-- Elemento oculto detrás -->
  <div class="hidden-artifact" onclick="alert('Error: Archivo corrupto. El acceso a este sector está restringido por el Administrador.')">
    <div class="title-bar">
      <div class="title-left">SECRET_FILE.TXT</div>
    </div>
    <div class="content">
      [Contenido cifrado]<br>
      "La polilla vuela hacia la luz..."
    </div>
  </div>

  <div class="desktop">
    <div id="mainWindow" class="window">
      <div id="windowHeader" class="title-bar">
        <div class="title-left">
          <span class="title-icon"></span>
          <span>Portal de acceso para empleados</span>
        </div>
        <div class="window-controls">
          <div class="ctrl">_</div>
          <div class="ctrl">□</div>
          <div class="ctrl">×</div>
        </div>
      </div>

      <div class="menu-bar">
        <span>Archivos</span>
        <span>Editar</span>
        <span>Vista</span>
        <span>Herramientas</span>
        <span>Seguridad</span>
        <span>Ayuda</span>
      </div>

      <div class="content">
        <section class="left-panel">
          <div class="banner">
            <h1>PHYLLO OS</h1>
            <p>
              Entorno corporativo interno para la identificación de empleados, el acceso a archivos y las comunicaciones administrativas.
            </p>
          </div>

          <div class="status-box">
            <strong>System Notice</strong><br>
            Este terminal proporciona acceso a determinados recursos internos de la empresa. Los empleados autorizados pueden seguir utilizando sus credenciales de empleado asignadas..

            <div class="terminal">
              SYSTEM STATUS: ONLINE<br>
              REGION NODE: ARG-26<br>
              AUTH SERVICE: RUNNING<br>
              ARCHIVE SYNC: 02:13 AM<br>
              LAST USER SESSION: INCOMPLETE
            </div>
          </div>

          <div class="notice-box">
            <strong>Advertencia de confidencialidad</strong><br>
            El acceso, la divulgación o la duplicación no autorizados de los registros almacenados en este entorno están estrictamente prohibidos y pueden ser objeto de revisión interna.
          </div>
        </section>

        <section class="right-panel">
          <div class="login-box">
            <h2>Employee Login</h2>
            <p>
              Introduzca su código de identificación de empleado y su contraseña para continuar.
            </p>

            <form id="loginForm">
              <div class="field">
                <label for="employeeId">Employee ID</label>
                <input type="text" id="employeeId" placeholder="Example: E-2619" autocomplete="off" />
              </div>

              <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Password" autocomplete="off" />
              </div>

              <div class="button-row">
                <button type="submit">Log In</button>
                <button type="button" id="hintBtn">Asistencia</button>
              </div>
            </form>

            <div class="message" id="message"></div>
          </div>
        </section>
      </div>

      <div class="bottom-bar">
        <div class="status-pill">Connected to P26-NET</div>
        <div class="status-pill">Security Layer Enabled</div>
        <div class="status-pill">Build 5.2.6</div>
      </div>
    </div>
  </div>

  <div class="taskbar">
    <div class="start-button">
      <span style="font-size: 14px;">🪟</span> Inicio
    </div>
    <div style="margin-left: auto; padding-right: 10px; color: var(--color-muted);">
      12:00 PM
    </div>
  </div>

  <script>
    const windowEl = document.getElementById('mainWindow');
    const headerEl = document.getElementById('windowHeader');

    let isDragging = false;
    let offsetX, offsetY;

    headerEl.addEventListener('mousedown', (e) => {
      isDragging = true;
      offsetX = e.clientX - windowEl.offsetLeft;
      offsetY = e.clientY - windowEl.offsetTop;
      windowEl.style.zIndex = 100;
    });

    document.addEventListener('mousemove', (e) => {
      if (!isDragging) return;
      windowEl.style.left = (e.clientX - offsetX) + 'px';
      windowEl.style.top = (e.clientY - offsetY) + 'px';
      windowEl.style.margin = '0';
    });

    document.addEventListener('mouseup', () => {
      isDragging = false;
    });

    function centerWindow() {
      const x = (window.innerWidth - windowEl.offsetWidth) / 2;
      const y = (window.innerHeight - windowEl.offsetHeight) / 2;
      windowEl.style.left = x + 'px';
      windowEl.style.top = y + 'px';
      windowEl.style.margin = '0';
    }

    const form = document.getElementById('loginForm');
    const employeeIdInput = document.getElementById('employeeId');
    const passwordInput = document.getElementById('password');
    const message = document.getElementById('message');
    const hintBtn = document.getElementById('hintBtn');

    const validEmployeeId = 'E-2619';
    const validPassword = 'moth_26';

    form.addEventListener('submit', function (event) {
      event.preventDefault();
      const employeeId = employeeIdInput.value.trim();
      const password = passwordInput.value.trim();

      if (employeeId === validEmployeeId && password === validPassword) {
        message.classList.add('success');
        message.innerHTML = 'Acceso concedido.<br>Cargando ambiente archivado...';
        setTimeout(() => {
          window.location.href = 'app/views/auth/register.php';
        }, 1200);
      } else {
        message.classList.remove('success');
        message.textContent = 'Acceso negado. Credenciales invalidas.';
      }
    });

    hintBtn.addEventListener('click', function () {
      message.classList.remove('success');
      message.textContent = 'Para recuperar las credenciales, revise el código fuente de la página o póngase en contacto con el administrador del sistema.';
    });
  </script>
</body>
</html>
