<?php
include '../../config.php';
// Obtener todos los usuarios de la base de datos
$sql = "SELECT usuario.id, usuario_nombre, usuario_apellido, usuario_email, usuario_cedula, nombre_rol, usuario_creado 
        FROM usuario 
        JOIN roles ON usuario.usuario_rol = roles.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body style="background: url('../../assets/imagenes/fondo.jpg') no-repeat center center fixed; background-size: cover;">
<?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Acción realizada con éxito
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> 
<?php   endif;  ?>

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
<div id="noticias" class="contenido m-5" style="display:block;">
    <h2 class="titulo" style="font-family: Arial, Helvetica, sans-serif;"> <strong> Gestión Académica</strong></h2> 
    <aside>Gestión de Usuarios</aside>
    <hr>
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
        </svg> </span>
        <input type="search" class="form-control" placeholder="Buscar Usuario..." aria-label="Buscar Usuario" aria-describedby="addon-wrapping"required autofocus>
            <button id="crearUsuarioBtn" class="btn btn-warning ms-4"data-bs-toggle="modal" data-bs-target="#exampleModal" type="button"><i class="fa-solid fa-user-plus"></i> Crear Nuevo Usuario</button>
            <!-- Modal Para Crear Usuario-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Usuario Nuevo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    <form action="../../registro.php" method="POST" class="custom-form justify-content-center">
    <input type="hidden" name="origin" value="admin">
                <div class="form-group row justify-content-center">
                    <div class="col-6">
                        <select class="form-select shadow" name="usuario_rol" aria-label="Default select example" required>
                            <option value="1">Estudiante</option>
                            <option value="2">Profesor</option>
                            <option value="3">Administrador</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group row justify-content-center">
                    <div class="col-6">
                        <input type="text" class="form-control shadow" name="usuario_nombre" id="nombre" placeholder="Ingrese nombre" required>
                    </div>
                </div>
                <br>
                <div class="form-group row justify-content-center">
                    <div class="col-6">
                        <input type="text" class="form-control shadow" name="usuario_apellido" id="apellidos" placeholder="Ingrese apellidos" required>
                    </div>
                </div>
                <br>
                <div class="form-group row justify-content-center">
                    <div class="col-6">
                        <input type="number" class="form-control shadow" name="usuario_cedula" id="cedula" placeholder="Ingrese cédula o TI" required>
                    </div>
                </div>
                <br>
                <div class="form-group row justify-content-center">
                    <div class="col-6">
                        <input type="email" class="form-control shadow" name="usuario_email" id="email" placeholder="Ingrese correo electrónico" required>
                    </div>
                </div>
                <br>
                <div class="form-group row justify-content-center">
                    <div class="col-6">
                        <input class="form-control shadow"  type="text" name="nacimiento" placeholder="Fecha de Nacimiento" onclick="ocultarError();" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                    </div>
                </div>
                <br>
                <div class="form-group row justify-content-center">
                    <div class="col-6">
                        <input type="password" class="form-control shadow" name="usuario_contraseña" id="contrasena" placeholder="Ingrese contraseña" required>
                    </div>
                </div>
        </div>
    <div class="modal-footer">
        <button type="reset" class="btn btn-warning"> <i class="fa-solid fa-broom"></i>Limpiar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </div>
    </form>
</div>
</div>
</div>

    </div>
    <br>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Correo</th>
            <th scope="col">Cédula o TI</th>
            <th scope="col">Rol</th>
            <th scope="col">Fecha registro</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
        <tr>
        <th scope="row"><?php echo $row['id']; ?></th>
            <td><?php echo $row['usuario_nombre']; ?></td>
            <td><?php echo $row['usuario_apellido']; ?></td>
            <td><?php echo $row['usuario_email']; ?></td>
            <td><?php echo $row['usuario_cedula']; ?></td>
            <td><?php echo $row['nombre_rol']; ?></td>
            <td><?php echo $row['usuario_creado']; ?></td>
            <td>
            
                
                
                <a href="../modelos/editar.php?id=<?php echo $row['id']?>" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i> Editar </a>
                <a href="../modelos/eliminar.php?id=<?php echo $row['id']?>" onclick="return confirmDeletion();" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i> Eliminar </a>
                <script>
                function confirmDeletion() {
                    return confirm("¿Estás seguro de que deseas eliminar este usuario?");
                }
                </script>
            </td>
        
        </tr> 

        <?php endwhile; ?>
        </tbody>
    </table>
            </div>
            </div>         
            </body>  


<script src="https://kit.fontawesome.com/ad9840dd80.js" crossorigin="anonymous"></script>
<script src="../../assets/js/crearUsuario.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php include "../../footer.php" ?>