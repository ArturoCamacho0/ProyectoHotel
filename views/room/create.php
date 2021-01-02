<h1 class="title">Agregar habitación</h1>

<?php if(isset($_SESSION['room_add']) && $_SESSION['room_add'] == "failed"): ?>
    <strong class="alert_red">Ha ocurrido un error</strong>
<?php endif; ?>

<div class="form_register">
    <form method="post" action="<?=base_url?>room/save" enctype="multipart/form-data">
        <label for="name">Título de la habitación</label>
        <input type="text" name="name"/>

        <label for="description">Descripción de la habitación</label>
        <textarea name="description"></textarea>

        <label for="size">¿Cuántas personas caben en la habitación?</label>
        <input type="number" name="size"/>

        <label for="price">Precio de la habitación</label>
        <input type="number" name="price"/>

        <label for="status">Estatus de la habitación</label>
        <select name="status">
            <option value="available">Disponible</option>
            <option value="busy">Ocupada</option>
        </select>

        <label for="extra">Extras</label>
        <input type="text" name="extra"/>

        <label for="image">Imágen de la habitación</label>
        <input type="file" name="image"/>

        <input type="submit" value="Guardar"/>
    </form>
</div>