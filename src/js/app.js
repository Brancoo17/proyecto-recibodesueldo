document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp() {
    mostrarOcultarContrasenas();
}

function mostrarOcultarContrasenas() {
    const botonesToggle = document.querySelectorAll('.toggle-password');

    // Definición de los íconos SVG (Estilo Feather Icons)
    const svgOjoAbierto = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-svg">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
            <circle cx="12" cy="12" r="3"></circle>
        </svg>
    `;
    const svgOjoCerrado = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-svg">
            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
            <line x1="1" y1="1" x2="23" y2="23"></line>
        </svg>
    `;

    botonesToggle.forEach(boton => {
        // Inicializar el botón con el ojo abierto al cargar la página
        boton.innerHTML = svgOjoAbierto;

        boton.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const inputContrasena = document.getElementById(targetId);

            if (inputContrasena) {
                if (inputContrasena.type === 'password') {
                    inputContrasena.type = 'text';
                    this.innerHTML = svgOjoCerrado; // Cambia a ojo tachado
                } else {
                    inputContrasena.type = 'password';
                    this.innerHTML = svgOjoAbierto; // Vuelve a ojo abierto
                }
            }
        });
    });
}

