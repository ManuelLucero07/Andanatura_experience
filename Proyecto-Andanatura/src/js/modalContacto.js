(function() {
    document.addEventListener("DOMContentLoaded", function() {
        mostrarFormularioContacto();
    });

    function mostrarFormularioContacto() {
        const modal = document.createElement("DIV");
        modal.classList.add("modal");
        modal.innerHTML = `
            <form class="formulario contacto-form" method="POST">
                <legend class="legend">Datos de Contacto</legend>
                <div class="campo">
                    <label for="empresa">Nombre de la empresa</label>
                    <input type="text" id="empresa" name="nombreEmpresa" placeholder="Nombre de la empresa" required>
                </div>
                <div class="campo">
                    <label for="nombre">Datos de contacto</label>
                    <input type="text" id="nombre" name="nombreContacto" placeholder="Nombre" required>
                </div>
                <div class="campo">
                    <label for="apellido"></label>
                    <input type="text" id="apellido" name="apellidoContacto" placeholder="Apellido" required>
                </div>
                <div class="campo">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="correoContacto" placeholder="Correo electrónico" required>
                </div>
                <div class="campo">
                    <label for="telefono">Teléfono</label>
                    <input type="tel" id="telefono" name="telefonoContacto" placeholder="Teléfono" required>
                </div>
                <div class="opciones-enviar">
                    <input type="submit" class="submit-datos-contacto" value="Enviar Datos">
                </div>
            </form>
        `;

        document.body.appendChild(modal);

        setTimeout(() => {
            const formulario = modal.querySelector(".formulario");
            formulario.classList.add("animar");
        }, 0);

        modal.addEventListener("click", function(e) {
            e.preventDefault();

            if (e.target.classList.contains("submit-datos-contacto")) {
                const empresa = document.getElementById("empresa").value.trim();
                const nombre = document.getElementById("nombre").value.trim();
                const apellido = document.getElementById("apellido").value.trim();
                const email = document.getElementById("email").value.trim();
                const telefono = document.getElementById("telefono").value.trim();

                // Validar que los campos no estén vacíos
                if (empresa === "" || nombre === "" || apellido === "" || email === "" || telefono === "") {
                    mostrarAlerta("Todos los campos son obligatorios", "error", document.querySelector(".formulario legend"));
                    return;
                }

                // Validar formato de email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    mostrarAlerta("El correo electrónico no es válido", "error", document.querySelector(".formulario legend"));
                    return;
                }

                // Validar que el teléfono sea numérico
                const telefonoRegex = /^\d+$/;
                if (!telefonoRegex.test(telefono)) {
                    mostrarAlerta("El número de teléfono debe contener solo números", "error", document.querySelector(".formulario legend"));
                    return;
                }

                // Rellenar los campos ocultos en el formulario principal
                document.getElementById("nombreEmpresaHidden").value = empresa;
                document.getElementById("nombreContactoHidden").value = nombre;
                document.getElementById("apellidoContactoHidden").value = apellido;
                document.getElementById("correoContactoHidden").value = email;
                document.getElementById("telefonoContactoHidden").value = telefono;

                cerrarModal(modal);
            }
        });
    }

    function cerrarModal(modal) {
        const formulario = modal.querySelector(".formulario");
        formulario.classList.add("cerrar");
        setTimeout(() => {
            modal.remove();
        }, 500);
    }

    function mostrarAlerta(mensaje, tipo, referencia) {
        const alertaPrevia = document.querySelector(".alerta");
        if (alertaPrevia) {
            alertaPrevia.remove();
        }

        const alerta = document.createElement("DIV");
        alerta.classList.add("alerta", tipo);
        alerta.textContent = mensaje;
        
        referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);

        setTimeout(() => {
            alerta.remove();
        }, 5000);
    }
})();
