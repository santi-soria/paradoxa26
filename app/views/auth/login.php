<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PHYLLO OS — System Access</title>
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
      font-family: Tahoma, Verdana, Arial, sans-serif;
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
      width: 600px;
      border: 1px solid #0a246a;
      background: #d4d0c8;
      box-shadow: 0 0 0 1px #ffffff inset, 4px 4px 20px rgba(0, 0, 0, 0.35);
      pointer-events: auto;
    }
    .title-bar {
      height: 32px;
      background: linear-gradient(to right, #0a246a, #3a6ea5);
      color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 8px;
      font-size: 13px;
      font-weight: bold;
      cursor: move;
      user-select: none;
    }
    .title-left { display: flex; align-items: center; gap: 8px; }
    .title-icon {
      width: 16px;
      height: 16px;
      background: #d8e7f6;
      border: 1px solid #0b2347;
      display: inline-block;
      position: relative;
    }
    .title-icon::after {
      content: attr(data-letter);
      position: absolute;
      inset: 0;
      display: grid;
      place-items: center;
      color: #0a246a;
      font-size: 11px;
      font-weight: bold;
    }
    .window-controls { display: flex; gap: 4px; }
    .ctrl {
      width: 22px;
      height: 20px;
      border: 1px solid #ffffff;
      border-right-color: #404040;
      border-bottom-color: #404040;
      background: #d4d0c8;
      font-size: 12px;
      display: grid;
      place-items: center;
      line-height: 1;
      cursor: pointer;
    }
    .menu-bar {
      background: #d4d0c8;
      border-top: 1px solid #ffffff;
      border-bottom: 1px solid #808080;
      padding: 4px 8px;
      font-size: 12px;
      display: flex;
      gap: 18px;
      flex-wrap: wrap;
    }
    .content-wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 30px;
      background: #c9c5bd;
      min-height: 450px;
    }
    .auth-tabs {
      display: flex;
      gap: 5px;
      margin-bottom: 20px;
    }
    .tab-btn {
      padding: 5px 15px;
      font-size: 12px;
      border: 2px solid;
      border-color: #ffffff #404040 #404040 #ffffff;
      background: #d4d0c8;
      cursor: pointer;
    }
    .tab-btn.active {
      border-color: #404040 #ffffff #ffffff #404040;
      background: #efefef;
      padding: 3px 13px;
      margin-top: 2px;
    }
    .auth-box {
      width: 100%;
      max-width: 380px;
      border: 2px solid;
      border-color: #ffffff #808080 #808080 #ffffff;
      background: #efefef;
      padding: 24px;
      box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
    }
    .auth-box h2 {
      font-size: 19px;
      color: #0a246a;
      margin-bottom: 15px;
      text-align: center;
      font-family: Tahoma, Verdana, Arial, sans-serif;
    }
    .auth-box p {
      font-size: 13px;
      margin-bottom: 20px;
      line-height: 1.5;
      text-align: center;
      color: #444444;
    }
    .field { margin-bottom: 14px; }
    .field label {
      display: block;
      font-size: 12px;
      margin-bottom: 5px;
      font-weight: bold;
    }
    .field input {
      width: 100%;
      padding: 7px 8px;
      font-size: 13px;
      border: 2px inset #c0c0c0;
      background: #ffffff;
      color: #000000;
    }
    .button-row { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 6px; }
    .button-row button {
      min-width: 110px;
      padding: 7px 12px;
      font-size: 12px;
      border: 2px solid;
      border-color: #ffffff #404040 #404040 #ffffff;
      background: #d4d0c8;
      cursor: pointer;
      color: #000000;
    }
    .button-row button:active {
      border-color: #404040 #ffffff #ffffff #404040;
    }
    .hidden { display: none; }
    .taskbar {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 30px;
      background: #d4d0c8;
      border-top: 2px solid #ffffff;
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
      border-color: #ffffff #404040 #404040 #ffffff;
      background: #d4d0c8;
      font-weight: bold;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 4px;
    }
    .start-button:active {
      border-color: #404040 #ffffff #ffffff #404040;
    }
    .bottom-bar {
      border-top: 1px solid #ffffff;
      background: #d4d0c8;
      padding: 6px 8px;
      display: flex;
      justify-content: space-between;
      gap: 12px;
      font-size: 11px;
    }
    .status-pill { border: 2px inset #c0c0c0; padding: 2px 8px; background: #efefef; }
  </style>
</head>
<body onload="init()">

  <canvas id="bgCanvas"></canvas>

  <div class="desktop">
    <div id="mainWindow" class="window">
      <div id="windowHeader" class="title-bar">
        <div class="title-left">
          <span class="title-icon" data-letter="P"></span>
          <span>System Access — PHYLLO OS</span>
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

      <div class="content-wrapper">
        <div class="auth-tabs">
          <button id="btn-login" class="tab-btn active" onclick="toggleAuth('login')">Iniciar Sesión</button>
          <button id="btn-register" class="tab-btn" onclick="toggleAuth('register')">Crear Cuenta</button>
        </div>

        <!-- Login Section -->
        <div id="loginSection" class="auth-box">
          <h2>Iniciar Sesión</h2>
          <p>Introduzca sus credenciales reales para acceder al sistema.</p>

          <?php if (isset($error)): ?>
            <div class="message" style="margin-bottom: 15px; text-align: center; color: red; font-size: 12px;"><?php echo $error; ?></div>
          <?php endif; ?>

          <form action="/index.php?c=Auth&a=login" method="POST">
            <div class="field">
              <label for="email">Correo Electrónico:</label>
              <input type="email" id="email" name="email" required placeholder="usuario@empresa.com" />
            </div>
            <div class="field">
              <label for="password">Contraseña:</label>
              <input type="password" id="password" name="password" required placeholder="********" />
            </div>
            <div class="button-row" style="justify-content: center; margin-top: 20px;">
              <button type="submit">Entrar</button>
            </div>
          </form>
        </div>

        <!-- Register Section -->
        <div id="registerSection" class="auth-box hidden">
          <h2>Crear Cuenta</h2>
          <p>Regístrese para obtener acceso limitado al entorno corporativo.</p>

          <?php if (isset($error)): ?>
            <div class="message" style="margin-bottom: 15px; text-align: center; color: red; font-size: 12px;"><?php echo $error; ?></div>
          <?php endif; ?>

          <form action="/index.php?c=Auth&a=register" method="POST">
            <div class="field">
              <label for="reg-email">Correo Electrónico:</label>
              <input type="email" id="reg-email" name="email" required placeholder="usuario@empresa.com" />
            </div>
            <div class="field">
              <label for="reg-password">Contraseña:</label>
              <input type="password" id="reg-password" name="password" required placeholder="********" />
            </div>
            <div class="button-row" style="justify-content: center; margin-top: 20px;">
              <button type="submit">Registrarse</button>
            </div>
          </form>
        </div>
      </div>

      <div class="bottom-bar">
        <div class="status-pill">Connected to P26-NET</div>
        <div class="status-pill">Secure Gateway Enabled</div>
        <div class="status-pill">Build 5.2.7</div>
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

    function toggleAuth(type) {
      const loginSec = document.getElementById('loginSection');
      const regSec = document.getElementById('registerSection');
      const btnLogin = document.getElementById('btn-login');
      const btnReg = document.getElementById('btn-register');

      if (type === 'register') {
        loginSec.classList.add('hidden');
        regSec.classList.remove('hidden');
        btnLogin.classList.remove('active');
        btnReg.classList.add('active');
      } else {
        regSec.classList.add('hidden');
        loginSec.classList.remove('hidden');
        btnReg.classList.remove('active');
        btnLogin.classList.add('active');
      }
    }

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
      ctx.fillStyle = '#0a246a';
      ctx.fillRect(0, 0, width, height);

      const time = Date.now() * 0.001;

      points.forEach((p) => {
        const waveX = Math.sin(time + p.baseY * 0.01) * 15;
        const waveY = Math.cos(time + p.baseX * 0.01) * 15;

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
