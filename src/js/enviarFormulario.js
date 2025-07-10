document.addEventListener('DOMContentLoaded', function() {
    const formulario = document.querySelector('.formulario');
    const btnEnviar = document.getElementById('enviar');
    const inputsRadio = document.querySelectorAll('input[type="radio"]');

    btnEnviar.addEventListener('click', function(event) {
        
        // Resetear errores previos
        const errores = validarFormulario();
        
        // Si hay errores, mostrarlos en pantalla
        if (errores.length > 0) {
            event.preventDefault();
            mostrarErrores(errores);
        } else {

        }
    });

    function validarFormulario() {
        const errores = [];
        const preguntasValidadas = new Set(); // Conjunto para evitar duplicados

        // Validar que todas las preguntas tengan una respuesta
        inputsRadio.forEach(input => {
            const name = input.name;
            const group = document.getElementsByName(name);

            // Revisar si ya se validó esta pregunta
            if (!preguntasValidadas.has(name)) {
                const checked = Array.from(group).some(input => input.checked);

                // Si no hay ninguna opción seleccionada, agregar error
                if (!checked) {
                    errores.push(`Por favor responda la pregunta ${parseInt(name.replace('pregunta', '')) + 1} y envie el formulario.`);
                }

                // Marcar esta pregunta como validada
                preguntasValidadas.add(name);
            }
        });

        return errores;
    }

    function mostrarErrores(errores) {
        // Limpiar errores previos
        const erroresDiv = document.querySelectorAll('.error');
        erroresDiv.forEach(error => error.remove());

        // Mostrar nuevos errores
        errores.forEach(error => {
            const p = document.createElement('p');
            p.classList.add('alerta', 'error'); // Agregar clases 'alerta' y 'error'
            p.textContent = error;
            formulario.appendChild(p);
        });
    }

});
