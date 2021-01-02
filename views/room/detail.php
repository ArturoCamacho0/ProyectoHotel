<?php if(isset($room)): ?>
    <h1 class="title"><?=$room->name_room?></h1>

    <div class="detail_profile">
        <?php if(isset($room->image_room) && $room->image_room) : ?>
            <img class="img_profile room_img" src="<?= base_url ?>uploads/images/<?= $room->image_room ?>" alt="Imagen de habitación"/>
        <?php else: ?>
            <img class="img_profile room_img" src="<?= base_url ?>uploads/images/profile_blank.png" alt="Imagen de habitación"/>
        <?php endif; ?>

        <div class="detail_profile-text">
            <strong>Nombre: </strong>
            <?= $room->name_room ?>

            <br/><br/>
            <strong>Descripción: </strong><br/>
            <?= $room->description_room ?>

            <br/><br/>
            <strong>Tamaño: </strong>
            <?= $room->size_room?> personas

            <br/><br/>
            <strong>Extras: </strong>
            <?= $room->extra_room ?>

            <br/><br/>
            <strong>$<?= $room->price_room ?></strong>
            
            <br/><br/><br/><br/>
            <a class="btn_editp">Reservar</a>
        </div>
    </div>
<?php endif; ?>