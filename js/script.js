// script.js

document.addEventListener("DOMContentLoaded", function () {
    // Captura de elementos
    const tarjetasSection = document.getElementById("tarjetasSection");
    const verMasBtn = document.getElementById("verMasBtn");
    const ocultarBtn = document.getElementById("ocultarBtn");

    // Función para mostrar más tarjetas
    function mostrarMasTarjetas() {
        // Obtiene todas las tarjetas dentro de la sección
        const tarjetas = tarjetasSection.querySelectorAll('.card');
        
        // Itera sobre todas las tarjetas y las muestra
        for (let i = 6; i < tarjetas.length; i++) {
            tarjetas[i].style.display = "block";
        }

        // Muestra el botón "Ocultar"
        ocultarBtn.style.display = "inline";
        
        // Oculta el botón "Ver más" después de mostrar todas las tarjetas
        verMasBtn.style.display = "none";
    }

    // Función para ocultar las tarjetas extras
    function ocultarTarjetasExtras() {
        // Obtiene todas las tarjetas dentro de la sección
        const tarjetas = tarjetasSection.querySelectorAll('.card');
        
        // Itera sobre las tarjetas extras y las oculta
        for (let i = 6; i < tarjetas.length; i++) {
            tarjetas[i].style.display = "none";
        }

        // Muestra el botón "Ver más"
        verMasBtn.style.display = "inline";
        
        // Oculta el botón "Ocultar"
        ocultarBtn.style.display = "none";
    }

    // Oculta las tarjetas 7, 8 y 9 inicialmente
    const tarjetas = tarjetasSection.querySelectorAll('.card');
    for (let i = 6; i < tarjetas.length; i++) {
        tarjetas[i].style.display = "none";
    }

    // Agrega eventos a los botones
    verMasBtn.addEventListener("click", mostrarMasTarjetas);
    ocultarBtn.addEventListener("click", ocultarTarjetasExtras);
});





// botones

// Obtener referencia a los botones
var verMasBtn = document.getElementById('verMasBtn');
var ocultarBtn = document.getElementById('ocultarBtn');

// Agregar un evento click al botón "Ver más"
verMasBtn.addEventListener('click', function() {
    
    // Ocultar el botón "Ver más"
    verMasBtn.style.display = 'none';

    // Mostrar el botón "Ocultar"
    ocultarBtn.style.display = 'inline-block';
});

// Agregar un evento click al botón "Ocultar"
ocultarBtn.addEventListener('click', function() {
    // Lógica para ocultar tarjetas
    // ...

    // Ocultar el botón "Ocultar"
    ocultarBtn.style.display = 'none';

    // Mostrar el botón "Ver más"
    verMasBtn.style.display = 'inline-block';
});

// Inicialmente ocultar el botón "Ocultar"
ocultarBtn.style.display = 'none';


















