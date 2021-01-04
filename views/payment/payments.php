<?php if($payments): ?>
    <h1 class="title">Tus tarjetas</h1>

    <a class="button_add" href="<?=base_url?>payment/create">Agregar otra tarjeta</a>

    <?php if(isset($_SESSION['payment_delete']) && $_SESSION['payment_delete'] == "failed"): ?>
        <strong class="alert_red">Ha ocurrido un error al eliminar</strong>
    <?php elseif(isset($_SESSION['payment_delete']) && $_SESSION['payment_delete'] = "succes"): ?>
        <strong class="alert_green">Se ha eliminado correctamente</strong>
    <?php endif;unset($_SESSION['payment_delete']); ?>

    <div class="section_payments">
        <?php while($payment = $payments->fetch_object()): ?>
            <div class="payment_block">
                <strong>Número de tarjeta: </strong><p>**** **** **** <?=substr($payment->card_number, -4)?></p>
                <strong>Fecha de expiración: </strong><p><?=$payment->expiration_date?></p>
                <a class="button_delete red" href="<?=base_url?>payment/delete&id=<?=$payment->id_payment?>">
                    Eliminar tarjeta</a>
                <?php if(isset($_SESSION['id_room'])): ?>
                    <a class="button_session" href="<?=base_url?>reservation/create&id_payment=<?=$payment->id_payment?>">Elegir esta</a>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>