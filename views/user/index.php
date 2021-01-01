<?php if ($user): ?>
    <h1 class="title">Gestión del perfil</h1>

    <div class="detail_profile">
        <?php if(isset($user->image_user) && $user->image_user) : ?>
            <img class="img_profile" src="<?= base_url ?>uploads/images/<?= $user->image_user ?>" alt="Imagen del perfil"/>
        <?php else: ?>
            <img class="img_profile" src="<?= base_url ?>uploads/images/profile_blank.png" alt="Imagen del perfil"/>
        <?php endif; ?>

        <div class="detail_profile-text">
            <strong>Nombre(s): </strong>
            <?= $user->name_user ?>

            <br/><br/>
            <strong>Apellidos: </strong>
            <?= $user->lastname_user ?>

            <br/><br/>
            <strong>Género: </strong>
            <?= $user->gender_user == 'male' ? " Masculino" : " Femenino"?>

            <br/><br/>
            <strong>Fecha de nacimiento: </strong>
            <?= $user->birthdate ?>

            <br/><br/>
            <strong>Email: </strong>
            <?= $user->email_user ?>

            <br/><br/><br/><br/>
            <a href="<?=base_url?>user/update_view&id=<?= $user->id_user ?>" class="btn_editp">Editar el perfil</a>
        </div>
    </div>
<?php endif; ?>