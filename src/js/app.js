document.addEventListener('DOMContentLoaded', function() {
    eventListeners();
    darkMode();
    restoreDarkMode();
});

function darkMode() {
    const botonDarkMode = document.querySelector(".dark-mode-boton");

    botonDarkMode.addEventListener("click", function() {
        document.body.classList.toggle("dark-mode");
        saveDarkModeState(); // Guarda el estado del modo oscuro al cambiarlo
    });
}

function restoreDarkMode() {
    const isDarkModeEnabled = getCookie('darkMode') === 'true' || localStorage.getItem('darkMode') === 'true';

    if (isDarkModeEnabled) {
        document.body.classList.add('dark-mode');
    }
}

function saveDarkModeState() {
    const isDarkModeEnabled = document.body.classList.contains('dark-mode');
    setCookie('darkMode', isDarkModeEnabled);
    localStorage.setItem('darkMode', isDarkModeEnabled);
}

function setCookie(name, value) {
    document.cookie = `${name}=${value}; SameSite=None; Secure; path=/`;
}

function getCookie(name) {
    const cookies = document.cookie.split(';');
    for (const cookie of cookies) {
        const [cookieName, cookieValue] = cookie.trim().split('=');
        if (cookieName === name) {
            return cookieValue;
        }
    }
    return null;
}

function eventListeners() {
    const mobileMenu = document.querySelector(".mobile-menu");

    mobileMenu.addEventListener("click", navegacionResponsive);

    // Muestra campos Condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener("click", mostrarMetodosContacto));
}

function navegacionResponsive() {
    const navegacion = document.querySelector(".navegacion");

    if(navegacion.classList.contains("mostrar")) {
        navegacion.classList.remove("mostrar");
    }
    else {
        navegacion.classList.add("mostrar");
    }
}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector("#contacto");

    if(e.target.value === "telefono") {
        contactoDiv.innerHTML = `
            <label for="telefono">Numero Telefono</label>
            <input type="tel" placeholder="Tu Telefono" id="telefono" name="contacto[telefono]">

            <p>Elija la fecha y la hora para la llamada</p>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora:</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
        <label for="email">E-Mail</label>
        <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" required>
        `;
    }
}
