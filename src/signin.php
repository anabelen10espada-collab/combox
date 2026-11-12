<?php
require("../config/database.php");
session_start();

if (isset($_SESSION['userid'])) {
    header("Location: home.php");
    exit();
}

$e_mail = trim($_POST['email'] ?? '');
// Acepta tanto 'psw' como 'passwd' por compatibilidad con el HTML
$p_assword = $_POST['psw'] ?? $_POST['passwd'] ?? '';
$pass_enc = md5($p_assword);

$sql = "SELECT id, firstname, lastname FROM public.users WHERE email = '$e_mail' AND password = '$pass_enc'";
$res = pg_query($supa_conn, $sql);

if ($res && pg_num_rows($res) > 0) {
    $row = pg_fetch_assoc($res);

    $_SESSION['userid'] = $row['id'];
    $_SESSION['fname'] = $row['firstname'];
    $_SESSION['lname'] = $row['lastname'];

    header("Location: home.php");
    exit();
} else {
    echo "<script>
        alert('Invalid email or password');
        window.location.href = 'signin.html';
    </script>";
    exit();
}
?>