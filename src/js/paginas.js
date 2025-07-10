document.addEventListener("DOMContentLoaded", function () {
    const secciones = document.querySelectorAll(".seccion");
    const siguienteBtn = document.getElementById("siguiente");
    const anteriorBtn = document.getElementById("anterior");
    let seccionActual = 0;

    function mostrarSeccion(index) {
        secciones.forEach((seccion, i) => {
            seccion.classList.toggle("ocultar", i !== index);
        });
        anteriorBtn.classList.toggle("ocultar", index === 0);
        siguienteBtn.classList.toggle("ocultar", index === secciones.length - 1);
        actualizarPuntaje(index);
        
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    function actualizarPuntaje(index) {
        const puntajeElemento = document.getElementById(`puntaje${index + 1}`);
        let puntaje = 0;
        const radios = secciones[index].querySelectorAll("input[type='radio']:checked");
        radios.forEach(radio => {
            puntaje += parseInt(radio.value);
        });
        puntajeElemento.textContent = puntaje;
    }

    siguienteBtn.addEventListener("click", () => {
        if (seccionActual < secciones.length - 1) {
            seccionActual++;
            mostrarSeccion(seccionActual);
        }
    });

    anteriorBtn.addEventListener("click", () => {
        if (seccionActual > 0) {
            seccionActual--;
            mostrarSeccion(seccionActual);
        }
    });

    mostrarSeccion(seccionActual); // Mostrar la primera sección al cargar
});
