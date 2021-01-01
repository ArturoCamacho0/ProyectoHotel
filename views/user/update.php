<h1 class="title">Actualiza tus datos</h1>

<?php if(isset($_SESSION['update']) && $_SESSION['update'] == "failed"): ?>
    <strong class="alert_red">Ha ocurrido un error en la actualización de los datos</strong>
<?php unset($_SESSION['update']); endif; ?>

<div class="form_register">
    <form method="post" action="<?=base_url?>user/update" enctype="multipart/form-data">
        <label for="image">Imágen de perfil</label>
        <?php if(isset($user->image_user) && $user->image_user) : ?>
            <img class="img_profile" src="<?= base_url ?>uploads/images/<?= $user->image_user ?>" alt="Imagen del perfil"/>
        <?php else: ?>
            <img class="img_profile" src="<?= base_url ?>uploads/images/profile_blank.png" alt="Imagen del perfil"/>
        <?php endif; ?>
        <input type="file" name="image"/>

        <input type="hidden" name="id" value="<?=isset($user) ? $user->id_user : ''?>"/>

        <label for="name">Nombre</label>
        <input type="text" name="name" value="<?=isset($user) ? $user->name_user : ''?>"/>

        <label for="last_name">Apellidos</label>
        <input type="text" name="last_name" value="<?=isset($user) ? $user->lastname_user : ''?>"/>

        <label for="gender">Género</label>
        <select name="gender">
            <option>Selecciona tu sexo...</option>
            <option value="male" <?= $user->gender_user == 'male' ? 'selected' : '' ?>>Masculino</option>
            <option value="female" <?= $user->gender_user == 'female' ? 'selected' : '' ?>>Femenino</option>
        </select>

        <label for="birthdate">Fecha de nacimiento</label>
        <input type="date" name="birthdate" value="<?= isset($user) ? $user->birthdate : '' ?>"/>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?=isset($user) ? $user->email_user : ''?>"/>

        <input type="submit" value="Guardar"/>
    </form>
</div>