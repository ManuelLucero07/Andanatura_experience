// Inicializar puntajes por tema
let puntajes = {
    1: 0,
    2: 0,
    3: 0,
    4: 0,
    5: 0,
    6: 0,
};

// Guardar respuestas anteriores para restarlas en caso de cambio
let respuestasAnteriores = {};

// Variable para llevar el seguimiento de la sección actual
let pasoActual = 1;

// Función para actualizar el puntaje
function actualizarPuntaje(preguntaId, valor, temaId) {
    // Verificar si ya hay una respuesta previa para la pregunta
    if (respuestasAnteriores[preguntaId]) {
        // Restar el valor anterior
        puntajes[temaId] -= respuestasAnteriores[preguntaId];
    }

    // Sumar el nuevo valor
    puntajes[temaId] += valor;

    // Guardar la nueva respuesta
    respuestasAnteriores[preguntaId] = valor;

    // Actualizar el puntaje en la interfaz
    document.getElementById(`puntaje${temaId}`).textContent = puntajes[temaId];
}

// Función para actualizar la visibilidad de los pasos y botones
function actualizarBotones() {
    // Ocultar todos los pasos
    const pasos = document.querySelectorAll('.seccion');
    pasos.forEach((paso, index) => {
        if (index + 1 === pasoActual) {
            paso.classList.remove('ocultar');
        } else {
            paso.classList.add('ocultar');
        }
    });

    // Lógica para mostrar/ocultar botones
    const btnAnterior = document.getElementById('anterior');
    const btnSiguiente = document.getElementById('siguiente');
    const btnEnviar = document.getElementById('enviar');

    // Mostrar/ocultar el botón "Anterior"
    btnAnterior.style.display = pasoActual === 1 ? 'none' : 'inline-block';

    // Mostrar/ocultar los botones "Siguiente" y "Enviar"
    if (pasoActual === 6) {
        btnSiguiente.style.display = 'none';
        btnEnviar.style.display = 'inline-block';
    } else {
        btnSiguiente.style.display = 'inline-block';
        btnEnviar.style.display = 'none';
    }
}

// Inicializa la encuesta y los botones
actualizarBotones();

// Manejador de eventos para el botón "Siguiente"
document.getElementById('siguiente').addEventListener('click', () => {
    if (pasoActual < 6) {
        pasoActual++;
        actualizarBotones();
    }
});

// Manejador de eventos para el botón "Anterior"
document.getElementById('anterior').addEventListener('click', () => {
    if (pasoActual > 1) {
        pasoActual--;
        actualizarBotones();
    }
});
