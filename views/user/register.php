<h1 class="title">Registrate</h1>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] == "failed"): ?>
    <strong class="alert_red">Ha ocurrido un error en el registro</strong>
<?php endif; ?>

<div class="form_register">
    <form method="post" action="<?=base_url?>user/save">
        <label for="name">Nombre</label>
        <input type="text" name="name"/>

        <label for="last_name">Apellidos</label>
        <input type="text" name="last_name"/>

        <label for="gender">Género</label>
        <select name="gender">
        <option selected>Selecciona tu sexo...</option>
            <option value="male">Masculino</option>
            <option value="female">Femenino</option>
        </select>

        <label for="birthdate">Fecha de nacimiento</label>
        <input type="date" name="birthdate"/>

        <label for="email">Email</label>
        <input type="email" name="email"/>

        <label for="password">Contraseña</label>
        <input type="password" name="password"/>

        <input type="submit" value="Guardar"/>
    </form>
</div>