<?php
session_start();

// Si no hay sesión iniciada, devuelve al login
if (!isset($_SESSION['userid'])) {
    header("Location: signin.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Combox</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary shadow-sm mb-4">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Comboox - Bienvenido <?php echo htmlspecialchars($_SESSION['fname'] ?? ''); ?></span>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Cerrar Sesión</a>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow-sm border-0 rounded-4 p-4 bg-white">
            <h3>Panel Principal</h3>
            <p class="text-muted">Has iniciado sesión correctamente en Supabase.</p>
            <a href="list_users.php" class="btn btn-primary">Gestionar Usuarios</a>
        </div>
    </div>
</body>
</html>