<h1 class="title">Inicia sesión</h1>

<?php if (isset($identity)): ?>
    <strong><?= $identity ?></strong>
<?php endif; ?>

<?php if(isset($_SESSION['error_login'])): ?>
    <strong class="alert_red">Ha ocurrido un error en el inicio de sesión</strong>
<?php endif; ?>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] == "complete"): ?>
    <strong class="alert_green">Se ha registrado correctamente!</strong>
<?php unset($_SESSION['register']); endif; ?>

<div class="form_login">
    <form method="POST" action="<?=base_url?>user/login">
        <label for="email">Email</label>
        <input type="text" name="email"/>

        <label for="password">Contraseña</label>
        <input type="password" name="password"/>

        <input type="submit" value="Entrar"/>
    </form>

    <a href="<?= base_url ?>user/register">¿No tienes una cuenta? Registrate aquí!</a>
</div>