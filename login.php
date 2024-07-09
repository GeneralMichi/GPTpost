<?php

    session_start();

    if (isset($_SESSION['usuario'])) {
      header("location: profile.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>GPTpost</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="icon" type="image/png" href="assets/images/logo.png">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-cyborg-gaming.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
</head>
<body>
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <!-- ***** Logo Start ***** -->
                      <a href="index.html" class="logo">
                          <img src="assets/images/logo.png" alt="">
                      </a>
                      <!-- ***** Logo End ***** -->
                      <!-- ***** Search End 
                      <div class="search-input">
                        <form id="search" action="#">
                          <input type="text" placeholder="Type Something" id='searchText' name="searchKeyword" onkeypress="handle" />
                          <i class="fa fa-search"></i>
                        </form>
                      </div>
                      <!-- Search End ***** -->
                      <!-- ***** Menu Start ***** -->
                      <ul class="nav">
                        <li><a href="index.html" class="active">Inicio</a></li>
                        <li><a href="prompts.php">Prompts</a></li>
                        <li><a href="eslogan.php">Eslogan</a></li>
                        <li><a href="login.php" class="active">Login <img src="assets/images/profile.png" alt=""></a></li>
                    </ul>   
                      <a class='menu-trigger'>
                          <span>Menu</span>
                      </a>
                      <!-- ***** Menu End ***** -->
                  </nav>
              </div>
          </div>
      </div>
    </header>
    <!-- ***** Header Area End ***** -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">
                    <main>
                        <div class="contenedor__todo">
                            <div class="caja__trasera">
                                <div class="caja__trasera-login">
                                    <h3>¿Ya tienes una cuenta?</h3>
                                    <p>Inicia sesión para entrar en la página</p>
                                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                                </div>
                                <div class="caja__trasera-register">
                                    <h3>¿Aún no tienes una cuenta?</h3>
                                    <p>Regístrate para que puedas iniciar sesión</p>
                                    <button id="btn__registrarse">Registrarse</button>
                                </div>
                            </div>

                            <!--Formulario de Login y registro-->
                            <div class="contenedor__login-register">
                                <!--Login-->
                                <form action="php/login_usuario_be.php" method="POST" class="formulario__login">
                                    <h2>Iniciar Sesión</h2>
                                    <input type="text" name="email" placeholder="Correo Electronico" required>
                                    <input type="password" name="password" placeholder="Contraseña" required>
                                    <button type="submit">Entrar</button>
                                </form>

                                <!--Register-->
                                <form action="php/registro_usuario_be.php" method="POST" enctype="multipart/form-data" class="formulario__register">
                                    <h2>Registrarse</h2>
                                    <input type="text" name="nombre" placeholder="Nombre completo" required>
                                    <input type="email" name="email" placeholder="Correo Electronico" required>
                                    <input type="text" name="username" placeholder="Usuario" required>
                                    <input type="password" name="password" placeholder="Contraseña" required>
                                    <button type="submit">Registrarse</button>
                                </form>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/login.js"></script>
</body>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright © <a href="#">GPTpost</a> Company. All rights reserved. 
                    <br>Design: Jose Raul Ruiz Torres</a> 
                </p>
            </div>
        </div>
    </div>
</footer>
</html>
