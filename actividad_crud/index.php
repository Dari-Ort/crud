<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="estilos.css"> 
</head>
<script>
    function confirmacion(){
        var respuesta = confirm("¿Deseas enviar la informacion ?");
        if(respuesta == true ){
            return true;
        }else{
            return false;
        }
    }
</script>
<body>
    <div class="container mt-5">
        <div class="d-flex flex-wrap justify-content-center">
            <!-- Contenedor del formulario -->
            <div class="form-container">
                <div class="card">
                    <div class="card-header text-center bg-primary text-white">
                        <h2>Formulario Registro</h2>
                    </div>
                    <div class="card-body">
                        <form action="insertar.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe tu nombre" required pattern="[a-zA-Z]+">
                            </div>
                            <div class="form-group mb-3">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Escribe tu apellido" required pattern="[a-zA-Z]+" >
                            </div>
                            <div class="form-group mb-3">
                                <label for="telefono">Teléfono</label>
                                <input  minlength="4" maxlength="10" type="text" class="form-control" id="telefono" name="telefono" placeholder="Escribe tu teléfono" required  pattern = "[0-9]+">
                            </div>
                            <div class="form-group mb-3">
                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Escribe tu dirección" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="observacion">Observación</label>
                                <textarea class="form-control" id="observacion" name="observacion" rows="4" placeholder="Escribe alguna observación" required></textarea>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" onclick="return confirmacion()">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Asegúrate de que no hay espacio entre el formulario y la tabla -->
            <div class="w-100"></div> <!-- Nueva línea para forzar un salto de línea -->

            <!-- Contenedor de la tabla -->
            <div class="table-container mt-4"> <!-- Agregando margen superior -->
                <h3 class="text-center">Datos Registrados</h3>
                <table class="table table-bordered table-hover" id="tabla-datos-registrados">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Observación</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'conexion.php';
                        $sql = "SELECT id, nombre, apellido, telefono, direccion, observacion FROM tabla";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . $row["id"] . "</td>
                                        <td>" . $row["nombre"] . "</td>
                                        <td>" . $row["apellido"] . "</td>
                                        <td>" . $row["telefono"] . "</td>
                                        <td>" . $row["direccion"] . "</td>
                                        <td>" . $row["observacion"] . "</td>
                                        <td>
                                            <a href='editar.php?id=" . $row['id'] . "' class='btn btn-warning'>Editar</a>
                                            <a href='eliminar.php?id=" . $row['id'] . "' class='btn btn-danger' onclick=\"return confirm('¿Estás seguro de que deseas eliminar este registro?');\">Eliminar</a>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No hay datos registrados</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                }
            });
        });
    </script>
</body>
</html>
