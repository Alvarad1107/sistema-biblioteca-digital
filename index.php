<?php
session_start();

// Si ya hay sesión, redirigir al panel
if (isset($_SESSION['usuario_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Biblioteca Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e2e8f0; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            background-color: #f4f1ea; 
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            max-width: 950px;
            width: 100%;
            padding: 2.5rem 3rem;
            margin: 20px;
        }
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
        }
        .brand {
            font-weight: 700;
            font-size: 1.3rem;
            color: #333;
        }
        .brand span {
            color: #666;
            font-weight: 400;
        }
        .btn-dark-green {
            background-color: #2b3a30;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-weight: 500;
        }
        .btn-dark-green:hover {
            background-color: #1e2922;
            color: #ffffff;
        }
        .form-control {
            background-color: #ffffff;
            border: none;
            border-radius: 6px;
            padding: 0.8rem 1rem;
            font-size: 0.9rem;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(43, 58, 48, 0.2);
        }
        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #444;
            margin-bottom: 0.3rem;
        }
        .forgot-link {
            font-size: 0.8rem;
            color: #666;
            text-decoration: none;
            display: block;
            margin-top: 15px;
        }
        .forgot-link:hover {
            color: #333;
        }
        .img-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .img-container img {
            max-width: 90%;
            height: auto;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="top-nav">
            <div class="brand">Biblioteca<span>Digital</span></div>
        </div>

        <div class="row align-items-center">
            <div class="col-md-5 d-flex flex-column justify-content-center pe-md-4">
                <h2 class="mb-4 fw-normal text-dark">Inicio de Sesión</h2>
                
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger border-0 rounded-3" style="font-size: 0.85rem; padding: 0.6rem;">
                        Usuario o contraseña incorrectos.
                    </div>
                <?php endif; ?>

                <form action="login_proceso.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="email" class="form-control" name="correo" placeholder="Ingresa tu correo" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="clave" placeholder="Ingresa tu contraseña" required>
                    </div>
                    
                    <button type="submit" class="btn btn-dark-green w-100 py-2">Iniciar Sesión</button>
                    
                </form>
            </div>

            <div class="col-md-7 img-container d-none d-md-flex">
                <img src="../assets/libros.png" alt="Ilustración de libros">
            </div>
        </div>
    </div>

</body>
</html>