<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include ('../../config.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
}

    // Utilizando consultas preparadas para evitar inyecciones SQL
    $query = "SELECT * FROM usuario WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nombre = $row['usuario_nombre'];
        $apellido = $row['usuario_apellido'];
        $email = $row['usuario_email'];
        $cedula = $row['usuario_cedula'];
        $usuario_rol = $row['usuario_rol'];

    }

    if (isset($_POST['actualizar'])) {
        $id = $_GET['id'];
        $nombre = $_POST['usuario_nombre'];
        $apellido = $_POST['usuario_apellido'];
        $email = $_POST['usuario_email'];
        $cedula = $_POST['usuario_cedula'];
        $usuario_rol = (int) $_POST['usuario_rol'];

        $sql = "UPDATE usuario SET usuario_nombre = ?, usuario_apellido = ?, usuario_email = ?, usuario_cedula = ?, usuario_rol = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssii", $nombre, $apellido, $email, $cedula, $usuario_rol, $id);
        if ($stmt->execute()) {
            header("Location: ../vistas/gestion-usuario.php?status=success");
            exit();
        }else {
            echo "Error al actualizar el registro: " . $stmt->error;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body style="background: url('../../assets/imagenes/fondo.jpg') no-repeat center center fixed; background-size: cover;">

<nav class="navbar bg-primary">
    <div class="container-fluid ">
    <a class="navbar-brand" href="../../index.html" style="font-family: Arial, Helvetica, sans-serif; color: aliceblue;">
        <img src="../assets/imagenes/escudo.png" alt="Logo" width="60" height="60" class="d-inline-block align-text-center ms-4">
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

<div class="container">
        <form action="editar.php?id=<?php echo $_GET['id']; ?>" method="POST" class="custom-form justify-content-center">
        <h4 class="titulo text-center m-3" style="font-family: Arial, Helvetica, sans-serif; color: rgb(4, 4, 125);">EDITAR USUARIO </h4>
        <br>

        <div class="container">
                <div class="form-group row justify-content-center">
                    <div class="col-6">
                        <select class="form-select shadow" name="usuario_rol"  aria-label="Default select example" required>
                            <option value="1"<?php echo ($usuario_rol == 1) ? 'selected' : ''; ?>>Estudiante</option>
                            <option value="2"<?php echo ($usuario_rol == 2) ? 'selected' : ''; ?>>Profesor</option>
                            <option value="3"<?php echo ($usuario_rol == 3) ? 'selected' : ''; ?>>Administrador</option>
                            </select>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group row justify-content-center">
                    <div class="col-6">
                        <input type="text" class="form-control shadow" name="usuario_nombre" value="<?php echo $nombre; ?>" id="nombre" placeholder="Ingrese su nombre" required>
                    </div>
                </div>
                <br>
                <div class="form-group row justify-content-center">
                    <div class="col-6">
                        <input type="text" class="form-control shadow" name="usuario_apellido" value="<?php echo $apellido; ?>" id="apellidos" placeholder="Ingrese sus apellidos" required>
                    </div>
                </div>
                <br>
                <div class="form-group row justify-content-center">
                    <div class="col-6">
                        <input type="number" class="form-control shadow" name="usuario_cedula" value="<?php echo $cedula; ?>" id="cedula" placeholder="Ingrese su cédula o TI" required>
                    </div>
                </div>
                <br>
                <div class="form-group row justify-content-center">
                    <div class="col-6">
                        <input type="email" class="form-control shadow" name="usuario_email"  value="<?php echo $email; ?>" id="email" placeholder="Ingrese su correo electrónico" required>
                    </div>
                </div>
                <br>
                <br>
                <div class="form-group row">
                    <div class="col-12 text-center">
                        <a href="../vistas/gestion-usuario.php" class="btn btn-danger btn-lg shadow">Cancelar </a>
                        <button type="submit" class="btn btn-primary btn-lg shadow" name="actualizar">Actualizar</button>
                    </div>
                    <br><br>
                </div>
                </div>
                
                </div>
        </div>
        <br>
        </form>
    </div>
</div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<footer class="bg-primary text-white py-4" style="position: fixed; bottom: 0; width: 100%;">
    <div class="container-fluid text-center">
        <p>© Juan Camilo González Muñoz</p>
        <p>2024</p>
    </div>
</footer>
</html>
