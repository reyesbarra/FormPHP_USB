<?php
    $mysqli = new mysqli('localhost', 'usb', 'usb2022', 'formulatio');
        
    $query = "SELECT * FROM contact ORDER BY id DESC LIMIT 1";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $id = $row['id'];
        $cliente = $row['name'];
        $empleado_asignado = $row['empleado_asignado'];
        $departamento = $row['departamento'];

        $mysqli->close();
    } else {
        echo "No se encontraron datos";
    }
?>

<!doctype html>
<html>
    <head>
        <title>Thank You</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    </head>
    <body>

    <div class="container mt-5 text-center">
        <h1 class="mb-5">Muchas Gracias!</h1>
        <p>Buenas tardes, señ@r <b><?php echo $cliente; ?></b></p>
        <p>Gracias por confiar en <b>REYES COMPANY.</b> Su solicitud ha sido recibida y se ha abierto
            un ticket con el id número <b><?php echo $id; ?></b> desde el departamento de 
            <b><?php echo $departamento;?></b> y será atendido por <b><?php echo $empleado_asignado;?></b></p>
        </p>
        
        
    </div>
    
        

        
        
        
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   
    </body>
</html>
