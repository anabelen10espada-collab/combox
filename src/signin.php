<?php
    //get database connection
    require("../config/database.php");

    session_start();
    
    if(!isset($SESSION ['userid'])){
        header ('refresh:0;url = home.php');
    }

    // Get data from html form (client)
    $e_mail = $_POST['email'];
    $p_assword = $_POST['psw'];
    $pass_enc = md5($p_assword);

    $sql = " SELECT * FROM users WHERE email = '$e_mail' and password = '$pass_enc'";
    $res = pg_query($supa_conn, $sql);

    if (pg_num_rows ($res) > 0){
        $row = pg_fetch_assoc($res);

        $_SESSION['userid'] = $row['id'];
        $_SESSION['fname'] = $row['firstname'];
        $_SESSION['lname'] = $row['lastname'];

        header ('refresh:0;url = home.php');
    } else {
        echo "<script>alert ('Invalid email or password :::')</script>",
        header('refresh:0;url=signin.html');
    }


    //update - delete- foto perfil - listar todos los usuarios de la lista en dos diferentes
    //list_user.php traer todos los usuarios y traerlos generar un njson . ,uestra la tabla de todos los usuarios cuando coloque la direccion completa
    //que muestre todos los campos nombre, apellido, telefono, email, estado, foto y unos ivconos de leer (despliega mas informacion del usuario), actualizar y eliminar
    // y buscar usuarios 
    
    