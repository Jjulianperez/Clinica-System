// ------------------------------------eventos de pagina------------------------------------------------
document.addEventListener('DOMContentLoaded', () => {
    const botones = document.querySelectorAll('.boton');
    const formulario = document.querySelector('#formulario');
    const campoMedico = document.querySelector('#medico');
    const campoIdMedico = document.querySelector('#id_medico');
    const cerrar = document.querySelector('.cerrar');
    let medicoSeleccionado = null;

    botones.forEach(boton => {
        boton.addEventListener('click', () => {
            const contenedorMedico = boton.closest('.contenedor');
            medicoSeleccionado = contenedorMedico;

            // poner valores al formulario
            campoMedico.value = boton.getAttribute('data-medico');
            campoIdMedico.value = boton.getAttribute('data-id');

            // Ocultar a los medicos
            document.querySelectorAll('.contenedor').forEach(contenedor => {
                if (contenedor !== contenedorMedico) {
                    contenedor.style.display = 'none';
                }
            });

            contenedorMedico.classList.add('centrar');

            formulario.classList.add('mostrar');
        });
    });

    cerrar.addEventListener('click', () => {
        formulario.classList.remove('mostrar');

        document.querySelectorAll('.contenedor').forEach(contenedor => {
            contenedor.style.display = 'grid';
            contenedor.classList.remove('centrar');
        });

        medicoSeleccionado = null;
    });
});
function redirigir() {
    window.location.href = 'addProfe.php';
}
// ----------------------------Mensajes de insertado------------------------------------------------
const formulario = document.querySelector('.formulario-clinica form'); 

formulario.addEventListener('submit', (event) => {
    
    alert("Se hizo la opeacion correctamente.");

    const mensaje = confirm("¿Desea Volver a realizar el formulario?");

    if (mensaje === true) {
        window.location.reload();
    } else {
        alert("Operación finalizada.");
        window.location.href = 'index.php';
        
    }

});
// -----------------------------------Mostrar turno encontrado-------------------------------------------------
