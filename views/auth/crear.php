<div class="contenedor crear">
<?php include_once  __DIR__ .'/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crear cuenta</p>

        <form class="formulario" method="POST" action="/">
        <div class="nombre">
                <label for="nombre">Nombre</label>
                <input	
                    type="text"
                    id="nombre"
                    placeholder="nombre"
                    name="nombre">
            </div>
            <div class="campo">
                <label for="email">Email</label>
                <input	
                    type="email"
                    id="email"
                    placeholder="email"
                    name="email">
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input	
                    type="password"
                    id="password"
                    placeholder="password"
                    name="password">
            </div>
            <div class="campo">
                <label for="password2">Repetir Password</label>
                <input	
                    type="password"
                    id="password2"
                    placeholder="password"
                    name="password2">
            </div>
            <input type="submit"
                   class="boton"
                   value="Crear cuenta">
        </form>
        <div class="acciones">
            <a href="/">Ya tengo una cuenta</a>
            
        </div>

    </div>
</div>