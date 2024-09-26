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
<div id="cursos" class="contenido m-5" style="display:block;">
    <h2 class="titulo" style="font-family: Arial, Helvetica, sans-serif;"> <strong> Gestión Académica</strong></h2> 
    <aside>Cursos y Asignaturas</aside>
    <hr>
</div>
<div class="container text-center">
  <div class="row">
    <div class="col">
    <div class="card" style="width: 18rem;">
  <img src="../../assets/imagenes/primergrado1.jpeg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Primero</h5>
    <a href="#" class="btn btn-primary">Entrar</a>
  </div>
</div>
<br>
    </div>
    <div class="col">
    <div class="card" style="width: 18rem;">
  <img src="../../assets/imagenes/segundogrado.jpeg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Segundo</h5>
    <a href="#" class="btn btn-primary">Entrar</a>
  </div>
</div>
<br>
    </div>
    <div class="col">
    <div class="card" style="width: 18rem;">
  <img src="../../assets/imagenes/tercergrado.jpeg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Tercero</h5> 
    <a href="#" class="btn btn-primary">Entrar</a>
  </div>
</div>
<br>
    </div>
    <div class="col">
    <div class="card" style="width: 18rem;">
  <img src="../../assets/imagenes/cuartogrado.jpeg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Cuarto</h5>
    <a href="#" class="btn btn-primary">Entrar</a>
  </div>
</div>  
<br>
  </div>
</div>