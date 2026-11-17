<?php

// Evitar que la página se congele si la conexión remota tarda
ini_set('default_socket_timeout', 3);
set_time_limit(5);

require("../config/database.php");

$id = $_GET['id'] ?? '';

if (empty($id) || !is_numeric($id)) {
    die("ID de usuario inválido.");
}

$sql = 'DELETE FROM users WHERE id = $1';
$params = array($id);

// 1. Eliminar de la base de datos local (rápido y local)
if (isset($local_conn) && $local_conn) {
    @pg_query_params($local_conn, $sql, $params);
}

// 2. Intentar eliminar de Supabase de forma segura sin bloquear la página si falla
if (isset($supa_conn) && $supa_conn) {
    @pg_query_params($supa_conn, $sql, $params);
}

// 3. Redireccionar inmediatamente al listado
header("Location: list_users.php");
exit;

/*
//get database connection
require("../config/database.php");

//gET DATA 
$user_id = $GET['userID'];
echo $user_id;
//pPrepare query 
$sql = "DELETE FROM users WHERE id = $user_id";
//Execute query 
$res = pg_query($local_conn, $sql);
if($res) {
    echo "<script>alert('User has been created successfylly:::')</script>";
    header('refresh:0;url=list_users.php');
} else {
    //echo "<script>alert('User has not been delete:::')</script>";
    //header('refresh:0;url=list_users.php');
    
}*/
?>