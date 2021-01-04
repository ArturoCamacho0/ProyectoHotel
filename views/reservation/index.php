<h1 class="title">Mis reservaciones</h1>

<?php if(isset($_SESSION['reservation'])): ?>
    <strong class="alert_green">Se ha reservado correctamente</strong>
<?php unset($_SESSION['reservation']);endif; ?>

<?php if(isset($_SESSION['reservation_delete']) && $_SESSION['reservation_delete'] == 'success'): ?>
    <strong class="alert_green">Se ha eliminado correctamente</strong>
<?php elseif(isset($_SESSION['reservation_delete']) && $_SESSION['reservation_delete'] == 'failed'): ?>
    <strong class="alert_red">Ha ocurrido un error con la eliminación</strong>
<?php endif;unset($_SESSION['reservation_delete']); ?>


<div class="section_rooms reservation">
    <?php if(isset($reservations)): ?>
        <?php if($reservations->num_rows == 0): ?>
            <strong>No hay productos</strong>
        <?php endif; ?>
        
        <?php while($reservation = $reservations->fetch_object()): ?>
            <a class="room" href="<?=base_url?>room/detail&id=<?=$reservation->id_room?>">
                <img src="<?=base_url?>uploads/images/<?=$reservation->image_room?>" alt="Habitación"/>
                <div class="room_detail">
                    <strong>Reservación: <?=$reservation->name_room?></strong>
                    <p><strong>Tamaño: </strong><?=$reservation->size_room?> personas</p>
                    <p><strong>Extras: </strong><?=$reservation->extra_room?></p>
                    <p><strong>Tarjeta con la que pagó: </strong>
                        **** **** **** <?= substr($reservation->card_number, -4) ?></p>
                    <p class="price_text"><strong>Total de la reservación: </strong>$<?=$reservation->price_room?></p>
                </div>
                <a href="<?= base_url?>reservation/delete&id=<?=$reservation->id_reservation?>"class="button_delete red">Eliminar</a>
            </a>
        <?php endwhile; ?>
    <?php endif; ?>
</div>