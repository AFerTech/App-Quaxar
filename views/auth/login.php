<div class="contenedor">
    <h1>Quaxar</h1>
    <p class="tagline">Gestion de clientes</p>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesión</p>

        <form class="formulario" method="POST" action="/">
            <div class="campo">
                <label for="email">Email</label>
                <input	
                    type="email"
                    id="email"
                    placeholder="Tu email"
                    name="email">
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input	
                    type="password"
                    id="password"
                    placeholder="Tu password"
                    name="password">
            </div>
            <input type="submit"
                   class="boton"
                   value="Iniciar Sesión">
        </form>
        <div class="acciones">
            <a href="/crear">Crear cuenta nueva</a>
            <a href="/reestablecer">Reestablecer contraseña</a>
        </div>

    </div>
</div>