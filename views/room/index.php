<h1 class="title">Habitaciones disponibles</h1>

<?php if(isset($_SESSION['admin'])): ?>
    <a class="button_add" href="<?=base_url?>room/create">Agregar habitación</a>
<?php endif; ?>

<?php if(isset($_SESSION['room_add']) && $_SESSION['room_add'] == "complete"): ?>
    <strong class="alert_green">Se ha creado correctamente!</strong>
<?php unset($_SESSION['room_add']);endif; ?>

<div class="section_rooms">

<?php 
    if(isset($rooms)): 
        while($room = $rooms->fetch_object()):
?>
        <a class="room" href="<?=base_url?>room/detail&id=<?=$room->id_room?>">
            <img src="<?=base_url?>uploads/images/<?=$room->image_room?>" alt="Habitación"/>
            <div class="room_detail">
                <strong><?=$room->name_room?></strong>
                <p><?=$room->size_room?> personas</p>
                <p><?=$room->extra_room?></p>
                <p class="price_text">$<?=$room->price_room?></p>
            </div>
        </a>
    <?php endwhile; ?>
<?php endif; ?>
</div>