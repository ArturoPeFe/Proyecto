<?php
session_start();
require('./conexion.php');

$email = $_SESSION['user'];
$consulta = "SELECT * FROM clientes WHERE email = :email";
$exec = $bdGym->prepare($consulta);
$exec->bindParam(':email', $email);

try {
    $exec->execute();
} catch (PDOException $e) {
    $error = true;
    $mensaje = $e->getMessage();
    $bdGym = null;
}

$datos = $exec->fetch(PDO::FETCH_OBJ);
$_SESSION['nombre'] = $datos->nombre . ' ' . $datos->apellido1 . ' ' . $datos->apellido2;

?>

<!DOCTYPE html>

<head>
    <title>Gimnasio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/all.css">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/log.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" type="text/css" href="../css/datosCliente.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/2eff857ffa.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Menú de pc... -->
    <nav id="menuPc">
        <div id="menu">
            <div id="logo">
                <a href="/Proyecto/">
                    <h2 class="w700">Gym<span class="naranja">Art</span></h2>
                </a>
            </div>
            <div id="opcionesMenu">
                <ul>
                    <li><a href="/Proyecto/">Inicio </a> </li>
                    <li><a href="#">Galería</a></li>
                    <li><a href="#">Valoraciones</a></li>
                    <li><a href="#">Miembros</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </div>
            <div id="acceso">
                <a href="./pages/acceso.php" class="naranja">
                    <h5><i class="bi bi-person-circle"></i></h5>&nbsp
                    <p>
                        <?php
                        if (isset($_SESSION['nombre']))  echo $_SESSION['nombre'];
                        else echo 'Inicia Sesión';
                        ?>
                    </p>
                </a>
            </div>
        </div>
    </nav>
    <!-- Menú de móvil -->
    <nav id="menuMovil" class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand w700" href="/Proyecto/">Gym<span class="naranja">Art</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
                        <a href="./pages/acceso.php"><i class="bi bi-person-circle"></i>
                            <?php
                            if (isset($_SESSION['nombre']))  echo $_SESSION['nombre'];
                            else echo 'Inicia Sesión';
                            ?>
                        </a>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link text-center" aria-current="page" href="/Proyecto/">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-center" href="#">Galería</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-center" href="#">Valoraciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-center" href="#">Miembros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-center" href="#">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-center naranja" href="../pages/acceso.php">Acceder</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div id="img"></div>
    <div id="divDatos">
        <div>
            <h1>Datos Cliente</h1>
            <div id="datos1" class="row justify-content-center">
                <div id="nombre" class="col"><strong>Nombre:&nbsp;</strong><?php echo "{$datos->nombre}"; ?></div>
                <div id="apellidos" class="col"><strong>Apellidos:&nbsp;</strong><?php echo "{$datos->apellido1} {$datos->apellido2}"; ?></div>
            </div>
            <div id="datos2" class="row justify-content-center">
                <div id="dni" class="col"><strong>DNI:&nbsp;</strong><?php echo "{$datos->dni}"; ?></div>
                <div id="email" class="col"><strong>Email:&nbsp;</strong><?php echo " {$datos->email}"; ?></div>
                <div id="telefono" class="col"><strong>Teléfono:&nbsp;</strong><?php echo "{$datos->telefono}"; ?></div>
            </div>
            <div id="datos3" class="row justify-content-center">
                <div id="direccion" class="col"><strong>Dirección:&nbsp;</strong><?php echo "{$datos->direccion}"; ?></div>
            </div>
            <div id="datos4" class="row justify-content-center">
                <div id="suscripcion" class="col"><strong>Estado suscripción:&nbsp;</strong><?php echo "{$datos->suscripcion}"; ?></div>
            </div>
            <div id="divBoton"><button id="boton" type="submit"><a href="cerrarSesion.php">Cerrar Sesión</a></button></div>
        </div>
    </div>

    <footer>
        <div id="redes">
            <a href="#"><i class="fa-brands fa-square-instagram fa-2xl"></i></a>
            <a href="#"><i class="fa-brands fa-square-facebook fa-2xl"></i></a>
            <a href="#"><i class="fa-brands fa-square-x-twitter fa-2xl"></i></a>
        </div>
        <div id="infoFooter">
            <h3>GymArt</h3>
            <p>988 123 456</p>
            <p>info@ejemplocorreo.com</p>
            <p>Calle de la calle, 22 - 32003 Ourense</p>
            <a href="#">Aviso Legal</a>
        </div>
    </footer>
</body>

</html>