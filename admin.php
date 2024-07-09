<?php
session_start();
include 'php/conexion_be.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    
    <link rel="stylesheet" href="css/cabecera.css">
    <link rel="stylesheet" href="css/switch.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .table {
            font-size: 14px; /* Tamaño de la fuente de la tabla */
            border-radius: 20px;
            width: 100%;
        }
        .table-rounded {
            border-collapse: collapse;
            border-spacing: 0 -2px;
        }
        .table-rounded th,
        .table-rounded td {
            border: 1px solid #dee2e6; /* Define el color del borde */
            border-radius: 10px; /* Ajusta el valor para lograr el redondeo deseado */
        }
        th, td {
            padding: 8px; /* Relleno de las celdas */
            text-align: center; /* Alineación del texto en las celdas */
        }
    </style>
</head>
<body>
   <div> <br>
   <h1 class="text-center tit">LISTA DE USUARIOS</h1>
<div class="container table-responsive">
    <div>.</div>
    <table class="table table-light table-bordered border-secondary table-rounded">
        <thead class="table-dark">
            <tr>
                <th scope="col" style="width: 30px; vertical-align: middle;">ID</th>
                <th scope="col" style="width: 300px; vertical-align: middle;">Nombre</th>
                <th scope="col" style="width: 100px; vertical-align: middle;">Correo</th>
                <th scope="col" style="width: 100px; vertical-align: middle;">Usuario</th>
                <th scope="col" style="width: 150px; vertical-align: middle;">Contraseña</th>
                <th scope="col" style="width: 150px; vertical-align: middle;">id_rol</th>
                <th scope="col" style="width: 80px; vertical-align: middle;">Editar</th>
                <th scope="col" style="width: 80px; vertical-align: middle;">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM usuarios";
            $result = mysqli_query($conexion, $sql);
            $numeroCorrelativo = 1;

            while ($mostrar = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $numeroCorrelativo ?></td>
                    <td><?php echo $mostrar['nombre_completo'] ?></td>
                    <td><?php echo $mostrar['email'] ?></td>
                    <td><?php echo $mostrar['usuario'] ?></td>
                    <td><?php echo $mostrar['contrasena'] ?></td>
                    <td><?php echo $mostrar['id_rol'] ?></td>
                    <td>
                        <form action="editar_usuario.php" method="post">
                            <input type="hidden" name="usuario_id" value="<?php echo $mostrar['id_usuarios']; ?>">
                            <input class="btn btn-success btn-sm" type="submit" value="Editar">
                        </form>
                    </td>
                    <td>
                        <form action="eliminar_usuario.php" method="post">
                            <input type="hidden" name="usuario_id" value="<?php echo $mostrar['id_usuarios']; ?>">
                            <input class="btn btn-danger btn-sm" type="submit" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php
                $numeroCorrelativo++;
            }
            ?>
        </tbody>
    </table>
    <div class="text-center">
        <a class="btn btn-danger" href="php/logout.php">Cerrar Sesion</a>
    </div><br>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>
