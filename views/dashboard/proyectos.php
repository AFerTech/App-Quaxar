<?php include_once __DIR__ . '/header_dashboard.php'; ?>

<?php if(count($proyectos) === 0){  ?>

    <p class="no-proyectos"> No hay proyectos por mostrar <a href="./crear_proyectos">
        Iniciar un proyecto
    </a></p>

<?php } else{ ?>
    <ul class="listado-proyectos">
    <?php foreach($proyectos as $proyecto) { ?>
                <li class="proyecto">
                    <a href="/proyecto?id=<?php echo $proyecto->url; ?>">
                        <?php echo $proyecto->proyecto; ?>
                    </a>
                </li>
            <?php } ?>
    </ul>
<?php }   ?>    
<?php include_once __DIR__ . '/footer_dashboard.php'; ?>