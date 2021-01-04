<h1 class="title">Método de pago</h1>

<?php if(isset($_SESSION['payment']) && $_SESSION['payment'] == "failed"): ?>
    <strong class="alert_red">Ha ocurrido un error</strong>
<?php endif; ?>

<div class="form_register">
    <form method="post" action="<?=base_url?>payment/save"">
        <label for="card_number">Número de la tarjeta</label>
        <input type="number" name="card_number" min="1000000000000000" max="9999999999999999"/>

        <label for="expiration">Fecha de expiración</label>
        <div class="month_year">
            <label for="expiration_month">Mes</label>
            <select name="expiration_month">
                <?php for($i = 1; $i <= 12; $i++): ?>
                    <option value="<?=$i?>"><?=$i?></option>
                <?php endfor; ?>
            </select><br/>
            <label for="expiration_year">Año</label>
            <select name="expiration_year">
                <?php for($i = 2020; $i <= 2035; $i++): ?>
                    <option value="<?=$i?>"><?=$i?></option>
                <?php endfor; ?>
            </select>

            <label for="cvv">CVV</label>
            <input type="number" name="cvv" max="999"/>
        </div>

        <input type="submit" value="Guardar"/>
    </form>
</div>