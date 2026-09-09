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
      background: #000;
    }
    #bgCanvas {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    }
    .desktop {
      position: absolute;
      inset: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1;
      pointer-events: none;
    }
    .window {
      position: absolute;
      cursor: default;
      z-index: 2;
      pointer-events: auto;
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
      pointer-events: auto;
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
      pointer-events: auto;
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
<body onload="init()">

  <canvas id="bgCanvas"></canvas>

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
    // --- Window Logic ---
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

    // --- Login Logic ---
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
          window.location.href = 'app/views/auth/login.php';
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

    // --- Tessellated Background Logic ---
    const canvas = document.getElementById('bgCanvas');
    const ctx = canvas.getContext('2d');
    let width, height;
    let points = [];
    let mouse = { x: -1000, y: -1000, lastX: 0, lastY: 0, speed: 0 };
    const spacing = 50;

    function resize() {
      width = canvas.width = window.innerWidth;
      height = canvas.height = window.innerHeight;
      initPoints();
    }

    function initPoints() {
      points = [];
      const cols = Math.ceil(width / spacing) + 1;
      const rows = Math.ceil(height / spacing) + 1;
      for (let y = 0; y <= rows; y++) {
        for (let x = 0; x <= cols; x++) {
          points.push({
            baseX: x * spacing,
            baseY: y * spacing,
            x: x * spacing,
            y: y * spacing,
            vx: 0,
            vy: 0
          });
        }
      }
    }

    function animate() {
      ctx.fillStyle = '#0a246a'; // Deep blue base
      ctx.fillRect(0, 0, width, height);

      const time = Date.now() * 0.001;

      // Update points
      points.forEach((p, i) => {
        // Self-modifying pattern (waves)
        const waveX = Math.sin(time + p.baseY * 0.01) * 15;
        const waveY = Math.cos(time + p.baseX * 0.01) * 15;

        // Mouse interaction
        const dx = p.baseX - mouse.x;
        const dy = p.baseY - mouse.y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        const forceRadius = 200;
        let offsetX = 0, offsetY = 0;

        if (dist < forceRadius) {
          const force = (forceRadius - dist) / forceRadius;
          const push = force * (mouse.speed * 0.2 + 20);
          offsetX = (dx / dist) * push;
          offsetY = (dy / dist) * push;
        }

        p.x = p.baseX + waveX + offsetX;
        p.y = p.baseY + waveY + offsetY;
      });

      // Draw tessellation (Triangles)
      ctx.strokeStyle = 'rgba(160, 200, 255, 0.15)';
      ctx.lineWidth = 1;

      const cols = Math.ceil(width / spacing) + 1;
      const rows = Math.ceil(height / spacing) + 1;

      for (let y = 0; y < rows; y++) {
        for (let x = 0; x < cols; x++) {
          const p1 = points[y * (cols + 1) + x];
          const p2 = points[y * (cols + 1) + (x + 1)];
          const p3 = points[(y + 1) * (cols + 1) + x];
          const p4 = points[(y + 1) * (cols + 1) + (x + 1)];

          if (p1 && p2 && p3) {
            ctx.beginPath();
            ctx.moveTo(p1.x, p1.y);
            ctx.lineTo(p2.x, p2.y);
            ctx.lineTo(p3.x, p3.y);
            ctx.closePath();
            ctx.stroke();
          }
          if (p2 && p3 && p4) {
            ctx.beginPath();
            ctx.moveTo(p2.x, p2.y);
            ctx.lineTo(p3.x, p3.y);
            ctx.lineTo(p4.x, p4.y);
            ctx.closePath();
            ctx.stroke();
          }
        }
      }

      requestAnimationFrame(animate);
    }

    function init() {
      resize();
      centerWindow();
      animate();
    }

    window.addEventListener('resize', resize);
    window.addEventListener('mousemove', (e) => {
      const dx = e.clientX - mouse.lastX;
      const dy = e.clientY - mouse.lastY;
      mouse.speed = Math.sqrt(dx * dx + dy * dy);
      mouse.x = e.clientX;
      mouse.y = e.clientY;
      mouse.lastX = e.clientX;
      mouse.lastY = e.clientY;
    });

  </script>
</body>
</html>
