<?php
//comments
$connect = mysqli_connect('localhost', 'usb', 'usb2022', 'formulatio');

$cliente = isset( $_POST['cliente'] ) ? $_POST['cliente'] : '';
$email = isset( $_POST['email'] ) ? $_POST['email'] : '';
$message = isset( $_POST['message'] ) ? $_POST['message'] : '';
$departamento = isset( $_POST['departamento'] ) ? $_POST['departamento'] : '';

$empleados_atencion_cliente=array("Cristhian Perez","Jaime Duque","Andres Gomez","Carolina Mendez");
$empleados_soporte_tecnico=array("Cristian Malpica","Alexandra Hermin","Juan Navas","Yoely Momposti");
$empleados_facturacion=array("David Montesori","Mayra Sanchez","Sofia Perez","Katerine Agudelo");

$empleado_escogido_random = '';

$cliente_error = '';
$email_error = '';
$message_error = '';

if ($departamento === 'Atencion_Cliente'){
    $empleado_escogido_random=$empleados_atencion_cliente[array_rand($empleados_atencion_cliente,1)];
} elseif ($departamento === 'Soporte_Tecnico'){
    $empleado_escogido_random=$empleados_soporte_tecnico[array_rand($empleados_soporte_tecnico,1)];
} elseif ($departamento === 'Facturacion'){
    $empleado_escogido_random=$empleados_facturacion[array_rand($empleados_facturacion,1)];
}


if (count($_POST))
{ 
    $errors = 0;

    if ($_POST['cliente'] == '')
    {
        $cliente_error = 'Please enter a name';
        $errors ++;
    }

    if ($_POST['email'] == '')
    {
        $email_error = 'Please enter an email address';
        $errors ++;
    }

    if ($_POST['message'] == '')
    {
        $message_error = 'Please enter a message';
        $errors ++;
    }

    if ($errors == 0)
    {

        $query = 'INSERT INTO contact (
                name,
                email,
                message,
                departamento,
                empleado_asignado
            ) VALUES (
                "'.addslashes($_POST['cliente']).'",
                "'.addslashes($_POST['email']).'",
                "'.addslashes($_POST['message']).'",
                "'.addslashes($_POST['departamento']).'",
                "'.addslashes($empleado_escogido_random).'"
            )';
        mysqli_query($connect, $query);

        $message = 'You have received a contact form submission:
            
Cliente: '.$_POST['cliente'].'
Email: '.$_POST['email'].'
Message: '.$_POST['email'];

        mail( 'poveda.geovanny@hotmail.com', 
            'Contact Form Cubmission',
            $message );

        header('Location: thankyou.php');
        die();

    }
}

?>
<!doctype html>
<html>
    <head>
        <title>PHP Contact Form</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
    
        

        <div class="container mt-5">
        <h1 class="text-center mb-5">Formulario en PHP</h1>
        <form method="post" action="" class="col-lg-5 mx-auto">

        <!-- Campo de nombre cliente -->
            <div class="mb-3 ">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="cliente" placeholder="Ingrese su nombre" value="<?php echo $cliente; ?>">
                <?php echo $cliente_error; ?>
            </div>
            

            <!-- Campo de correo electrónico -->
            <div class="mb-3 ">
                <label for="correo" class="form-label">Correo Electrónico:</label>
                <input type="email" class="form-control" name="email" placeholder="Ingrese su correo electrónico" value="<?php echo $email; ?>">
                <?php echo $email_error; ?>
            </div>


            <!-- Campo de mensaje -->
            <div class="mb-3 ">
                <label for="opciones" class="form-label">Mensaje:</label>
                <textarea name="message" class="w-100 form-control" placeholder="Ingrese su mensaje"><?php echo $message; ?></textarea>
                <?php echo $message_error; ?>
            </div>


            <!-- Campo departamento petición -->
            <div class="mb-3  ">
                <label for="lang" class="form-label">Departamento:</label>
                <select class=" form-select m-auto" name="departamento">
                <option value="Atencion_Cliente">Atención al cliente</option>
                <option value="Soporte_Tecnico">Soporte técnico</option>
                <option value="Facturacion">Facturación</option>
                </select>
            </div>
          
            <!-- Botón de envío -->
            <button type="submit" class="btn btn-primary text-center" value="Submit">Enviar</button>
        </form>

    </div>


   
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
