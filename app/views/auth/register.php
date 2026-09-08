<?php require_once '../app/views/layout/header.php'; ?>

<div class="auth-container" style="max-width: 400px; margin: 2rem auto; padding: 2rem; background: var(--secondary-color); color: var(--text-color); border-radius: 8px;">
    <h2>Crear Cuenta</h2>

    <?php if (isset($error)): ?>
        <p style="color: #ff6b6b;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="/index.php?c=Auth&a=register" method="POST" id="form-register">
        <div style="margin-bottom: 1rem;">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required style="width: 100%; padding: 0.5rem; margin-top: 0.3rem;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required style="width: 100%; padding: 0.5rem; margin-top: 0.3rem;">
        </div>

        <button type="submit" style="background: var(--accent-color); color: #fff; border: none; padding: 0.7rem 1.5rem; width: 100%; cursor: pointer;">
            Registrarse
        </button>
    </form>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>