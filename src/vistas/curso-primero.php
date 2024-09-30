<?php
include '../../config.php';

// Mostrar errores de PHP para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sesión para almacenar los usuarios del curso
session_start();

// Inicializar la sesión de usuarios si no existe
if (!isset($_SESSION['usuarios_primero'])) {
    $_SESSION['usuarios_primero'] = [];
}

// Eliminar un usuario del curso
if (isset($_POST['eliminar_usuario'])) {
    $usuario_id = $_POST['usuario_id'];
    if (($key = array_search($usuario_id, $_SESSION['usuarios_primero'])) !== false) {
        unset($_SESSION['usuarios_primero'][$key]);
    }
}

// Agregar usuario al curso si no está ya agregado
if (isset($_POST['agregar_usuario'])) {
    $usuario_id = $_POST['usuario_id'];
    if (!in_array($usuario_id, $_SESSION['usuarios_primero'])) {
        $_SESSION['usuarios_primero'][] = $usuario_id;
    }
}

// Obtener lista de todos los usuarios para mostrarlos en el formulario
$sql_usuarios = "SELECT * FROM usuario";
$result_usuarios = $conn->query($sql_usuarios);

// Obtener los roles para cada usuario agregado al curso
function obtener_rol($usuario_id, $conn) {
    $sql_rol = "SELECT r.nombre_rol FROM usuario u 
                INNER JOIN roles r ON u.usuario_rol = r.id 
                WHERE u.id = $usuario_id";
    $result_rol = $conn->query($sql_rol);
    $rol = $result_rol->fetch_assoc();
    return $rol['nombre_rol'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso Primero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script>
        // Función para mostrar/ocultar el formulario de agregar usuarios
        function toggleFormulario() {
            var formulario = document.getElementById('formulario-agregar');
            if (formulario.style.display === 'none') {
                formulario.style.display = 'block';
            } else {
                formulario.style.display = 'none';
            }
        }
    </script>
</head>
<body style="background: url('../../assets/imagenes/fondo.jpg') no-repeat center center fixed; background-size: cover;">
<nav class="navbar bg-primary">
    <div class="container-fluid ">
    <a class="navbar-brand" href="../../index.html" style="font-family: Arial, Helvetica, sans-serif; color: aliceblue;">
        <img src="../../assets/imagenes/escudo.png" alt="Logo" width="60" height="60" class="d-inline-block align-text-center ms-4">
        Institución Educativa  Artes y Letras
    </a>
    <a href="#" class="d-flex align-items-center me-5" style="text-decoration: solid;">
        <div class="me-3 text-light">
            <i class="bi bi-person-circle fs-4"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
            </svg></i>
        </div>
        <div class="text-light">
            <p class="m-0">Nombre de Usuario</p>
            <small>Rol de Usuario</small>
        </div>
    </a>
</nav>
<br>
<ul class="nav nav-pills nav-fill">
    <li class="nav-item">
    <a class="nav-link" href="../../src/vistas/noticias.html" data-target="noticias">Noticias</a>
    </li>
    <li class="nav-item">
    <a class="nav-link active" href="../../src/vistas/gestion.html" data-target="gestion">Gestión Académica</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="../../src/vistas/recursos.html" data-target="recursos">Recursos Educativos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../../src/vistas/pagos.html" data-target="pagos">Pagos</a>
    </li>
</ul>
<div id="cursos" class="contenido m-5" style="display:block;">
    <h2 class="titulo" style="font-family: Arial, Helvetica, sans-serif;"> <strong> Gestión Académica</strong></h2> 
    <aside>Cursos y Asignaturas - Grado Primero</aside>
    <hr>

<div class="container">
    <!-- Mostrar usuarios agregados al curso Primero -->
    <h2>Lista de estudiantes:</h2>
    <ul>
    <?php
    if (!empty($_SESSION['usuarios_primero'])) {
        foreach ($_SESSION['usuarios_primero'] as $usuario_id) {
            $sql_usuario = "SELECT usuario_nombre, usuario_apellido FROM usuario WHERE id = $usuario_id";
            $result_usuario = $conn->query($sql_usuario);
            $usuario = $result_usuario->fetch_assoc();
            $rol_usuario = obtener_rol($usuario_id, $conn);  // Obtener el rol del usuario
            ?>
            <li>
                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                    <span><?php echo $usuario['usuario_nombre'] . " " . $usuario['usuario_apellido'] . " - Rol: " . $rol_usuario; ?></span>
                    <form method="POST">
                        <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>">
                        <button type="submit" name="eliminar_usuario" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </li>
            <?php
        }
    } else {
        echo "<li>No hay estudiantes agregados aún.</li>";
    }
    ?>
</ul>

    <!-- Botón para mostrar/ocultar el formulario de agregar usuarios -->
    <button type="button" class="btn btn-primary" onclick="toggleFormulario()">Agregar Usuario</button>
    <br>

    <!-- Formulario para agregar usuarios (escondido por defecto) -->
    <div id="formulario-agregar">
        <form method="POST">
            <div class="form-group">
                <label for="usuario_id">Seleccionar usuario:</label>
                <select class="form-control" name="usuario_id" id="usuario_id" required>
                    <?php
                    while ($usuario = $result_usuarios->fetch_assoc()) {
                        echo "<option value='" . $usuario['id'] . "'>" . $usuario['usuario_nombre'] . " " . $usuario['usuario_apellido'] . "</option>";
                    }
                    ?>
                </select>
                <br>
            </div>
            <button type="submit" name="agregar_usuario" class="btn btn-primary">Agregar al curso</button>
        </form>
    </div>
</div>
</body>
</html>

<?php
$conn->close();
?>
<br>
<div class="container text-center">
  <div class="row">
    <div class="col">
    <div class="card" style="width: 16rem;">
  <img src="../../assets/imagenes/matematicas.jpeg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Matemáticas</h5>
    <a href="../../src/vistas/curso-primero.php" class="btn btn-primary">Entrar</a>
  </div>
</div>
<br>
    </div>
    <div class="col">
    <div class="card" style="width: 16rem;">
  <img src="../../assets/imagenes/artes.jpeg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Artes</h5>
    <a href="#" class="btn btn-primary">Entrar</a>
  </div>
</div>
<br>
    </div>
    <div class="col">
    <div class="card" style="width: 16rem;">
  <img src="../../assets/imagenes/idiomas.jpeg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Idiomas</h5> 
    <a href="#" class="btn btn-primary">Entrar</a>
  </div>
</div>
<br>
    </div>
    <div class="col">
    <div class="card" style="width: 16rem;">
  <img src="../../assets/imagenes/etica.jpeg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Ética y valores</h5>
    <a href="#" class="btn btn-primary">Entrar</a>
  </div>
</div>  
<br>
  </div>
</div>

<script src="https://kit.fontawesome.com/ad9840dd80.js" crossorigin="anonymous"></script>