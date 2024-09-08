// Selecciona el input de búsqueda y el cuerpo de la tabla
const inputBuscar = document.querySelector('.form-control'); // Usando la clase del input para la búsqueda
const tablaUsuarios = document.querySelector('.table tbody');

// Verifica si los elementos existen
if (inputBuscar && tablaUsuarios) {
    // Agrega el evento de búsqueda al input
    inputBuscar.addEventListener('input', () => {
        const textoBusqueda = inputBuscar.value.toLowerCase(); // Obtén el valor del input
        const filasUsuarios = tablaUsuarios.querySelectorAll('tr'); // Selecciona todas las filas de la tabla

        // Itera sobre cada fila para filtrar
        filasUsuarios.forEach((fila) => {
            // Obtén el texto de las columnas Nombre, Apellido y Correo
            const nombreUsuario = fila.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const apellidoUsuario = fila.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const correoUsuario = fila.querySelector('td:nth-child(4)').textContent.toLowerCase();
            const cedulaUsuario = fila.querySelector('td:nth-child(5)').textContent.toLowerCase();

            // Verifica si alguno de los campos incluye el texto de búsqueda
            if (nombreUsuario.includes(textoBusqueda) || apellidoUsuario.includes(textoBusqueda) || correoUsuario.includes(textoBusqueda) || cedulaUsuario.includes(textoBusqueda))  {
                fila.style.display = ''; // Muestra la fila si coincide
            } else {
                fila.style.display = 'none'; // Oculta la fila si no coincide
            }
        });
    });
} else {
    console.log("No se encontraron el input de búsqueda o la tabla de usuarios.");
}

//Editar Usuario 

document.addEventListener("DOMContentLoaded", function() {
    // Agregar un evento a cada botón de editar
    document.querySelectorAll('.btn-editar').forEach(function(button) {
        button.addEventListener('click', function() {
            var usuarioId = this.getAttribute('data-usuario-id');
            var usuarioRol = this.getAttribute('data-usuario-rol');
            var usuarioNombre = this.getAttribute('data-usuario-nombre');
            var usuarioApellido = this.getAttribute('data-usuario-apellido');
            var usuarioCedula = this.getAttribute('data-usuario-cedula');
            var usuarioEmail = this.getAttribute('data-usuario-email');
            var usuarioNacimiento = this.getAttribute('data-usuario-nacimiento');

            // Asignar valores a los campos del modal
            document.getElementById('editar_id').value = usuarioId;
            document.getElementById('editar_rol').value = usuarioRol;
            document.getElementById('editar_nombre').value = usuarioNombre;
            document.getElementById('editar_apellido').value = usuarioApellido;
            document.getElementById('editar_cedula').value = usuarioCedula;
            document.getElementById('editar_email').value = usuarioEmail;
            document.getElementById('editar_nacimiento').value = usuarioNacimiento;
        });
    });
});
    