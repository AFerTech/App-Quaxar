<?php include_once __DIR__ . '/header_dashboard.php'; ?>

<div class="contenedor-sm">
    <?php  include_once __DIR__ . '/../templates/alertas.php'  ?>

    <form action="/crear_proyectos" method="POST" class="formulario">
    <?php  include_once __DIR__ . '/form_proyecto.php'  ?>
    <input type="submit" value="Crear Proyecto">
    </form>
</div>

<?php include_once __DIR__ . '/footer_dashboard.php'; ?>