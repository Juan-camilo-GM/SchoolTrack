<?php
    
    include("../../config.php");

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM usuario WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Query Failed");
        }

        header("Location: /SchoolTrack/src/vistas/gestion-usuario.php?status=success");
    }


?>